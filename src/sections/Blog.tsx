"use client";
import { useBlogPosts, useBlogSeries } from "@/lib/api.hooks";
import Link from "next/link";
import { Card, CardContent } from "@/components/ui";

export function BlogSection() {
  const posts = useBlogPosts();
  const series = useBlogSeries();
  const ordered = (posts.data || []).slice().sort((a, b) => {
    // Pinned first (ascending pinned_order, non-zero), then featured, then recent published_at
    const ap = a.pinned_order || 0;
    const bp = b.pinned_order || 0;
    if (ap !== bp) {
      if (ap === 0) return 1;
      if (bp === 0) return -1;
      return ap - bp;
    }
    if (a.featured !== b.featured) return a.featured ? -1 : 1;
    return new Date(b.published_at).getTime() - new Date(a.published_at).getTime();
  });
  return (
    <section id="blog" data-section="blog" className="scroll-mt-24">
      <div className="max-w-7xl mx-auto px-5 md:px-8 py-10">
        <header className="mb-6 flex items-center justify-between">
          <h2 className="text-3xl font-semibold text-teal-300">Blog</h2>
          <span className="text-xs text-slate-400">{posts.data ? posts.data.length : 0} posts</span>
        </header>
        {series.data && series.data.length > 0 && (
          <div className="mb-8 flex gap-3 overflow-x-auto pb-2">
            {series.data.map((s) => (
              <div key={s.id} className="shrink-0 px-3 py-1 rounded-full bg-teal-900/40 text-teal-200 text-xs border border-teal-700/40">
                {s.title}
              </div>
            ))}
          </div>
        )}
        {posts.isLoading ? (
          <div className="grid md:grid-cols-3 gap-5">
            {Array.from({ length: 6 }).map((_, i) => (
              <div key={i} className="h-32 rounded-xl bg-slate-800/40 animate-pulse" />
            ))}
          </div>
        ) : posts.isError ? (
          <div className="text-red-500 text-sm">Failed to load blog posts.</div>
        ) : (
          <div className="grid md:grid-cols-3 gap-5">
            {ordered.map((b) => (
              <Link key={b.id} href={`/blog/${b.slug}`} className="block">
                <Card className="h-full border-slate-700 bg-slate-900 hover:border-teal-400 transition-colors">
                  <CardContent className="p-5 space-y-2">
                    <div className="flex items-center gap-2">
                      {b.featured && <span className="text-[10px] px-2 py-1 rounded-full bg-pink-600/20 text-pink-300 border border-pink-500/30">Featured</span>}
                      {b.pinned_order ? <span className="text-[10px] px-2 py-1 rounded-full bg-teal-600/20 text-teal-200 border border-teal-500/30">Pinned</span> : null}
                      <span className="text-[10px] px-2 py-1 rounded-full bg-slate-700/40 text-slate-300">{b.reading_time || 1} min</span>
                    </div>
                    <div className="font-medium text-slate-100 line-clamp-2">{b.title}</div>
                    {b.summary && <p className="text-sm text-slate-400 line-clamp-4">{b.summary}</p>}
                    {Array.isArray(b.tags) && b.tags.length > 0 && (
                      <div className="flex flex-wrap gap-1 pt-1">
                        {(b.tags as string[]).slice(0, 6).map((t: string) => (
                          <span key={t} className="text-[10px] px-1.5 py-0.5 rounded bg-slate-800 text-slate-300 border border-slate-700/60">
                            {t}
                          </span>
                        ))}
                      </div>
                    )}
                  </CardContent>
                </Card>
              </Link>
            ))}
          </div>
        )}
      </div>
    </section>
  );
}
