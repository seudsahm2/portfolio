import { notFound } from "next/navigation";
import BlogPostClient from "@/app/blog/PostClient";
import { API_BASE_URL } from "@/lib/env";

// NOTE: In production (Vercel) you MUST set NEXT_PUBLIC_API_BASE_URL to your deployed backend origin (e.g. https://api.yourdomain.com)
// Otherwise this will default to localhost and all server fetches will fail.
export default async function BlogPostBySlug({ params }: { params: { slug: string } }) {
  const { slug } = params;

  // Guard: if running in production build and API_BASE_URL points to localhost, emit a soft failure.
  if (process.env.NODE_ENV === "production" && /localhost|127\.0\.0\.1/.test(API_BASE_URL)) {
    console.error("[blog/[slug]] Missing production NEXT_PUBLIC_API_BASE_URL env; got", API_BASE_URL);
    return notFound();
  }

  let searchUrl: URL;
  try {
    searchUrl = new URL("/api/blogposts/", API_BASE_URL.endsWith("/") ? API_BASE_URL : API_BASE_URL + "/");
  } catch (e) {
    console.error("[blog/[slug]] Invalid API_BASE_URL", API_BASE_URL, e);
    return notFound();
  }
  searchUrl.searchParams.set("search", slug);

  const res = await fetch(searchUrl.toString(), { cache: "no-store" }).catch((e) => {
    console.error("[blog/[slug]] Fetch failed", searchUrl.toString(), e);
    return null;
  });
  if (!res || !res.ok) {
    console.error("[blog/[slug]] Bad response", res && res.status, searchUrl.toString());
    return notFound();
  }
  let data: { results: Array<{ id: number; slug: string }> } | null = null;
  try {
    data = (await res.json()) as { results: Array<{ id: number; slug: string }> };
  } catch (e) {
    console.error("[blog/[slug]] JSON parse error", e);
    return notFound();
  }
  const post = data.results.find((p) => p.slug === slug);
  if (!post) return notFound();
  return <BlogPostClient id={post.id} />;
}
