import type { MetadataRoute } from "next";
import { env } from "@/lib/env";

async function fetchAll<T>(url: string): Promise<T[]> {
  const items: T[] = [];
  let next: string | null = url;
  for (let i = 0; i < 10 && next; i++) {
    try {
      const res = await fetch(next, { cache: "force-cache" });
      if (!res.ok) break;
      const data = (await res.json()) as {
        results?: T[];
        next?: string | null;
      } | T[];
      const isPaginated = (v: unknown): v is { results?: T[]; next?: string | null } =>
        typeof v === "object" && v !== null && Array.isArray((v as { results?: unknown }).results);
      if (isPaginated(data)) {
        if (data.results) items.push(...data.results);
        next = data.next ?? null;
      } else if (Array.isArray(data)) {
        items.push(...data);
        next = null;
      } else {
        break;
      }
    } catch {
      break;
    }
  }
  return items;
}

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
  const site = env.NEXT_PUBLIC_SITE_URL;
  const api = env.NEXT_PUBLIC_API_BASE_URL;

  // Static routes
  const base: MetadataRoute.Sitemap = [
    "/",
    "/about",
    "/projects",
    "/skills",
    "/experiences",
    "/blog",
    "/contact",
  ].map((path) => ({ url: `${site}${path}`, lastModified: new Date(), changeFrequency: "weekly", priority: 0.7 }));

  // Dynamic routes: projects and blogposts
  const [projects, posts] = await Promise.all([
    fetchAll<{ id: number }>(`${api}/api/projects/?page=1`),
    fetchAll<{ id: number }>(`${api}/api/blogposts/?page=1`),
  ]);

  const projectRoutes: MetadataRoute.Sitemap = projects.map((p) => ({
    url: `${site}/projects/${p.id}`,
    lastModified: new Date(),
    changeFrequency: "weekly",
    priority: 0.8,
  }));
  const postRoutes: MetadataRoute.Sitemap = posts.map((b) => ({
    url: `${site}/blog/${b.id}`,
    lastModified: new Date(),
    changeFrequency: "weekly",
    priority: 0.6,
  }));

  return [...base, ...projectRoutes, ...postRoutes];
}
