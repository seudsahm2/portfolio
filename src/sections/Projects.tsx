"use client";
import { useProjects } from "@/lib/api.hooks";
import { Card, CardContent } from "@/components/ui";

export function ProjectsSection() {
  const projects = useProjects();
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
            {(projects.data || []).map((p) => (
              <Card key={p.id} className="group border-slate-700 bg-slate-900 hover:bg-slate-800 transition-colors">
                <CardContent className="p-5 space-y-3">
                  <div className="font-medium text-lg text-slate-100 group-hover:text-teal-400 transition-colors">{p.title}</div>
                  {p.description && <p className="text-sm text-slate-400 line-clamp-4">{p.description}</p>}
                  <div className="flex flex-wrap gap-1 pt-1">
                    {p.skills?.slice(0, 4).map((s) => (
                      <span key={s.id} className="text-[10px] px-2 py-1 rounded bg-slate-800 text-teal-300">{s.name}</span>
                    ))}
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>
        )}
      </div>
    </section>
  );
}
