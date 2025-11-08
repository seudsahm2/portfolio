"use client";
import { useProfile } from "@/lib/api.hooks";

type UnknownProfile = Record<string, unknown>;

export function Hero() {
  const { data: p } = useProfile();
  const profile = (p ?? {}) as UnknownProfile;

  const name = (profile.name as string) || (profile.full_name as string) || "Your Name";
  const title = (profile.title as string) || "Software Engineer";
  const tagline = (profile.tagline as string) || "I build reliable, fast, and user‑friendly web experiences.";
  const bio = (profile.bio as string) || "Add a compelling professional summary here to replace the placeholder text.";
  const yearsRaw = profile.years_experience as number | string | undefined;
  const years = yearsRaw != null ? Number(yearsRaw) : undefined;
  const stack: string = (profile.primary_stack as string) || "React, TypeScript, Python, Django, Postgres";
  const avatarUrl: string | undefined = (profile.avatar_url as string) || undefined;
  const highlights: string[] = Array.isArray(profile.highlights) ? (profile.highlights as string[]) : [];
  const socials: Record<string, string> =
    typeof profile.socials === "object" && profile.socials ? (profile.socials as Record<string, string>) : {};
  const open = Boolean(profile.open_to_opportunities);
  const website = typeof profile.website === "string" ? profile.website : undefined;

  return (
    <section id="about" data-section="about" className="scroll-mt-24 py-20">
      <div className="max-w-7xl mx-auto px-5 md:px-8 grid md:grid-cols-12 gap-10 items-start">
        {/* Text */}
        <div className="md:col-span-7 space-y-6">
          <div className="space-y-2">
            <h1 className="text-5xl font-semibold tracking-tight bg-gradient-to-r from-teal-400 via-emerald-400 to-amber-300 text-transparent bg-clip-text">
              {name}
            </h1>
            <p className="text-emerald-300/90 text-lg flex flex-wrap items-center gap-3">
              <span>{title}{years ? ` • ${years}+ yrs` : null}</span>
              {open && (
                <span className="px-2 py-0.5 rounded-md bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 text-xs">
                  Open to opportunities
                </span>
              )}
            </p>
          </div>

          <p className="text-slate-300 text-lg max-w-[65ch] leading-relaxed">{tagline}</p>
          <p className="text-slate-400 max-w-[75ch] leading-relaxed">{bio}</p>

          {/* Stack chips */}
          {stack && (
            <div className="flex flex-wrap gap-2 pt-2" aria-label="Primary stack">
              {stack.split(",").map((s: string) => (
                <span key={s.trim()} className="px-3 py-1 rounded-full bg-slate-800/70 text-slate-200 text-xs border border-slate-700">
                  {s.trim()}
                </span>
              ))}
            </div>
          )}

          {/* Highlights */}
          {highlights.length > 0 && (
            <ul className="grid sm:grid-cols-2 gap-3 pt-4" aria-label="Highlights">
              {highlights.slice(0, 6).map((h, i) => (
                <li key={i} className="flex gap-3 items-start p-3 rounded-lg bg-slate-900/60 border border-slate-800">
                  <span className="mt-1 inline-block h-2.5 w-2.5 rounded-full bg-emerald-400/90" />
                  <span className="text-slate-200 text-sm leading-relaxed">{h}</span>
                </li>
              ))}
            </ul>
          )}

          {/* Actions */}
          <div className="flex flex-wrap gap-3 pt-4">
            <a href="#contact" className="px-4 py-2 rounded-md bg-teal-500 text-slate-900 text-sm font-medium">Get in touch</a>
            {socials?.github && (
              <a href={socials.github} target="_blank" rel="noreferrer" className="px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-200 text-sm font-medium border border-slate-700/70">GitHub</a>
            )}
            {socials?.linkedin && (
              <a href={socials.linkedin} target="_blank" rel="noreferrer" className="px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-200 text-sm font-medium border border-slate-700/70">LinkedIn</a>
            )}
            {socials?.twitter && (
              <a href={socials.twitter} target="_blank" rel="noreferrer" className="px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-200 text-sm font-medium border border-slate-700/70">Twitter</a>
            )}
            {website && (
              <a href={website} target="_blank" rel="noreferrer" className="px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-200 text-sm font-medium border border-slate-700/70">Website</a>
            )}
          </div>
        </div>

        {/* Avatar */}
        <div className="md:col-span-5">
          <div className="aspect-square rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center overflow-hidden border border-slate-800/80">
            {avatarUrl ? (
              // eslint-disable-next-line @next/next/no-img-element
              <img src={avatarUrl} alt={`${name} avatar`} className="h-full w-full object-cover" />
            ) : (
              <div className="text-slate-500 text-sm">No avatar</div>
            )}
          </div>
        </div>
      </div>
    </section>
  );
}
