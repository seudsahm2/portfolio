import ProjectDetailClient from "./ProjectDetailClient";

type ParamsPromise = Promise<{ id: string }>;

export default async function ProjectDetailPage({ params }: { params: ParamsPromise }) {
  const { id: idStr } = await params;
  const id = Number(idStr);
  if (!Number.isFinite(id)) return null;
  return <ProjectDetailClient id={id} />;
}
