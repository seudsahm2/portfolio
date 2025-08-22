"use client";

import { useBlogPost } from "@/lib/api.hooks";
import { useAuthGuard } from "@/lib/useAuthGuard";

export default function BlogPostClient({ id }: { id: number }) {
  useAuthGuard();
  const q = useBlogPost(id);
  const b = q.data;

  if (q.isLoading) {
    return (
      <div className="max-w-3xl mx-auto px-4 py-8 space-y-3">
        <div className="h-7 w-72 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
        <div className="h-4 w-56 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
        <div className="h-40 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
      </div>
    );
  }
  if (q.isError || !b) {
    return <div className="max-w-3xl mx-auto px-4 py-8 text-red-600">Failed to load post.</div>;
  }

  const cover = b.cover_image_url || b.cover_image || undefined;

  return (
    <article className="max-w-3xl mx-auto px-4 py-8 space-y-4">
      <header className="space-y-1">
        <h1 className="text-2xl font-semibold">{b.title}</h1>
        <div className="text-sm text-neutral-600 dark:text-neutral-400">{new Date(b.published_at).toLocaleString()}</div>
      </header>
      {cover ? (
        // eslint-disable-next-line @next/next/no-img-element
        <img src={cover} alt="" className="w-full h-64 object-cover rounded-lg" />
      ) : null}
      {b.summary && (
        <p className="text-neutral-800 dark:text-neutral-200">{b.summary}</p>
      )}
      {b.content && (
        <div className="prose dark:prose-invert max-w-none whitespace-pre-line leading-7">{b.content}</div>
      )}
    </article>
  );
}
