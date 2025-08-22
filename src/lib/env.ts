export type PublicEnv = {
  NEXT_PUBLIC_API_BASE_URL: string;
  NEXT_PUBLIC_REQUEST_TIMEOUT_MS: number;
  NEXT_PUBLIC_AUTH_HEADER_PREFIX: string;
  NEXT_PUBLIC_SITE_URL: string;
  NEXT_PUBLIC_GA_ID?: string;
};

function parseNumber(value: string | undefined, fallback: number): number {
  const n = value ? Number(value) : NaN;
  return Number.isFinite(n) ? (n as number) : fallback;
}

function pickUrlFromList(raw: string | undefined, { preferHttps = true }: { preferHttps?: boolean } = {}): string | null {
  if (!raw) return null;
  // Split by comma, trim, drop empty and literal 'undefined'/'null'
  const parts = raw
    .split(",")
    .map((s) => s.trim().replace(/^['"]|['"]$/g, ""))
    .filter((s) => s && !/^undefined|null$/i.test(s))
    .map((s) => s.replace(/\/$/, ""));
  const valid: string[] = [];
  for (const p of parts) {
    try {
      // Validate absolute URL
      new URL(p);
      valid.push(p);
    } catch {
      // ignore invalid
    }
  }
  if (valid.length === 0) return null;
  // Prefer https for prod; else return first valid
  if (preferHttps) {
    const https = valid.find((u) => u.startsWith("https://"));
    if (https) return https;
  }
  return valid[0];
}

export const env: PublicEnv = {
  NEXT_PUBLIC_API_BASE_URL:
    pickUrlFromList(process.env.NEXT_PUBLIC_API_BASE_URL, { preferHttps: false }) ||
    "http://localhost:8000",
  NEXT_PUBLIC_REQUEST_TIMEOUT_MS: parseNumber(
    process.env.NEXT_PUBLIC_REQUEST_TIMEOUT_MS,
    20000
  ),
  NEXT_PUBLIC_AUTH_HEADER_PREFIX:
    (process.env.NEXT_PUBLIC_AUTH_HEADER_PREFIX || "Bearer").trim(),
  NEXT_PUBLIC_SITE_URL: (() => {
    // Support common typo NEXT_PUBLIC_SIT_URL as fallback
    const siteRaw = process.env.NEXT_PUBLIC_SITE_URL || process.env.NEXT_PUBLIC_SIT_URL;
    return (
      pickUrlFromList(siteRaw, { preferHttps: true }) ||
      "http://localhost:3000"
    );
  })(),
  NEXT_PUBLIC_GA_ID: process.env.NEXT_PUBLIC_GA_ID,
};

export const API_BASE_URL = env.NEXT_PUBLIC_API_BASE_URL;
export const AUTH_HEADER_PREFIX = env.NEXT_PUBLIC_AUTH_HEADER_PREFIX;
