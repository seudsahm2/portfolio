"use client";
import { useExperiences } from "@/lib/api.hooks";
import { Card, CardContent } from "@/components/ui";
import { components } from "@/lib/api.types";

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
          {(experiences.data || []).map((e) => {
            const ex = e as components["schemas"]["Experience"] & {
              technologies?: string[];
              achievements?: string[];
              duration_months?: number | null;
              company_logo_url?: string;
              is_remote?: boolean;
              employment_type?: string;
              industry?: string;
              location?: string;
              company_website?: string;
            };
            const techs = Array.isArray(ex.technologies) ? ex.technologies : [];
            const achievements = Array.isArray(ex.achievements) ? ex.achievements : [];
            const when = `${ex.start_date} – ${ex.end_date || "Present"}`;
            const duration = typeof ex.duration_months === "number" && ex.duration_months > 0
              ? `${ex.duration_months} mo`
              : undefined;
            return (
              <Card key={ex.id} className="border-slate-700 bg-slate-900 overflow-hidden">
                <CardContent className="p-5 space-y-3">
                  <div className="flex items-start gap-4">
                    {ex.company_logo_url ? (
                      // eslint-disable-next-line @next/next/no-img-element
                      <img src={ex.company_logo_url} alt="" className="h-12 w-12 rounded-lg object-cover border border-slate-700/60" />
                    ) : (
                      <div className="h-12 w-12 rounded-lg bg-slate-800/60 border border-slate-700/60" />
                    )}
                    <div className="flex-1 min-w-0">
                      <div className="flex flex-wrap items-center justify-between gap-2">
                        <div className="font-medium text-slate-100 text-base line-clamp-1">
                          {ex.role} @ {ex.company}
                        </div>
                        <div className="text-xs text-slate-400 whitespace-nowrap">
                          <span>{when}</span>
                          {duration ? <span className="ml-2 text-slate-500">· {duration}</span> : null}
                        </div>
                      </div>
                      <div className="flex flex-wrap items-center gap-2 pt-1 text-[11px]">
                        {ex.employment_type && <span className="px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 border border-amber-500/30">{ex.employment_type}</span>}
                        {typeof ex.is_remote === "boolean" && (
                          <span className="px-2 py-0.5 rounded bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                            {ex.is_remote ? "Remote" : "On-site"}
                          </span>
                        )}
                        {ex.industry && <span className="px-2 py-0.5 rounded bg-slate-800 text-slate-300 border border-slate-700/50">{ex.industry}</span>}
                        {ex.location && <span className="px-2 py-0.5 rounded bg-slate-800 text-slate-300 border border-slate-700/50">{ex.location}</span>}
                        {ex.company_website && (
                          <a className="px-2 py-0.5 rounded bg-slate-800 text-teal-300 border border-slate-700/50 hover:text-teal-200" href={ex.company_website} target="_blank" rel="noreferrer">Website →</a>
                        )}
                      </div>
                    </div>
                  </div>

                  {ex.impact && (
                    <p className="text-sm text-slate-200 leading-relaxed">{ex.impact}</p>
                  )}
                  {ex.description && (
                    <p className="text-sm text-slate-400 leading-relaxed">{ex.description}</p>
                  )}

                  {techs.length > 0 && (
                    <div className="flex flex-wrap gap-1 pt-1">
                      {techs.map((t) => (
                        <span key={t} className="text-[10px] px-2 py-1 rounded bg-slate-800 text-slate-300 border border-slate-700/40">{t}</span>
                      ))}
                    </div>
                  )}

                  {achievements.length > 0 && (
                    <ul className="list-disc pl-5 space-y-1 text-sm text-slate-300">
                      {achievements.slice(0, 6).map((a, i) => (
                        <li key={i}>{a}</li>
                      ))}
                    </ul>
                  )}
                </CardContent>
              </Card>
            );
          })}
          {experiences.data && experiences.data.length === 0 && !experiences.isLoading && (
            <p className="text-slate-400 text-sm">No experiences added yet.</p>
          )}
        </div>
      </div>
    </section>
  );
}
