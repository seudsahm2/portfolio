"use client";
import { useExperiences } from "@/lib/api.hooks";
import { Card, CardContent } from "@/components/ui";

export function ExperienceSection() {
  const experiences = useExperiences();
  return (
    <section id="experiences" data-section="experiences" className="scroll-mt-24">
      <div className="max-w-7xl mx-auto px-5 md:px-8 py-10">
        <header className="mb-6 flex items-center justify-between">
          <h2 className="text-3xl font-semibold text-amber-300">Experience</h2>
          <span className="text-xs text-slate-400">{experiences.data ? experiences.data.length : 0} roles</span>
        </header>
        <div className="space-y-6">
          {experiences.isLoading && Array.from({ length: 4 }).map((_, i) => (
            <div key={i} className="h-24 rounded-xl bg-slate-800/40 animate-pulse" />
          ))}
          {experiences.isError && <div className="text-red-500 text-sm">Failed to load experiences.</div>}
          {(experiences.data || []).map((e) => (
            <Card key={e.id} className="border-slate-700 bg-slate-900 overflow-hidden">
              <CardContent className="p-5 space-y-1">
                <div className="flex flex-wrap items-center justify-between gap-2">
                  <div className="font-medium text-slate-100 text-base">{e.role} @ {e.company}</div>
                  <div className="text-xs text-slate-400">{e.start_date} – {e.end_date || "Present"}</div>
                </div>
                {e.description && <p className="text-sm text-slate-400 leading-relaxed">{e.description}</p>}
              </CardContent>
            </Card>
          ))}
          {experiences.data && experiences.data.length === 0 && !experiences.isLoading && (
            <p className="text-slate-400 text-sm">No experiences added yet.</p>
          )}
        </div>
      </div>
    </section>
  );
}
