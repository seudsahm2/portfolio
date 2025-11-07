"use client";

import Link from "next/link";
import { useFeaturedProjects, useProfiles, useSkills } from "@/lib/api.hooks";
import { Button, Card, CardContent } from "@/components/ui";

export default function Home() {
  const profiles = useProfiles();
  const featured = useFeaturedProjects(3);
  const skills = useSkills();

  const profile = profiles.data?.[0];
  const topSkills = (skills.data || []).slice(0, 6);

  return (
    <div className="relative">
      <div className="radial-spotlight" />
      <div className="max-w-6xl mx-auto px-4 py-14 space-y-14">
        {/* Hero */}
        <section className="grid md:grid-cols-12 gap-8 items-center">
          <div className="md:col-span-7 space-y-5">
            <div className="inline-flex items-center gap-2 text-xs px-2 py-1 rounded-full border border-neutral-200 dark:border-neutral-800 bg-white/60 dark:bg-neutral-900/60 backdrop-blur">
              <span className="h-2 w-2 rounded-full bg-emerald-500" /> Available for work
            </div>
            <h1 className="text-4xl md:text-5xl font-bold leading-tight">
              <span className="gradient-text">{profile?.full_name || "Seud"}</span>
              <br />
              <span className="text-neutral-800 dark:text-neutral-100">{profile?.title || "Software Developer"}</span>
            </h1>
            {profile?.bio && (
              <p className="text-neutral-600 dark:text-neutral-300 max-w-[60ch]">
                {profile.bio}
              </p>
            )}
            <div className="flex flex-wrap gap-3">
              <Link href="/projects"><Button>View Projects</Button></Link>
              <Link href="/blog"><Button variant="secondary">Read Blog</Button></Link>
              <Link href="/contact"><Button variant="ghost">Contact</Button></Link>
            </div>
          </div>
          <div className="md:col-span-5 grid grid-cols-3 gap-3">
            {(topSkills.length ? topSkills : Array(6).fill(null)).map((s, i) => (
              <Card key={i} className="glass hover-card">
                <CardContent className="p-4 text-center text-sm">
                  {s ? <span>{s.name}</span> : <span className="opacity-60">Skill</span>}
                </CardContent>
              </Card>
            ))}
          </div>
        </section>

        {/* Featured projects */}
        <section>
          <div className="flex items-center justify-between mb-5">
            <h2 className="text-2xl font-semibold">Featured Projects</h2>
            <Link href="/projects" className="text-sm underline underline-offset-4">All projects</Link>
          </div>
          {featured.isLoading ? (
            <ul className="grid md:grid-cols-3 gap-5">
              {Array.from({ length: 3 }).map((_, i) => (
                <li key={i} className="h-36 rounded-xl glass animate-pulse" />
              ))}
            </ul>
          ) : featured.isError ? (
            <div className="text-red-600">Failed to load featured projects.</div>
          ) : (featured.data?.length ? (
            <ul className="grid md:grid-cols-3 gap-5">
              {featured.data!.map((p) => (
                <li key={p.id} className="rounded-xl gradient-border bg-white/70 dark:bg-neutral-900/70 hover-card">
                  <div className="p-5 space-y-2">
                    <div className="font-medium text-lg">{p.title}</div>
                    {p.description && (
                      <p className="text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">
                        {p.description}
                      </p>
                    )}
                  </div>
                </li>
              ))}
            </ul>
          ) : (
            <p className="text-neutral-600 dark:text-neutral-300">No featured projects yet.</p>
          ))}
        </section>
      </div>
    </div>
  );
}
