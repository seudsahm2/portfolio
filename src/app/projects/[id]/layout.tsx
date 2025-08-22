import type { Metadata, ResolvingMetadata } from "next";
import { client } from "@/lib/api.client";

export const revalidate = 60; // ISR: revalidate every minute

export async function generateMetadata(
  { params }: { params: { id: string } },
  _parent: ResolvingMetadata
): Promise<Metadata> {
  const id = Number(params.id);
  try {
    const p = await client.getProject(id);
    const title = p.title ?? "Project";
    const description = p.description || "Project details and tech stack";
    const image = p.image_url || p.image || undefined;
    const url = `/projects/${id}`;
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
    return { title: "Project", description: "Project details" };
  }
}

export default function ProjectLayout({ children }: { children: React.ReactNode }) {
  return children;
}
