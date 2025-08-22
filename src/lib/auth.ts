"use client";

import { API_BASE_URL } from "./env";

const ACCESS_KEY = "auth.access";
const REFRESH_KEY = "auth.refresh";

export function getAccessToken(): string | null {
  try {
    return typeof window !== "undefined" ? window.localStorage.getItem(ACCESS_KEY) : null;
  } catch {
    return null;
  }
}

export function getRefreshToken(): string | null {
  try {
    return typeof window !== "undefined" ? window.localStorage.getItem(REFRESH_KEY) : null;
  } catch {
    return null;
  }
}

export function setTokens(access: string, refresh?: string) {
  if (typeof window === "undefined") return;
  window.localStorage.setItem(ACCESS_KEY, access);
  if (refresh) window.localStorage.setItem(REFRESH_KEY, refresh);
}

export function clearTokens() {
  if (typeof window === "undefined") return;
  window.localStorage.removeItem(ACCESS_KEY);
  window.localStorage.removeItem(REFRESH_KEY);
}

export async function login(username: string, password: string): Promise<{ access: string; refresh: string }> {
  const res = await fetch(new URL("api/auth/jwt/create", API_BASE_URL + "/").toString(), {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, password }),
  });
  const data = await res.json();
  if (!res.ok) {
    throw new Error(data?.detail || "Login failed");
  }
  const access = data?.access as string;
  const refresh = data?.refresh as string;
  if (!access || !refresh) throw new Error("Invalid token response");
  setTokens(access, refresh);
  return { access, refresh };
}

export async function refresh(): Promise<string | null> {
  const r = getRefreshToken();
  if (!r) return null;
  const res = await fetch(new URL("api/auth/jwt/refresh", API_BASE_URL + "/").toString(), {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ refresh: r }),
  });
  type RefreshResp = { access?: string };
  const data: RefreshResp = await res.json().catch(() => ({} as RefreshResp));
  if (!res.ok) return null;
  const access = data?.access as string | undefined;
  if (!access) return null;
  setTokens(access);
  return access;
}
