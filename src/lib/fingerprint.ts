"use client";

// Simple persistent visitor fingerprint using localStorage UUID.
// Server already derives a fingerprint from IP+UA for like/bookmark uniqueness,
// but client token lets us show local optimistic state (e.g., highlight if already liked in this browser).

function uuidv4() {
  return crypto.randomUUID();
}

export function getFingerprint(): string {
  if (typeof window === "undefined") return "";
  try {
    const key = "fp_token";
    let fp = localStorage.getItem(key);
    if (!fp) {
      fp = uuidv4();
      localStorage.setItem(key, fp);
    }
    return fp;
  } catch {
    return "";
  }
}

export function useFingerprint(): string {
  // Lazy initialize on client only
  return getFingerprint();
}
