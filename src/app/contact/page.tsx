"use client";

import { useEffect, useState } from "react";
import { useContactMutation } from "@/lib/api.hooks";
import { Button } from "@/components/ui";
import toast from "react-hot-toast";
import { z } from "zod";

const Schema = z.object({
  name: z.string().min(2, "Please enter your name"),
  email: z.string().email("Enter a valid email"),
  message: z.string().min(10, "Please include a longer message"),
});

export default function ContactPage() {
  const m = useContactMutation();
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [message, setMessage] = useState("");
  const [lastSentAt, setLastSentAt] = useState<number | null>(null);
  const [nowTs, setNowTs] = useState<number>(Date.now());
  const cooldownMs = 15_000; // 15s basic anti-spam cooldown
  const remainingMs = lastSentAt ? Math.max(0, cooldownMs - (nowTs - lastSentAt)) : 0;
  const disabled = m.isPending || remainingMs > 0;

  useEffect(() => {
    if (!lastSentAt) return;
    if (remainingMs <= 0) return;
    const id = setInterval(() => setNowTs(Date.now()), 1000);
    return () => clearInterval(id);
  }, [lastSentAt, remainingMs]);

  return (
    <div className="max-w-xl mx-auto px-4 py-8 space-y-4">
      <h1 className="text-2xl font-semibold">Contact</h1>
      <form
        className="space-y-3"
        onSubmit={(e) => {
          e.preventDefault();
          const parsed = Schema.safeParse({ name, email, message });
          if (!parsed.success) {
            const msg = parsed.error.issues[0]?.message || "Invalid input";
            toast.error(msg);
            return;
          }
          if (remainingMs > 0) return;
          m.mutate(parsed.data, {
            onSuccess: () => {
              toast.success("Message sent. Thanks!");
              setLastSentAt(Date.now());
              setMessage("");
            },
            onError: () => {
              toast.error("Failed to send. Try again.");
            },
          });
        }}
      >
        <input
          className="w-full rounded border px-3 py-2 bg-background"
          placeholder="Your name"
          value={name}
          onChange={(e) => setName(e.target.value)}
          required
        />
        <input
          className="w-full rounded border px-3 py-2 bg-background"
          placeholder="Email"
          type="email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
        />
        <textarea
          className="w-full rounded border px-3 py-2 bg-background"
          placeholder="Message"
          rows={5}
          value={message}
          onChange={(e) => setMessage(e.target.value)}
          required
        />
        <div className="flex items-center gap-3">
          <Button type="submit" disabled={disabled}>
            {m.isPending ? "Sending..." : remainingMs > 0 ? `Wait ${Math.ceil(remainingMs / 1000)}s` : "Send"}
          </Button>
          {m.isError && <span className="text-red-600">Failed. Try again.</span>}
          {m.isSuccess && <span className="text-green-600">Sent!</span>}
        </div>
      </form>
    </div>
  );
}
