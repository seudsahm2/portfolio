"use client";
import { useBlogPosts } from "@/lib/api.hooks";
import { Card, CardContent } from "@/components/ui";

export function BlogSection() {
  const posts = useBlogPosts();
  return (
    <section id="blog" data-section="blog" className="scroll-mt-24">
      <div className="max-w-7xl mx-auto px-5 md:px-8 py-10">
        <header className="mb-6 flex items-center justify-between">
          <h2 className="text-3xl font-semibold text-teal-300">Blog</h2>
          <span className="text-xs text-slate-400">{posts.data ? posts.data.length : 0} posts</span>
        </header>
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
            {(posts.data || []).map((b) => (
              <Card key={b.id} className="border-slate-700 bg-slate-900 hover:border-teal-400 transition-colors">
                <CardContent className="p-5 space-y-2">
                  <div className="font-medium text-slate-100">{b.title}</div>
                  {b.summary && <p className="text-sm text-slate-400 line-clamp-4">{b.summary}</p>}
                </CardContent>
              </Card>
            ))}
          </div>
        )}
      </div>
    </section>
  );
}
