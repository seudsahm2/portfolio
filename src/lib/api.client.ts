import { api } from "./http";
import type { components } from "./api.types";

// Local types for schemas not emitted by the OpenAPI generator (inline responses)
export type KnowledgeSources = {
	total: number;
	counts: Record<string, number>;
	github_code_samples: string[];
};

// Inferred helpers
type ListResp<T> = {
	count: number;
	next: string | null;
	previous: string | null;
	results: T[];
};

export const client = {
	// Lists
	listProjects: (params?: {
		page?: number;
		search?: string;
		featured?: boolean;
		skills__name?: string;
		ordering?: string;
	}) =>
		api.get<ListResp<components["schemas"]["Project"]>>("/api/projects/", params),

	getProject: (id: number) =>
		api.get<components["schemas"]["Project"]>(`/api/projects/${id}/`),
	listBlogPosts: () =>
		api.get<ListResp<components["schemas"]["BlogPost"]>>("/api/blogposts/"),
	getBlogPost: (id: number) =>
		api.get<components["schemas"]["BlogPost"]>(`/api/blogposts/${id}/`),
	listExperiences: () =>
		api.get<ListResp<components["schemas"]["Experience"]>>(
			"/api/experiences/"
		),
	listSkills: () =>
		api.get<ListResp<components["schemas"]["Skill"]>>("/api/skills/"),
	listProfiles: () =>
		api.get<ListResp<components["schemas"]["Profile"]>>("/api/profiles/"),
	getKnowledgeSources: () => api.get<KnowledgeSources>("/api/knowledge/sources"),

	// Actions
	contact: (body: components["schemas"]["Contact"]) =>
		api.post<unknown, components["schemas"]["Contact"]>(
			"/api/contact",
			body
		),
	chatAsk: (body: components["schemas"]["ChatAsk"]) =>
		api.post<components["schemas"]["ChatLog"], components["schemas"]["ChatAsk"]>(
			"/api/chat/ask",
			body
		),

	// GitHub pinned ingestion (admin-only)
	ingestPinned: (body?: { username?: string }) =>
		api.post<components["schemas"]["Project"][], { username?: string } | undefined>(
			"/api/github/ingest_pinned",
			body
		),
};

