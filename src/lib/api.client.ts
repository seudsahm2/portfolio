import { api } from "./http";
import type { components } from "./api.types";

// Local supplemental types where OpenAPI schema lacks granular models (e.g., comments endpoints)
export interface BlogComment {
	id: number;
	post: number;
	parent?: number | null;
	name: string;
	email?: string;
	content: string;
	created_at: string;
	updated_at: string;
}

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
	listBlogPosts: (params?: { page?: number; search?: string; ordering?: string }) =>
		api.get<ListResp<components["schemas"]["BlogPost"]>>("/api/blogposts/", params),
	getBlogPost: (id: number) =>
		api.get<components["schemas"]["BlogPost"]>(`/api/blogposts/${id}/`),
	getBlogPostBySlug: async (slug: string) => {
		// Use search filter then exact match fallback
		const data = await api.get<ListResp<components["schemas"]["BlogPost"]>>("/api/blogposts/", { search: slug });
		return data.results.find((p) => p.slug === slug);
	},
	getRelatedPosts: (id: number) =>
		api.get<components["schemas"]["BlogPost"][]>(`/api/blogposts/${id}/related/`),
	listBlogSeries: () =>
		api.get<ListResp<components["schemas"]["BlogSeries"]>>("/api/blogseries/"),
	likePost: (id: number) => api.post<{ likes: number }>(`/api/blogposts/${id}/like/`),
	unlikePost: (id: number) => api.delete<{ likes: number }>(`/api/blogposts/${id}/unlike/`),
	bookmarkPost: (id: number) => api.post<{ bookmarks: number }>(`/api/blogposts/${id}/bookmark/`),
	unbookmarkPost: (id: number) => api.delete<{ bookmarks: number }>(`/api/blogposts/${id}/unbookmark/`),
	listComments: (id: number) => api.get<BlogComment[]>(`/api/blogposts/${id}/comments/`),
	addComment: (id: number, body: { name?: string; email?: string; content: string; parent?: number }) =>
		api.post<BlogComment, { name?: string; email?: string; content: string; parent?: number }>(
			`/api/blogposts/${id}/comments/`,
			body
		),
	subscribe: (email: string) => api.post<{ email: string; verified: boolean; active: boolean }, { email: string }>("/api/blog/subscribe", { email }),
	verifySubscription: (token: string) => api.post<{ email: string; verified: boolean; active: boolean }, { token: string }>("/api/blog/verify", { token }),
	unsubscribe: (token: string) => api.post<unknown, { token: string }>("/api/blog/unsubscribe", { token }),
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

