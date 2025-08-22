"use client";

import Link from "next/link";
import { useFeaturedProjects, useProfiles, useSkills } from "@/lib/api.hooks";
import { Button } from "@/components/ui";

export default function Home() {
  const profiles = useProfiles();
  const featured = useFeaturedProjects(3);
  const skills = useSkills();

  const profile = profiles.data?.[0];
  const topSkills = (skills.data || []).slice(0, 6);

  return (
    <div className="max-w-6xl mx-auto px-4 py-10 space-y-10">
      <section className="text-center md:text-left grid md:grid-cols-2 gap-6 items-center">
        <div>
          <h1 className="text-3xl md:text-4xl font-semibold">
            {profile ? profile.full_name : "Welcome"}
          </h1>
          <p className="mt-2 text-neutral-600 dark:text-neutral-300">
            {profile?.title || "Software Developer"}
          </p>
          {profile?.bio && (
            <p className="mt-4 text-neutral-700 dark:text-neutral-200 line-clamp-3">
              {profile.bio}
            </p>
          )}
          <div className="mt-6 flex flex-wrap gap-3">
            <Link href="/projects"><Button>View Projects</Button></Link>
            <Link href="/blog"><Button variant="secondary">Read Blog</Button></Link>
            <Link href="/contact"><Button variant="ghost">Contact</Button></Link>
          </div>
        </div>
        <div className="grid grid-cols-3 gap-3">
          {(topSkills.length ? topSkills : Array.from<null>({ length: 6 }).fill(null)).map((s, i) => (
            <div key={i} className="rounded-lg border p-3 text-sm text-center">
              {s ? <span>{s.name}</span> : <span className="opacity-60">Skill</span>}
            </div>
          ))}
        </div>
      </section>

      <section>
        <div className="flex items-center justify-between mb-4">
          <h2 className="text-xl font-semibold">Featured Projects</h2>
          <Link href="/projects" className="text-sm underline underline-offset-4">All projects</Link>
        </div>
        {featured.isLoading ? (
          <ul className="grid md:grid-cols-3 gap-4">
            {Array.from({ length: 3 }).map((_, i) => (
              <li key={i} className="h-32 rounded-lg bg-black/5 dark:bg-white/5 animate-pulse" />
            ))}
          </ul>
        ) : featured.isError ? (
          <div className="text-red-600">Failed to load featured projects.</div>
        ) : (featured.data?.length ? (
          <ul className="grid md:grid-cols-3 gap-4">
            {featured.data!.map((p) => (
              <li key={p.id} className="rounded-lg border p-4">
                <div className="font-medium">{p.title}</div>
                {p.description && (
                  <p className="text-sm text-neutral-600 dark:text-neutral-300 mt-1 line-clamp-3">
                    {p.description}
                  </p>
                )}
              </li>
            ))}
          </ul>
        ) : (
          <p className="text-neutral-600 dark:text-neutral-300">No featured projects yet.</p>
        ))}
      </section>
    </div>
  );
}
