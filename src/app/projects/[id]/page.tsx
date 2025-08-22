import ProjectDetailClient from "./ProjectDetailClient";
import { client } from "@/lib/api.client";

export const revalidate = 60; // ISR per project

export default async function ProjectDetailPage({ params }: { params: { id: string } }) {
  const id = Number(params.id);
  // Fetch on server for faster TTFB (and to populate dynamic metadata from layout)
  // If this fails, the client component will load it as well.
  try {
    await client.getProject(id);
  } catch {}
  return <ProjectDetailClient id={id} />;
}
