"use client";

import { useMemo, useState } from "react";
import Link from "next/link";
import { useProjectsInfinite, useSkills } from "@/lib/api.hooks";
import { Button, Badge } from "@/components/ui";
import { useAuthGuard } from "@/lib/useAuthGuard";

function ProjectCard({
  title,
  description,
  image_url,
  image,
  link,
  repo,
  skills,
  id,
}: {
  title: string;
  description?: string;
  image_url?: string;
  image?: string | null;
  link?: string;
  repo?: string;
  skills: { id: number; name: string }[];
  id: number;
}) {
  const cover = image_url || image || undefined;
  return (
    <li className="rounded-lg border overflow-hidden">
      {cover ? (
        // eslint-disable-next-line @next/next/no-img-element
        <img src={cover} alt="" className="w-full h-40 object-cover" />
      ) : (
        <div className="h-40 w-full bg-black/5 dark:bg-white/5" />
      )}
      <div className="p-4 space-y-2">
        <div className="font-medium">
          <Link href={`/projects/${id}`}>{title}</Link>
        </div>
        {description && (
          <p className="text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">{description}</p>
        )}
        {skills?.length ? (
          <div className="flex flex-wrap gap-2 pt-1">
            {skills.map((s) => (
              <Badge key={s.id} color="blue">{s.name}</Badge>
            ))}
          </div>
        ) : null}
        <div className="flex gap-3 pt-2 text-sm">
          {link && (
            <a href={link} target="_blank" rel="noreferrer" className="underline underline-offset-4">Live</a>
          )}
          {repo && (
            <a href={repo} target="_blank" rel="noreferrer" className="underline underline-offset-4">Code</a>
          )}
        </div>
      </div>
    </li>
  );
}

export default function ProjectsPage() {
  useAuthGuard();
  const skills = useSkills();
  const [search, setSearch] = useState("");
  const [featured, setFeatured] = useState<boolean | undefined>(undefined);
  const [skill, setSkill] = useState<string | undefined>(undefined);
  const [ordering, setOrdering] = useState<string | undefined>("-created_at");

  const filters = useMemo(() => ({
    search: search || undefined,
    featured,
    skills__name: skill,
    ordering,
  }), [search, featured, skill, ordering]);

  const q = useProjectsInfinite(filters);
  const items = q.data?.items || [];

  return (
    <div className="max-w-6xl mx-auto px-4 py-8 space-y-4">
      <div className="flex items-center justify-between gap-3 flex-wrap">
        <h1 className="text-2xl font-semibold">Projects</h1>
        <div className="flex items-center gap-2 text-sm">
          <input
            value={search}
            onChange={(e) => setSearch(e.target.value)}
            placeholder="Search projects..."
            className="h-9 px-3 rounded border bg-transparent"
          />
          <select
            value={featured === undefined ? "all" : featured ? "yes" : "no"}
            onChange={(e) => setFeatured(e.target.value === "all" ? undefined : e.target.value === "yes")}
            className="h-9 px-3 rounded border bg-transparent"
          >
            <option value="all">All</option>
            <option value="yes">Featured</option>
            <option value="no">Not featured</option>
          </select>
          <select
            value={skill || ""}
            onChange={(e) => setSkill(e.target.value || undefined)}
            className="h-9 px-3 rounded border bg-transparent"
          >
            <option value="">All skills</option>
            {(skills.data || []).map((s) => (
              <option key={s.id} value={s.name}>{s.name}</option>
            ))}
          </select>
          <select
            value={ordering || ""}
            onChange={(e) => setOrdering(e.target.value || undefined)}
            className="h-9 px-3 rounded border bg-transparent"
          >
            <option value="-created_at">Newest</option>
            <option value="created_at">Oldest</option>
            <option value="title">Title A-Z</option>
            <option value="-id">Recently added</option>
          </select>
          <Button onClick={() => q.refetch()} disabled={q.isFetching}>
            {q.isFetching ? "Refreshing..." : "Refresh"}
          </Button>
        </div>
      </div>

      {q.isLoading ? (
        <ul className="grid md:grid-cols-2 gap-4">
          {Array.from({ length: 4 }).map((_, i) => (
            <li key={i} className="h-60 rounded-lg bg-black/5 dark:bg-white/5 animate-pulse" />
          ))}
        </ul>
      ) : q.isError ? (
        <div className="text-red-600">Failed to load projects.</div>
      ) : items.length === 0 ? (
        <p className="text-neutral-600 dark:text-neutral-300">No projects found.</p>
      ) : (
        <>
          <ul className="grid md:grid-cols-2 gap-4">
            {items.map((p) => (
              <ProjectCard
                key={p.id}
                title={p.title}
                description={p.description}
                image_url={p.image_url}
                image={p.image ?? undefined}
                link={p.link}
                repo={p.repo}
                skills={p.skills}
                id={p.id}
              />
            ))}
          </ul>
          <div className="pt-4 flex items-center justify-center">
            {q.data?.hasMore ? (
              <Button onClick={() => q.fetchNextPage()} disabled={q.isFetchingNextPage}>
                {q.isFetchingNextPage ? "Loading..." : "Load more"}
              </Button>
            ) : (
              <span className="text-sm text-neutral-500">No more projects.</span>
            )}
          </div>
        </>
      )}
    </div>
  );
}
