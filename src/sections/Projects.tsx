"use client";
import { useProjects } from "@/lib/api.hooks";
import { Card, CardContent } from "@/components/ui";
import type { components } from "@/lib/api.types";
import { useRouter } from "next/navigation";
import { formatDistanceToNow } from "date-fns";

export function ProjectsSection() {
  const projects = useProjects();
  const router = useRouter();
  return (
    <section id="projects" data-section="projects" className="scroll-mt-24">
      <div className="max-w-7xl mx-auto px-5 md:px-8 py-10">
        <header className="mb-6 flex items-center justify-between">
          <h2 className="text-3xl font-semibold text-emerald-400">Projects</h2>
          <span className="text-xs text-slate-400">{projects.data ? projects.data.length : 0} total</span>
        </header>
        {projects.isLoading ? (
          <div className="grid md:grid-cols-3 gap-6">
            {Array.from({ length: 6 }).map((_, i) => (
              <div key={i} className="h-40 rounded-xl bg-slate-800/40 animate-pulse" />
            ))}
          </div>
        ) : projects.isError ? (
          <div className="text-red-500 text-sm">Failed to load projects.</div>
        ) : (
          <div className="grid md:grid-cols-3 gap-6">
            {(projects.data || []).map((p) => {
              const meta = p as (components["schemas"]["Project"] & {
                stars?: number;
                forks?: number;
                language?: string;
                topics?: string[];
                last_pushed?: string;
              });
              const topics: string[] = Array.isArray(meta.topics) ? meta.topics : [];
              const lastPushed = meta.last_pushed ? formatDistanceToNow(new Date(meta.last_pushed), { addSuffix: true }) : null;
              return (
                <div
                  key={p.id}
                  role="button"
                  tabIndex={0}
                  aria-label={`Open project ${meta.title}`}
                  onClick={() => router.push(`/projects/${p.id}`)}
                  onKeyDown={(e) => {
                    if (e.key === "Enter" || e.key === " ") {
                      e.preventDefault();
                      router.push(`/projects/${p.id}`);
                    }
                  }}
                  className="block focus:outline-none focus:ring-2 focus:ring-teal-500 rounded-xl"
                >
                  <Card
                    className={
                      "group border-slate-700 bg-slate-900 hover:bg-slate-800 transition-colors relative overflow-hidden" +
                      (meta.featured ? " ring-2 ring-amber-400/40" : "")
                    }
                  >
                  {meta.featured && (
                    <div className="absolute -top-1 -right-1 bg-amber-500 text-[10px] font-semibold px-2 py-1 rounded-bl shadow">
                      PINNED
                    </div>
                  )}
                  <CardContent className="p-5 space-y-3">
                    <div className="flex items-start justify-between gap-2">
                      <div className="font-medium text-lg text-slate-100 group-hover:text-teal-400 transition-colors line-clamp-1">
                        {meta.title}
                      </div>
                      {(meta.stars || meta.forks) && (
                        <div className="flex items-center gap-1 text-[11px] text-slate-400">
                          {meta.stars ? <span title="Stars">★ {meta.stars}</span> : null}
                          {meta.forks ? <span title="Forks">⑂ {meta.forks}</span> : null}
                        </div>
                      )}
                    </div>
                    {meta.description && <p className="text-sm text-slate-400 line-clamp-4 min-h-[3.5rem]">{meta.description}</p>}
                    <div className="flex flex-wrap gap-1 pt-1">
                      {meta.language && (
                        <span className="text-[10px] px-2 py-1 rounded bg-teal-600/20 text-teal-300 border border-teal-700/30">
                          {meta.language}
                        </span>
                      )}
                      {topics.slice(0, 4).map((t) => (
                        <span
                          key={t}
                          className="text-[10px] px-2 py-1 rounded bg-slate-800 text-slate-300 border border-slate-700/40"
                        >
                          {t}
                        </span>
                      ))}
                      {meta.skills?.slice(0, 3).map((s) => (
                        <span key={s.id} className="text-[10px] px-2 py-1 rounded bg-slate-800 text-teal-300">
                          {s.name}
                        </span>
                      ))}
                    </div>
                    <div className="flex items-center justify-between text-[11px] text-slate-500 pt-1">
                      {lastPushed && <span title="Last push on GitHub">Updated {lastPushed}</span>}
                      {meta.link && (
                        <a
                          href={meta.link}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="text-teal-400 hover:text-teal-300 font-medium"
                          onClick={(e) => e.stopPropagation()}
                          onKeyDown={(e) => e.stopPropagation()}
                        >
                          Visit →
                        </a>
                      )}
                    </div>
                  </CardContent>
                  </Card>
                </div>
              );
            })}
          </div>
        )}
      </div>
    </section>
  );
}
