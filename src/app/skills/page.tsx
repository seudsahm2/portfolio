"use client";

import { useMemo, useState } from "react";
import { useSkills } from "@/lib/api.hooks";

export default function SkillsPage() {
  const q = useSkills();
  const [filter, setFilter] = useState<number | "all">("all");

  const levelChips = useMemo(() => {
    const set = new Set<number>();
    (q.data || []).forEach((s) => {
      if (typeof s.level === "number") set.add(s.level);
    });
    const values = Array.from(set).sort((a, b) => a - b);
    return ["all" as const, ...values];
  }, [q.data]);

  const filtered = useMemo(() => {
    const data = q.data || [];
    if (filter === "all") return data;
    return data.filter((s) => (s.level ?? 0) === filter);
  }, [q.data, filter]);

  return (
    <div className="max-w-4xl mx-auto px-4 py-10 space-y-4">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-semibold gradient-text">Skills</h1>
        <div className="flex gap-2 text-sm">
          {levelChips.map((lv) => (
            <button
              key={String(lv)}
              className={`px-3 py-1 rounded-full border hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors ${filter === lv ? "bg-neutral-900 text-white dark:bg-white dark:text-black" : ""}`}
              onClick={() => setFilter(lv)}
              title={lv === "all" ? "All" : `Level ${lv}`}
            >
              {lv === "all" ? "All" : `Level ${lv}`}
            </button>
          ))}
        </div>
      </div>

      {q.isLoading ? (
        <ul className="grid sm:grid-cols-2 md:grid-cols-3 gap-3">
          {Array.from({ length: 6 }).map((_, i) => (
            <li key={i} className="h-16 rounded-lg bg-black/5 dark:bg-white/5 animate-pulse" />
          ))}
        </ul>
      ) : q.isError ? (
        <div className="text-red-600">Failed to load skills.</div>
      ) : filtered.length ? (
        <ul className="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
          {filtered.map((s) => (
            <li key={s.id} className="rounded-xl gradient-border p-4 flex items-center justify-between bg-white/70 dark:bg-neutral-900/70 hover-card">
              <span>{s.name}</span>
              {typeof s.level === "number" && (
                <span className="text-xs text-neutral-600 dark:text-neutral-400">Lvl {s.level}</span>
              )}
            </li>
          ))}
        </ul>
      ) : (
        <p className="text-neutral-600 dark:text-neutral-300">No skills found.</p>
      )}
    </div>
  );
}
