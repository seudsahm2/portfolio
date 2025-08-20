export type PublicEnv = {
  NEXT_PUBLIC_API_BASE_URL: string;
  NEXT_PUBLIC_REQUEST_TIMEOUT_MS: number;
};

function parseNumber(value: string | undefined, fallback: number): number {
  const n = value ? Number(value) : NaN;
  return Number.isFinite(n) ? (n as number) : fallback;
}

export const env: PublicEnv = {
  NEXT_PUBLIC_API_BASE_URL:
    process.env.NEXT_PUBLIC_API_BASE_URL?.replace(/\/$/, "") || "http://localhost:8000",
  NEXT_PUBLIC_REQUEST_TIMEOUT_MS: parseNumber(
    process.env.NEXT_PUBLIC_REQUEST_TIMEOUT_MS,
    20000
  ),
};

export const API_BASE_URL = env.NEXT_PUBLIC_API_BASE_URL;
