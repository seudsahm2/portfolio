"use client";

import { useEffect, useMemo, useState } from "react";
import { useIngestPinnedMutation } from "@/lib/api.hooks";
import { API_BASE_URL } from "@/lib/env";

export default function DevOverlay() {
  const [health, setHealth] = useState<string>("...");
  const [corsOrigin, setCorsOrigin] = useState<string>("");
  const [visible, setVisible] = useState<boolean>(true);
  const ingestPinned = useIngestPinnedMutation();
  const [usernameInput, setUsernameInput] = useState<string>("");

  const origin = useMemo(() => {
    if (typeof window === "undefined") return "";
    return window.location.origin;
  }, []);

  useEffect(() => {
    setCorsOrigin(origin);
    const ctrl = new AbortController();
    const url = new URL("api/health", API_BASE_URL + "/").toString();
    fetch(url, { signal: ctrl.signal })
      .then(async (r) => {
        if (!r.ok) throw new Error(String(r.status));
        const data = await r.json().catch(() => ({}));
        setHealth(data?.status || "ok");
      })
      .catch(() => setHealth("error"));
    return () => ctrl.abort();
  }, [origin]);

  if (!visible) return null;

  return (
    <div
      style={{
        position: "fixed",
        bottom: 10,
        right: 10,
        zIndex: 9999,
        background: "rgba(0,0,0,0.7)",
        color: "#fff",
        borderRadius: 8,
        padding: "8px 10px",
        fontSize: 12,
        fontFamily: "ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, \"Liberation Mono\", \"Courier New\", monospace",
        boxShadow: "0 4px 12px rgba(0,0,0,0.3)",
        backdropFilter: "blur(6px)",
      }}
    >
      <div style={{ display: "flex", gap: 8, alignItems: "center", flexWrap: "wrap", maxWidth: 420 }}>
        <strong>Dev</strong>
        <span>API: {API_BASE_URL}</span>
        <span>Origin: {corsOrigin}</span>
        <span>Health: {health}</span>
        <form
          onSubmit={(e) => {
            e.preventDefault();
            ingestPinned.mutate(usernameInput ? { username: usernameInput.trim() } : undefined);
          }}
          style={{ display: "flex", gap: 4, alignItems: "center" }}
        >
          <input
            placeholder="GitHub user"
            value={usernameInput}
            onChange={(e) => setUsernameInput(e.target.value)}
            style={{
              background: "rgba(255,255,255,0.1)",
              border: "1px solid rgba(255,255,255,0.25)",
              color: "#fff",
              padding: "2px 6px",
              borderRadius: 4,
              fontSize: 11,
              width: 90,
            }}
          />
          <button
            type="submit"
            disabled={ingestPinned.isPending}
            style={{
              border: "1px solid rgba(255,255,255,0.4)",
              background: ingestPinned.isPending ? "#555" : "transparent",
              color: "#fff",
              borderRadius: 6,
              padding: "2px 6px",
              cursor: ingestPinned.isPending ? "progress" : "pointer",
              fontSize: 11,
            }}
            title="Ingest pinned repos (admin only)"
          >
            {ingestPinned.isPending ? "Ingesting..." : "Ingest Pinned"}
          </button>
        </form>
        {ingestPinned.isSuccess && (
          <span style={{ color: "#10b981" }}>✓ {ingestPinned.data.length} updated</span>
        )}
        {ingestPinned.isError && <span style={{ color: "#ef4444" }}>✗ error</span>}
        <button
          onClick={() => setVisible(false)}
          style={{
            marginLeft: 8,
            border: "1px solid rgba(255,255,255,0.3)",
            background: "transparent",
            color: "#fff",
            borderRadius: 6,
            padding: "2px 6px",
            cursor: "pointer",
          }}
          title="Hide overlay"
        >
          ×
        </button>
      </div>
    </div>
  );
}
