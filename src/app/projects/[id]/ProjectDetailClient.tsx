"use client";

import Link from "next/link";
import { useProject } from "@/lib/api.hooks";
import { Badge, Button } from "@/components/ui";

export default function ProjectDetailClient({ id }: { id: number }) {
  const q = useProject(id);
  const p = q.data;

  if (q.isLoading) {
    return (
      <div className="max-w-4xl mx-auto px-4 py-8 space-y-4">
        <div className="h-60 w-full rounded-lg bg-black/5 dark:bg-white/5 animate-pulse" />
        <div className="h-6 w-64 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
        <div className="h-4 w-80 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
        <div className="h-24 w-full rounded bg-black/5 dark:bg-white/5 animate-pulse" />
      </div>
    );
  }
  if (q.isError || !p) {
    return <div className="max-w-4xl mx-auto px-4 py-8 text-red-600">Failed to load project.</div>;
  }

  const cover = p.image_url || p.image || undefined;

  return (
    <div className="max-w-4xl mx-auto px-4 py-8 space-y-6">
      {cover ? (
        // eslint-disable-next-line @next/next/no-img-element
        <img src={cover} alt="" className="w-full h-64 object-cover rounded-xl" />
      ) : null}

      <header>
        <h1 className="text-3xl font-semibold gradient-text">{p.title}</h1>
        {p.created_at && (
          <div className="text-sm text-neutral-600 dark:text-neutral-400">{p.created_at}</div>
        )}
      </header>

      {p.description && (
        <p className="leading-7 text-neutral-800 dark:text-neutral-200 whitespace-pre-line">{p.description}</p>
      )}

      {p.skills?.length ? (
        <div className="flex flex-wrap gap-2">
          {p.skills.map((s) => (
            <Badge key={s.id} color="blue">{s.name}</Badge>
          ))}
        </div>
      ) : null}

      <div className="flex gap-3">
        {p.link && (
          <a href={p.link} className="underline underline-offset-4" target="_blank" rel="noreferrer">Live demo</a>
        )}
        {p.repo && (
          <a href={p.repo} className="underline underline-offset-4" target="_blank" rel="noreferrer">Source code</a>
        )}
      </div>

  <div className="pt-2">
        <Link href="/projects"><Button variant="ghost">← Back to projects</Button></Link>
      </div>
    </div>
  );
}
