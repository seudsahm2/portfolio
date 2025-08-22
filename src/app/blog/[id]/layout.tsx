import type { Metadata, ResolvingMetadata } from "next";
import { client } from "@/lib/api.client";

export const revalidate = 60;

export async function generateMetadata(
  { params }: { params: { id: string } },
  _parent: ResolvingMetadata
): Promise<Metadata> {
  const id = Number(params.id);
  try {
    const p = await client.getBlogPost(id);
    const title = p.title ?? "Blog";
    const description = p.summary || p.content?.slice(0, 140) || "Blog post";
    const url = `/blog/${id}`;
    const image = p.cover_image_url || p.cover_image || undefined;
    return {
      title,
      description,
      alternates: { canonical: url },
      openGraph: {
        title,
        description,
        url,
        type: "article",
        images: image ? [{ url: image }] : undefined,
      },
      twitter: {
        card: image ? "summary_large_image" : "summary",
        title,
        description,
        images: image ? [image] : undefined,
      },
    };
  } catch {
    return { title: "Blog", description: "Blog post" };
  }
}

export default function BlogPostLayout({ children }: { children: React.ReactNode }) {
  return children;
}
