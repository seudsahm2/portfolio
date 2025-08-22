"use client";

import { useBlogPosts } from "@/lib/api.hooks";
import { Button } from "@/components/ui";
import { useAuthGuard } from "@/lib/useAuthGuard";
import Link from "next/link";

export default function BlogPage() {
  useAuthGuard();
  const q = useBlogPosts();
  const isEmpty = q.data && q.data.length === 0;
  return (
    <div className="max-w-6xl mx-auto px-4 py-8 space-y-4">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-semibold">Blog</h1>
        <Button onClick={() => q.refetch()} disabled={q.isFetching}>
          {q.isFetching ? "Refreshing..." : "Refresh"}
        </Button>
      </div>

      {q.isLoading ? (
        <ul className="space-y-3">
          {Array.from({ length: 4 }).map((_, i) => (
            <li key={i} className="h-16 rounded-lg bg-black/5 dark:bg-white/5 animate-pulse" />
          ))}
        </ul>
      ) : q.isError ? (
        <div className="text-red-600">Failed to load blog posts.</div>
      ) : isEmpty ? (
        <p className="text-neutral-600 dark:text-neutral-300">No posts yet.</p>
      ) : (
        <ul className="space-y-4">
          {q.data!.map((b) => (
            <li key={b.id} className="rounded-lg border p-4">
              <div className="flex items-center justify-between gap-4">
                <div className="font-medium">
                  <Link href={`/blog/${b.id}`}>{b.title}</Link>
                </div>
                <div className="text-sm text-neutral-600 dark:text-neutral-400">
                  {new Date(b.published_at).toLocaleDateString()}
                </div>
              </div>
              {b.summary && (
                <p className="text-sm text-neutral-600 dark:text-neutral-300 mt-1">
                  {b.summary}
                </p>
              )}
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}
