"use client";
import { useSkills } from "@/lib/api.hooks";
import { Card, CardContent } from "@/components/ui";

export function SkillsSection() {
  const skills = useSkills();
  return (
    <section id="skills" data-section="skills" className="scroll-mt-24">
      <div className="max-w-7xl mx-auto px-5 md:px-8 py-10">
        <header className="mb-6 flex items-center justify-between">
          <h2 className="text-3xl font-semibold text-teal-400">Skills</h2>
          <span className="text-xs text-slate-400">{skills.data ? skills.data.length : 0} total</span>
        </header>
        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
          {(skills.data || []).map((s) => (
            <Card key={s.id} className="border-slate-700 bg-gradient-to-br from-slate-800 to-slate-900 hover:from-slate-800 hover:to-slate-800">
              <CardContent className="p-4 space-y-2">
                <div className="font-medium text-slate-100 flex items-center justify-between">
                  <span>{s.name}</span>
                  <span className="text-xs px-2 py-0.5 rounded bg-slate-700 text-slate-300">Lv {s.level ?? 0}</span>
                </div>
                <div className="h-2 rounded bg-slate-700 overflow-hidden">
                  <div className="h-full bg-teal-500" style={{ width: `${Math.min(100, (Number(s.level ?? 0) / 10) * 100)}%` }} />
                </div>
              </CardContent>
            </Card>
          ))}
          {skills.isLoading && Array.from({ length: 6 }).map((_, i) => (
            <div key={i} className="h-24 rounded-xl bg-slate-800/40 animate-pulse" />
          ))}
        </div>
      </div>
    </section>
  );
}
