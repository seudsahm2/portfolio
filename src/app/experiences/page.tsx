"use client";

import { useExperiences } from "@/lib/api.hooks";
import { useAuthGuard } from "@/lib/useAuthGuard";

function formatRange(start?: string | null, end?: string | null) {
  if (!start) return "";
  const s = new Date(start).toLocaleDateString(undefined, { year: "numeric", month: "short" });
  const e = end ? new Date(end).toLocaleDateString(undefined, { year: "numeric", month: "short" }) : "Present";
  return `${s} — ${e}`;
}

export default function ExperiencesPage() {
  useAuthGuard();
  const q = useExperiences();

  return (
    <div className="max-w-3xl mx-auto px-4 py-8 space-y-4">
      <h1 className="text-2xl font-semibold">Experience</h1>

      {q.isLoading ? (
        <ul className="space-y-3">
          {Array.from({ length: 4 }).map((_, i) => (
            <li key={i} className="h-20 rounded-lg bg-black/5 dark:bg-white/5 animate-pulse" />
          ))}
        </ul>
      ) : q.isError ? (
        <div className="text-red-600">Failed to load experiences.</div>
      ) : q.data?.length ? (
        <ul className="space-y-4">
          {q.data.map((e) => (
            <li key={e.id} className="rounded-lg border p-4">
              <div className="flex items-center justify-between">
                <div className="font-medium">{e.role} @ {e.company}</div>
                <div className="text-sm text-neutral-600 dark:text-neutral-400">{formatRange(e.start_date, e.end_date)}</div>
              </div>
              {e.description && (
                <p className="text-sm mt-2 text-neutral-700 dark:text-neutral-300 whitespace-pre-line">{e.description}</p>
              )}
            </li>
          ))}
        </ul>
      ) : (
        <p className="text-neutral-600 dark:text-neutral-300">No experiences found.</p>
      )}
    </div>
  );
}
