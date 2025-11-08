"use client";
import { useSkills } from "@/lib/api.hooks";

type Skill = {
  id: number;
  name: string;
  category?: string;
  description?: string;
  docs_url?: string;
  icon?: string;
  highlights?: string[];
  since_year?: number | null;
  years_used?: number | null;
  primary?: boolean;
  accent?: string;
};

export function SkillsSection() {
  const skills = useSkills();
  const grouped = (skills.data || []).reduce<Record<string, Skill[]>>((acc, raw: unknown) => {
    const s = raw as Skill;
    const cat = ((s.category as string) || 'other').toLowerCase();
    acc[cat] = acc[cat] || [];
    acc[cat].push(s);
    return acc;
  }, {});

  const orderCats = ["frontend", "backend", "cloud", "devops", "data", "testing", "other"];
  const categories = Object.keys(grouped).sort(
    (a, b) => orderCats.indexOf(a) - orderCats.indexOf(b)
  );

  return (
    <section id="skills" data-section="skills" className="scroll-mt-24 py-16">
      <div className="max-w-7xl mx-auto px-5 md:px-8">
        <header className="mb-10 space-y-2">
          <h2 className="text-3xl font-semibold tracking-tight bg-gradient-to-r from-teal-400 via-emerald-400 to-amber-300 text-transparent bg-clip-text">
            Skills & Stack
          </h2>
          <p className="text-slate-400 text-sm max-w-[65ch]">
            A curated snapshot of tools and technologies I use to ship reliable, scalable products. Core skills are highlighted.
          </p>
        </header>

        <div className="space-y-12">
          {categories.map((cat) => {
            const items = grouped[cat];
            return (
              <div key={cat}>
                <h3 className="text-sm uppercase tracking-wider font-semibold text-slate-400 mb-4 flex items-center gap-2">
                  <span className="inline-block h-2 w-2 rounded-full bg-emerald-400" /> {cat}
                  <span className="text-xs text-slate-500">{items.length}</span>
                </h3>
                <ul className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                  {items.sort((a, b) => Number(b.primary) - Number(a.primary)).map((s) => {
                    const accent = s.accent || (s.primary ? '#10b981' : '#1e293b');
                    return (
                      <li
                        key={s.id}
                        className="group rounded-xl border border-slate-800 bg-slate-900/60 hover:bg-slate-900 transition-colors backdrop-blur-sm relative overflow-hidden"
                        style={{ boxShadow: s.primary ? `0 0 0 1px ${accent}55, 0 4px 24px -4px ${accent}40` : undefined }}
                      >
                        <div className="p-5 space-y-4">
                          <div className="flex items-start justify-between gap-4">
                            <div className="space-y-1">
                              <p className="font-medium text-slate-100 flex items-center gap-2">
                                {s.icon && s.icon.startsWith('http') ? (
                                  // eslint-disable-next-line @next/next/no-img-element
                                  <img src={s.icon} alt={s.name} className="h-6 w-6 rounded" />
                                ) : (
                                  s.icon ? <span className="text-lg">{s.icon}</span> : null
                                )}
                                <span>{s.name}</span>
                                {s.primary && <span className="px-2 py-0.5 text-[10px] rounded bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">Core</span>}
                              </p>
                              {s.description && <p className="text-xs text-slate-400 leading-relaxed">{s.description}</p>}
                            </div>
                            {typeof s.years_used === 'number' && (
                              <span className="text-[10px] px-2 py-1 rounded bg-slate-800 text-slate-300">
                                {s.years_used}+ yrs
                              </span>
                            )}
                          </div>
                          {Array.isArray(s.highlights) && s.highlights.length > 0 && (
                            <ul className="space-y-1">
                              {s.highlights.slice(0, 3).map((h, i) => (
                                <li key={i} className="flex gap-2 text-xs text-slate-300">
                                  <span className="mt-1 h-1.5 w-1.5 rounded-full" style={{ background: accent }} />
                                  <span className="leading-relaxed">{h}</span>
                                </li>
                              ))}
                            </ul>
                          )}
                          <div className="flex flex-wrap gap-2 pt-1">
                            {s.docs_url && (
                              <a
                                href={s.docs_url}
                                target="_blank"
                                rel="noreferrer"
                                className="text-[10px] px-2 py-1 rounded bg-slate-800 text-slate-300 hover:text-teal-300 border border-slate-700"
                              >Docs</a>
                            )}
                          </div>
                        </div>
                      </li>
                    );
                  })}
                </ul>
              </div>
            );
          })}
        </div>

        {skills.isLoading && (
          <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-6">
            {Array.from({ length: 6 }).map((_, i) => (
              <div key={i} className="h-32 rounded-xl bg-slate-800/40 animate-pulse" />
            ))}
          </div>
        )}
      </div>
    </section>
  );
}
