"use client";

import React from "react";
import Link from "next/link";
import { useProject } from "@/lib/api.hooks";
import { Badge, Button, Card, CardContent } from "@/components/ui";
import Markdown from "@/components/chat/Markdown";
import { formatDistanceToNow } from "date-fns";
import type { components } from "@/lib/api.types";

export default function ProjectDetailClient({ id }: { id: number }) {
  const [expanded, setExpanded] = React.useState(false);
  const q = useProject(id);
  const p = q.data as (components["schemas"]["Project"] & {
    stars?: number;
    forks?: number;
    language?: string;
    topics?: string[];
    last_pushed?: string;
    image_url?: string;
    featured?: boolean;
    readme_excerpt?: string;
    license_spdx?: string;
    license_name?: string;
    open_issues?: number;
    watchers?: number;
    default_branch?: string;
    latest_release_tag?: string;
    latest_release_published?: string;
    is_archived?: boolean;
    is_template?: boolean;
    has_ci?: boolean;
  }) | undefined;

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

  const cover = p?.image_url || (p && (p as unknown as { image?: string }).image) || undefined;
  const topics: string[] = Array.isArray(p?.topics) ? (p?.topics as string[]) : [];
  const lastPushed = p?.last_pushed ? formatDistanceToNow(new Date(p.last_pushed), { addSuffix: true }) : null;
  const hasReadme = !!(p?.readme_excerpt && p.readme_excerpt.trim().length);

  return (
    <div className="max-w-4xl mx-auto px-4 py-8 space-y-6">
      {cover ? (
        // eslint-disable-next-line @next/next/no-img-element
        <img src={cover} alt="" className="w-full h-64 object-cover rounded-xl" />
      ) : null}

      <header className="flex items-start justify-between gap-4">
        <div>
          <h1 className="text-3xl font-semibold gradient-text flex items-center gap-2">
            {p.title}
            {p.featured ? (
              <span className="text-[10px] px-2 py-1 rounded bg-amber-500/20 text-amber-300 border border-amber-500/40">PINNED</span>
            ) : null}
            {p.is_archived ? (
              <span className="text-[10px] px-2 py-1 rounded bg-red-500/20 text-red-300 border border-red-500/40">ARCHIVED</span>
            ) : null}
            {p.is_template ? (
              <span className="text-[10px] px-2 py-1 rounded bg-purple-500/20 text-purple-300 border border-purple-500/40">TEMPLATE</span>
            ) : null}
          </h1>
          <div className="text-sm text-neutral-600 dark:text-neutral-400 flex gap-3">
            {p.created_at ? <span>Created: {p.created_at}</span> : null}
            {lastPushed ? <span>Updated: {lastPushed}</span> : null}
          </div>
        </div>
        {(p.stars || p.forks) && (
          <div className="shrink-0 text-sm text-neutral-600 dark:text-neutral-300 flex gap-3">
            {p.stars ? <span title="Stars">★ {p.stars}</span> : null}
            {p.forks ? <span title="Forks">⑂ {p.forks}</span> : null}
          </div>
        )}
      </header>

      {p.description && (
        <p className="leading-7 text-neutral-800 dark:text-neutral-200 whitespace-pre-line">{p.description}</p>
      )}

      <div className="flex flex-wrap gap-2">
        {p.language && (
          <Badge color="green">{p.language}</Badge>
        )}
        {topics.map((t) => (
          <Badge key={t} color="gray">{t}</Badge>
        ))}
        {p.skills?.map((s) => (
          <Badge key={s.id} color="blue">{s.name}</Badge>
        ))}
      </div>

      <div className="flex gap-3">
        {p.link && (
          <a href={p.link} className="underline underline-offset-4" target="_blank" rel="noreferrer">Live demo</a>
        )}
        {p.repo && (
          <a href={p.repo} className="underline underline-offset-4" target="_blank" rel="noreferrer">Source code</a>
        )}
      </div>

      <Card className="border-neutral-800/60 bg-neutral-900">
        <CardContent className="p-4 text-sm text-neutral-300 grid grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-4">
          <div><span className="text-neutral-500">Stars:</span> {p.stars ?? 0}</div>
          <div><span className="text-neutral-500">Forks:</span> {p.forks ?? 0}</div>
          <div><span className="text-neutral-500">Watchers:</span> {p.watchers ?? 0}</div>
          <div><span className="text-neutral-500">Open issues:</span> {p.open_issues ?? 0}</div>
          <div><span className="text-neutral-500">Language:</span> {p.language || "—"}</div>
          <div><span className="text-neutral-500">Default branch:</span> {p.default_branch || "—"}</div>
          <div className="col-span-2 md:col-span-3"><span className="text-neutral-500">License:</span> {p.license_name || p.license_spdx || "—"}</div>
          <div className="col-span-2 md:col-span-3"><span className="text-neutral-500">Latest release:</span> {p.latest_release_tag ? `${p.latest_release_tag}${p.latest_release_published ? ` · ${new Date(p.latest_release_published).toLocaleDateString()}` : ""}` : "—"}</div>
          <div className="col-span-2 md:col-span-3"><span className="text-neutral-500">Topics:</span> {topics.length ? topics.join(", ") : "—"}</div>
          <div className="col-span-2 md:col-span-3"><span className="text-neutral-500">Repository:</span> {p.repo ? <a className="text-teal-400" href={p.repo} target="_blank" rel="noreferrer">{p.repo}</a> : "—"}</div>
          <div className="col-span-2 md:col-span-3"><span className="text-neutral-500">CI:</span> {p.has_ci ? "GitHub Actions configured" : "—"}</div>
        </CardContent>
      </Card>

      {hasReadme && (
        <Card className="border-neutral-800/60 bg-neutral-900">
          <CardContent className="p-4">
            <div className="flex items-center justify-between mb-2">
              <h2 className="text-lg font-semibold">README</h2>
              {p.readme_excerpt && p.readme_excerpt.length > 600 && (
                <Button size="sm" variant="secondary" onClick={() => setExpanded((v) => !v)}>
                  {expanded ? "Collapse" : "Expand"}
                </Button>
              )}
            </div>
            <div className="prose dark:prose-invert max-w-none">
              <Markdown content={expanded ? (p.readme_excerpt as string) : (p.readme_excerpt as string).slice(0, 600) + (p.readme_excerpt!.length > 600 ? "..." : "")} />
            </div>
          </CardContent>
        </Card>
      )}

  <div className="pt-2">
        <Link href="/projects"><Button variant="ghost">← Back to projects</Button></Link>
      </div>
    </div>
  );
}
