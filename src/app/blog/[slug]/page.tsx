import { notFound } from "next/navigation";
import BlogPostClient from "@/app/blog/PostClient";
import { API_BASE_URL } from "@/lib/env";

export default async function BlogPostBySlug({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  // Server-side fetch: avoid client-only http helper to prevent RSC boundary issues
  const url = new URL("/api/blogposts/", API_BASE_URL + "/");
  url.searchParams.set("search", slug);
  const res = await fetch(url.toString(), { cache: "no-store" });
  if (!res.ok) return notFound();
  const data = (await res.json()) as { results: Array<{ id: number; slug: string }> };
  const post = data.results.find((p) => p.slug === slug);
  if (!post) return notFound();
  return <BlogPostClient id={post.id} />;
}
