"use client";

import { useEffect, useRef, useState } from "react";
import { useChatAskMutation } from "@/lib/api.hooks";
import { Markdown } from "@/components/chat/Markdown";
import type { components } from "@/lib/api.types";

export type ChatMessage = {
  id: string;
  role: "user" | "assistant" | "system";
  content: string;
  created_at: number;
};

const STORAGE_KEY = "chat.thread.v1";

function loadThread(): ChatMessage[] {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return [];
    const parsed = JSON.parse(raw);
    if (Array.isArray(parsed)) return parsed as ChatMessage[];
  } catch {}
  return [];
}

function saveThread(messages: ChatMessage[]) {
  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(messages.slice(-50)));
  } catch {}
}

export default function ChatDock() {
  const [open, setOpen] = useState(false);
  const [messages, setMessages] = useState<ChatMessage[]>([]);
  const [input, setInput] = useState("");
  const m = useChatAskMutation();
  const scroller = useRef<HTMLDivElement | null>(null);

  useEffect(() => {
    setMessages(loadThread());
  }, []);

  useEffect(() => {
    saveThread(messages);
    // Scroll to bottom when messages change
    scroller.current?.scrollTo({ top: scroller.current.scrollHeight, behavior: "smooth" });
  }, [messages]);

  function send() {
    const text = input.trim();
    if (!text || m.isPending) return;
    const user: ChatMessage = { id: crypto.randomUUID(), role: "user", content: text, created_at: Date.now() };
    setMessages((prev) => [...prev, user]);
    setInput("");
    m.mutate({ provider: "google", question: text, structured: true, top_n: 6 }, {
      onSuccess: (res: components["schemas"]["ChatLog"]) => {
        // answer_json is unknown; if it's an object with a text field, use it.
        let structured: string | undefined;
        if (res.answer_json && typeof res.answer_json === "object") {
          const aj = res.answer_json as Record<string, unknown>;
          const t = aj["text"];
          if (typeof t === "string") structured = t;
        }
        const answer = res.answer || structured || "(no answer)";
        const assistant: ChatMessage = { id: crypto.randomUUID(), role: "assistant", content: String(answer), created_at: Date.now() };
        setMessages((prev) => [...prev, assistant]);
      },
      onError: (err) => {
        const assistant: ChatMessage = { id: crypto.randomUUID(), role: "assistant", content: `Error: ${String(err)}`, created_at: Date.now() };
        setMessages((prev) => [...prev, assistant]);
      }
    });
  }

  function clear() {
    setMessages([]);
  }

  return (
    <div className="fixed z-50 bottom-4 right-4">
      {open && (
        <div className="w-[360px] h-[480px] bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg shadow-xl flex flex-col">
          <header className="px-3 h-10 border-b flex items-center justify-between">
            <div className="font-medium text-sm">Ask AI</div>
            <div className="flex items-center gap-2">
              <button className="text-xs text-neutral-600 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white" onClick={clear} title="Clear thread">Clear</button>
              <button className="text-sm underline underline-offset-4" onClick={() => setOpen(false)}>Close</button>
            </div>
          </header>
          <div ref={scroller} className="flex-1 overflow-y-auto px-3 py-2 space-y-3">
            {messages.length === 0 ? (
              <div className="text-sm text-neutral-600 dark:text-neutral-400">Ask about projects, stack, or code.</div>
            ) : messages.map((m) => (
              <div key={m.id} className={m.role === "user" ? "text-right" : "text-left"}>
                <div className={`inline-block max-w-[85%] rounded-lg px-3 py-2 text-sm ${m.role === "user" ? "bg-neutral-900 text-white dark:bg-white dark:text-black" : "bg-black/5 dark:bg-white/10"}`}>
                  {m.role === "assistant" ? <Markdown content={m.content} /> : <span>{m.content}</span>}
                </div>
                {m.role === "assistant" && (
                  <div className="mt-1 flex gap-2 text-xs text-neutral-500">
                    <button className="hover:text-neutral-800 dark:hover:text-neutral-300" title="Helpful">👍</button>
                    <button className="hover:text-neutral-800 dark:hover:text-neutral-300" title="Not helpful">👎</button>
                  </div>
                )}
              </div>
            ))}
          </div>
          <form
            className="p-2 border-t flex items-center gap-2"
            onSubmit={(e) => { e.preventDefault(); send(); }}
          >
            <input
              className="flex-1 h-9 rounded border bg-transparent px-3"
              placeholder="Ask anything..."
              value={input}
              onChange={(e) => setInput(e.target.value)}
            />
            <button type="submit" disabled={m.isPending} className="h-9 px-3 rounded bg-neutral-900 text-white dark:bg-white dark:text-black text-sm">
              {m.isPending ? "Sending" : "Send"}
            </button>
          </form>
        </div>
      )}

      <button
        className="h-11 px-4 rounded-full shadow-lg bg-neutral-900 text-white dark:bg-white dark:text-black text-sm"
        onClick={() => setOpen((v) => !v)}
      >
        {open ? "Close chat" : "Chat"}
      </button>
    </div>
  );
}
