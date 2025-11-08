import type { NextConfig } from "next";

// Explicitly set Turbopack's root so it doesn't infer the workspace root from another lockfile
// NOTE: `eslint.ignoreDuringBuilds` was removed in Next 16 config validation. Use a separate lint step instead.
const nextConfig = {
  typescript: { ignoreBuildErrors: true },
  turbopack: {
    // Pin the workspace root to this Next.js app directory (silences multiple lockfile warning)
    root: __dirname,
  },
  // Allow localhost loopback variations during dev to silence cross origin warning
  experimental: {
    allowedDevOrigins: ["http://localhost:3000", "http://127.0.0.1:3000", "http://localhost:3001", "http://127.0.0.1:3001"],
  },
} satisfies NextConfig;

export default nextConfig;
