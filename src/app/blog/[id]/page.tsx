import BlogPostClient from "./BlogPostClient";
import { client } from "@/lib/api.client";
import Link from "next/link";

export const revalidate = 60;

export default async function BlogPostPage({ params }: { params: { id: string } }) {
  const id = Number(params.id);
  let prevId: number | null = null;
  let nextId: number | null = null;
  try {
    const data = await client.listBlogPosts();
    const idx = data.results.findIndex((p) => p.id === id);
    if (idx !== -1) {
      prevId = data.results[idx - 1]?.id ?? null;
      nextId = data.results[idx + 1]?.id ?? null;
    }
  } catch {}

  return (
    <div>
      <BlogPostClient id={id} />
      <nav className="max-w-3xl mx-auto px-4 pb-10 flex items-center justify-between text-sm">
        <div>
          {prevId ? (
            <Link href={`/blog/${prevId}`} className="underline underline-offset-4">← Previous</Link>
          ) : <span />}
        </div>
        <div>
          {nextId ? (
            <Link href={`/blog/${nextId}`} className="underline underline-offset-4">Next →</Link>
          ) : <span />}
        </div>
      </nav>
    </div>
  );
}
