"use client";

import { useAddCommentMutation, useBlogPost, useBookmarkMutation, useComments, useLikeMutation, useRelatedPosts, useUnlikeMutation, useUnbookmarkMutation } from "@/lib/api.hooks";
import Markdown from "@/components/chat/Markdown";
import { useMemo, useState } from "react";

function MetaChip({ children }: { children: React.ReactNode }) {
  return (
    <span className="inline-flex items-center gap-1 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/80 backdrop-blur">
      {children}
    </span>
  );
}

function Tag({ children }: { children: React.ReactNode }) {
  return <span className="text-[10px] px-2 py-0.5 rounded-full bg-slate-800/80 text-slate-200 border border-slate-700/60">{children}</span>;
}

export default function BlogPostClient({ id }: { id: number }) {
  const q = useBlogPost(id);
  const b = q.data;
  const related = useRelatedPosts(id);
  const comments = useComments(id);
  const like = useLikeMutation(id);
  const unlike = useUnlikeMutation(id);
  const bookmark = useBookmarkMutation(id);
  const unbookmark = useUnbookmarkMutation(id);
  const addComment = useAddCommentMutation(id);
  const [commentName, setCommentName] = useState("");
  const [commentEmail, setCommentEmail] = useState("");
  const [commentText, setCommentText] = useState("");

  const formattedDate = useMemo(() => (b ? new Date(b.published_at).toLocaleDateString(undefined, { year: "numeric", month: "long", day: "numeric" }) : ""), [b]);
  const cover = b?.cover_image_url || undefined;

  if (q.isLoading) {
    return (
      <div className="mx-auto max-w-5xl px-4 py-10">
        <div className="h-64 w-full rounded-2xl bg-gradient-to-r from-slate-800/30 to-slate-700/30 animate-pulse" />
        <div className="mt-6 h-8 w-2/3 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
        <div className="mt-3 h-4 w-1/3 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
        <div className="mt-6 h-40 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
      </div>
    );
  }
  if (q.isError || !b) {
    return <div className="max-w-3xl mx-auto px-4 py-8 text-red-600">Failed to load post.</div>;
  }

  return (
    <div className="min-h-[60vh]">
      {/* Hero */}
      <section className="relative mx-auto max-w-6xl px-4 pt-6">
        <div className="relative overflow-hidden rounded-2xl border border-white/10">
          {/* background */}
          <div className="relative h-64 md:h-80 w-full bg-gradient-to-br from-teal-700 via-slate-800 to-slate-900">
            {cover ? (
              // eslint-disable-next-line @next/next/no-img-element
              <img src={cover} alt="cover" className="absolute inset-0 h-full w-full object-cover opacity-30" />
            ) : null}
            <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent" />
            <div className="absolute inset-x-0 bottom-0 p-6 md:p-8">
              <div className="mb-3 flex flex-wrap items-center gap-2">
                <MetaChip>{formattedDate}</MetaChip>
                <MetaChip>{(b.reading_time || 1)} min read</MetaChip>
                {b.featured && <MetaChip>Featured</MetaChip>}
                {Array.isArray(b.tags) && b.tags.slice(0, 4).map((t) => <MetaChip key={t}>#{t}</MetaChip>)}
              </div>
              <h1 className="text-balance text-3xl md:text-5xl font-semibold tracking-tight text-white drop-shadow-sm">
                {b.title}
              </h1>
              {b.summary && <p className="mt-2 max-w-3xl text-slate-200/90">{b.summary}</p>}
            </div>
          </div>
          {/* actions bar */}
          <div className="flex flex-wrap items-center justify-between gap-3 border-t border-white/10 bg-black/20 px-4 py-3 backdrop-blur">
            <div className="flex flex-wrap items-center gap-2">
              <button onClick={() => like.mutate()} className="inline-flex items-center gap-2 rounded-full border border-pink-500/40 bg-pink-600/20 px-4 py-1.5 text-sm text-pink-100 hover:bg-pink-600/30">
                <span>❤️</span> Like <span className="opacity-80">{b.likes_count}</span>
              </button>
              <button onClick={() => unlike.mutate()} className="text-xs rounded-full border border-white/10 px-3 py-1.5 text-slate-200 hover:bg-white/5">Undo</button>
              <div className="mx-2 h-5 w-px bg-white/10" />
              <button onClick={() => bookmark.mutate()} className="inline-flex items-center gap-2 rounded-full border border-amber-500/40 bg-amber-500/20 px-4 py-1.5 text-sm text-amber-100 hover:bg-amber-500/30">
                <span>🔖</span> Bookmark <span className="opacity-80">{b.bookmarks_count}</span>
              </button>
              <button onClick={() => unbookmark.mutate()} className="text-xs rounded-full border border-white/10 px-3 py-1.5 text-slate-200 hover:bg-white/5">Undo</button>
            </div>
            <div className="flex items-center gap-2">
              <button
                onClick={() => {
                  try {
                    const href = typeof window !== "undefined" ? window.location.href : "";
                    if (href) navigator.clipboard.writeText(href);
                  } catch {}
                }}
                className="text-xs rounded-full border border-white/10 px-3 py-1.5 text-slate-200 hover:bg-white/5"
              >
                Copy link
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* Content */}
      <article className="mx-auto mt-8 grid max-w-6xl grid-cols-1 gap-8 px-4 md:grid-cols-12">
        <div className="md:col-span-9">
          {b.content && b.content_format === "markdown" ? (
            <Markdown content={b.content} />
          ) : b.content ? (
            <div className="prose dark:prose-invert max-w-none whitespace-pre-line leading-7">{b.content}</div>
          ) : null}
        </div>
        <aside className="md:col-span-3 space-y-4">
          {Array.isArray(b.tags) && b.tags.length > 0 && (
            <div className="rounded-xl border border-white/10 bg-white/5 p-4">
              <div className="mb-2 text-sm font-medium text-slate-200">Tags</div>
              <div className="flex flex-wrap gap-2">
                {b.tags.map((t) => (
                  <Tag key={t}>#{t}</Tag>
                ))}
              </div>
            </div>
          )}
          <div className="rounded-xl border border-white/10 bg-white/5 p-4 text-xs text-slate-300">
            <div>Published</div>
            <div className="mt-1 text-slate-200">{formattedDate}</div>
            <div className="mt-3">Estimated read</div>
            <div className="mt-1 text-slate-200">{b.reading_time || 1} minutes</div>
          </div>
        </aside>
      </article>

      {/* Comments */}
      <section className="mx-auto mt-10 max-w-6xl px-4">
        <div className="rounded-2xl border border-white/10 bg-white/5 p-5">
          <h2 className="mb-4 text-lg font-semibold">Comments ({b.comments_count})</h2>
          {comments.isLoading ? (
            <div className="h-20 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
          ) : comments.isError ? (
            <div className="text-sm text-red-500">Failed to load comments.</div>
          ) : (
            <div className="space-y-3">
              {(comments.data || []).map((c) => (
                <div key={c.id} className="flex gap-3 rounded-lg border border-white/10 bg-black/10 p-3">
                  <div className="flex h-8 w-8 items-center justify-center rounded-full bg-slate-700 text-xs text-white">
                    {c.name?.[0]?.toUpperCase() || "?"}
                  </div>
                  <div className="min-w-0">
                    <div className="text-xs text-neutral-400">
                      {c.name || "Anonymous"} • {new Date(c.created_at).toLocaleString()}
                    </div>
                    <div className="mt-1 whitespace-pre-wrap text-sm">{c.content}</div>
                  </div>
                </div>
              ))}
            </div>
          )}
          <form
            className="mt-4 grid grid-cols-1 gap-2 md:grid-cols-12"
            onSubmit={(e) => {
              e.preventDefault();
              const text = commentText.trim();
              if (!text) return;
              addComment.mutate(
                { content: text, name: commentName.trim() || undefined, email: commentEmail.trim() || undefined },
                {
                  onSuccess: () => {
                    setCommentText("");
                    setCommentName("");
                    setCommentEmail("");
                  }
                }
              );
            }}
          >
            <input
              type="text"
              value={commentName}
              onChange={(e) => setCommentName(e.target.value)}
              placeholder="Name (optional)"
              className="md:col-span-4 rounded border border-neutral-700/40 bg-transparent px-3 py-2 text-sm"
            />
            <input
              type="email"
              value={commentEmail}
              onChange={(e) => setCommentEmail(e.target.value)}
              placeholder="Email (optional)"
              className="md:col-span-4 rounded border border-neutral-700/40 bg-transparent px-3 py-2 text-sm"
            />
            <div className="md:col-span-12 flex gap-2">
              <input
                type="text"
                value={commentText}
                onChange={(e) => setCommentText(e.target.value)}
                placeholder="Write a comment…"
                className="flex-1 rounded border border-neutral-700/40 bg-transparent px-3 py-2 text-sm"
              />
              <button type="submit" className="text-sm px-4 py-2 rounded border border-teal-600/40 bg-teal-700/50 text-teal-100 hover:bg-teal-700/60">
                Post
              </button>
            </div>
          </form>
        </div>
      </section>

      {/* Related */}
      {related.data && related.data.length > 0 && (
        <section className="mx-auto my-10 max-w-6xl px-4">
          <h3 className="mb-3 text-base font-semibold">Related posts</h3>
          <div className="grid gap-4 md:grid-cols-3">
            {related.data.map((r) => (
              <a key={r.id} className="block rounded-xl border border-white/10 bg-white/5 p-4 hover:border-teal-400/50" href={`/blog/${r.slug}`}>
                <div className="text-sm text-slate-400">{new Date(r.published_at).toLocaleDateString()}</div>
                <div className="mt-1 line-clamp-2 font-medium text-slate-100">{r.title}</div>
              </a>
            ))}
          </div>
        </section>
      )}
    </div>
  );
}
