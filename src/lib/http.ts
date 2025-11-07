"use client";

import { API_BASE_URL, AUTH_HEADER_PREFIX, env } from "./env";
import { getAccessToken, refresh as refreshToken, clearTokens } from "./auth";

export type HttpMethod = "GET" | "POST" | "PUT" | "PATCH" | "DELETE";

export interface HttpOptions<TBody = unknown> {
  method?: HttpMethod;
  path: string; // relative to API base
  query?: Record<string, string | number | boolean | undefined>;
  body?: TBody;
  headers?: Record<string, string>;
  signal?: AbortSignal;
}

function buildUrl(path: string, query?: HttpOptions["query"]): string {
  const url = new URL(path.replace(/^\//, ""), API_BASE_URL + "/");
  if (query) {
    for (const [k, v] of Object.entries(query)) {
      if (v === undefined) continue;
      url.searchParams.set(k, String(v));
    }
  }
  return url.toString();
}

export class HttpError extends Error {
  status: number;
  data: unknown;
  constructor(message: string, status: number, data: unknown) {
    super(message);
    this.status = status;
    this.data = data;
  }
}

export async function http<TResp = unknown, TBody = unknown>(opts: HttpOptions<TBody>): Promise<TResp> {
  const controller = new AbortController();
  // Extend timeout for long-running chat requests
  const isChat = opts.path.replace(/^\//, "").startsWith("api/chat/");
  const timeoutMs = isChat ? Math.max(env.NEXT_PUBLIC_REQUEST_TIMEOUT_MS, 60000) : env.NEXT_PUBLIC_REQUEST_TIMEOUT_MS;
  const timeout = setTimeout(() => controller.abort(), timeoutMs);
  const signal = opts.signal ?? controller.signal;
  try {
    const url = buildUrl(opts.path, opts.query);
    const doFetch = async (withAuth = true) => {
      const headers: Record<string, string> = {
        ...(opts.headers || {}),
      };
      // Only set Content-Type when sending a body to reduce unnecessary CORS preflights on GET
      if (opts.body && !headers["Content-Type"]) {
        headers["Content-Type"] = "application/json";
      }
      if (withAuth) {
        const token = getAccessToken();
        if (token) headers["Authorization"] = `${AUTH_HEADER_PREFIX} ${token}`;
      }
      return fetch(url, {
        method: opts.method ?? (opts.body ? "POST" : "GET"),
        headers,
        body: opts.body ? JSON.stringify(opts.body) : undefined,
        signal,
      });
    };

    let res = await doFetch(true);
    // If unauthorized, try refresh once. If still unauthorized or refresh fails, retry once WITHOUT auth to allow public read.
    if (res.status === 401) {
      const newAccess = await refreshToken();
      if (newAccess) {
        res = await doFetch(true);
        if (res.status === 401) {
          // Token invalid even after refresh; drop tokens and retry as anonymous
          clearTokens();
          res = await doFetch(false);
        }
      } else {
        // No valid refresh; clear and retry as anonymous (for public endpoints)
        clearTokens();
        res = await doFetch(false);
      }
    }
    const contentType = res.headers.get("content-type") || "";
    const isJson = contentType.includes("application/json");
    const data = isJson ? await res.json().catch(() => null) : await res.text();
    if (!res.ok) {
      throw new HttpError(`HTTP ${res.status}`, res.status, data);
    }
    return data as TResp;
  } finally {
    clearTimeout(timeout);
  }
}

export const api = {
  get: <TResp>(path: string, query?: HttpOptions["query"]) =>
    http<TResp>({ method: "GET", path, query }),
  post: <TResp, TBody = unknown>(path: string, body?: TBody) =>
    http<TResp, TBody>({ method: "POST", path, body }),
  put: <TResp, TBody = unknown>(path: string, body?: TBody) =>
    http<TResp, TBody>({ method: "PUT", path, body }),
  patch: <TResp, TBody = unknown>(path: string, body?: TBody) =>
    http<TResp, TBody>({ method: "PATCH", path, body }),
  delete: <TResp>(path: string) => http<TResp>({ method: "DELETE", path }),
};
