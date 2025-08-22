"use client";

import { useState } from "react";
import { login } from "@/lib/auth";
import { Button } from "@/components/ui";
import { useRouter } from "next/navigation";

export default function LoginPage() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState<string | null>(null);
  const [pending, setPending] = useState(false);
  const router = useRouter();

  return (
    <div className="max-w-sm mx-auto px-4 py-10 space-y-4">
      <h1 className="text-2xl font-semibold">Login</h1>
      <form
        className="space-y-3"
        onSubmit={async (e) => {
          e.preventDefault();
          setPending(true);
          setError(null);
          try {
            await login(username, password);
            router.push("/projects");
          } catch (err: unknown) {
            setError((err as Error).message || "Login failed");
          } finally {
            setPending(false);
          }
        }}
      >
        <input
          className="w-full rounded border px-3 py-2 bg-background"
          placeholder="Username"
          value={username}
          onChange={(e) => setUsername(e.target.value)}
          required
        />
        <input
          className="w-full rounded border px-3 py-2 bg-background"
          placeholder="Password"
          type="password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
        />
        <div className="flex items-center gap-3">
          <Button type="submit" disabled={pending}>{pending ? "Signing in..." : "Sign in"}</Button>
          {error && <span className="text-red-600 text-sm">{error}</span>}
        </div>
      </form>
    </div>
  );
}
