import ProjectDetailClient from "./ProjectDetailClient";
import { client } from "@/lib/api.client";

export const revalidate = 60; // ISR per project

export default async function ProjectDetailPage({ params }: { params: Promise<{ id: string }> }) {
  const { id: idStr } = await params;
  const id = Number(idStr);
  // Fetch on server for faster TTFB (and to populate dynamic metadata from layout)
  // If this fails, the client component will load it as well.
  try {
    await client.getProject(id);
  } catch {}
  return <ProjectDetailClient id={id} />;
}
