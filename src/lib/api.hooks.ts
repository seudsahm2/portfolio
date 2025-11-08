"use client";

import { useInfiniteQuery, useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { client, type BlogComment } from "./api.client";
import type { components } from "./api.types";

export const qk = {
	projects: ["projects"] as const,
	project: (id: number) => ["project", id] as const,
	blog: ["blog"] as const,
	blogPost: (id: number) => ["blog", id] as const,
	experiences: ["experiences"] as const,
	skills: ["skills"] as const,
	knowledgeSources: ["knowledgeSources"] as const,
	profiles: ["profiles"] as const,
	profile: ["profile"] as const,
};

// Lists with placeholderData(prev) for fast hydration
export function useProjects() {
	return useQuery<
		{ count: number; next: string | null; previous: string | null; results: components["schemas"]["Project"][] },
		unknown,
		components["schemas"]["Project"][]
	>({
		queryKey: qk.projects,
		queryFn: () => client.listProjects(),
		select: (d) => d.results,
	});
}

export function useBlogPosts(params?: { page?: number; search?: string; ordering?: string }) {
	return useQuery({
		queryKey: [...qk.blog, params ?? {}],
		queryFn: () => client.listBlogPosts(params),
		select: (d) => d.results,
	});
}

export function useBlogPost(id: number) {
	return useQuery({
		queryKey: qk.blogPost(id),
		queryFn: () => client.getBlogPost(id),
		enabled: Number.isFinite(id),
	});
}

export function useExperiences() {
	return useQuery({
		queryKey: qk.experiences,
		queryFn: client.listExperiences,
		select: (d) => d.results,
	});
}

export function useSkills() {
	return useQuery({
		queryKey: qk.skills,
		queryFn: client.listSkills,
		select: (d) => d.results,
	});
}

export function useKnowledgeSources() {
	return useQuery({
		queryKey: qk.knowledgeSources,
		queryFn: client.getKnowledgeSources,
	});
}

export function useProfiles() {
	return useQuery({
		queryKey: qk.profiles,
		queryFn: client.listProfiles,
		select: (d) => d.results,
	});
}

// Convenience hook for singleton profile (first item) with memoized derivations
export function useProfile() {
	return useQuery<components["schemas"]["Profile"] | undefined>({
		queryKey: qk.profile,
		queryFn: async () => {
			const list = await client.listProfiles();
			return list.results[0];
		},
		select: (p) => p,
	});
}

export function useFeaturedProjects(limit = 3) {
	return useQuery<
		{ count: number; next: string | null; previous: string | null; results: components["schemas"]["Project"][] },
		unknown,
		components["schemas"]["Project"][]
	>({
		queryKey: [...qk.projects, "featured", limit],
		queryFn: () => client.listProjects(),
		select: (d) => d.results.filter((p) => !!p.featured).slice(0, limit),
	});
}
export function useProject(id: number) {
	return useQuery({
		queryKey: qk.project(id),
		queryFn: () => client.getProject(id),
		enabled: Number.isFinite(id),
	});
}

export function useProjectsInfinite(filters: {
	search?: string;
	featured?: boolean;
	skills__name?: string;
	ordering?: string;
}) {
	return useInfiniteQuery({
		queryKey: [...qk.projects, "infinite", filters],
		queryFn: ({ pageParam }) => client.listProjects({ page: pageParam as number | undefined, ...filters }),
		initialPageParam: 1,
		getNextPageParam: (last) => {
			if (!last.next) return undefined;
			try {
				const url = new URL(last.next);
				const p = url.searchParams.get("page");
				return p ? Number(p) : undefined;
			} catch {
				return undefined;
			}
		},
		select: (data) => ({
			count: data.pages[0]?.count ?? 0,
			items: data.pages.flatMap((p) => p.results),
			hasMore: Boolean(data.pages[data.pages.length - 1]?.next),
		}),
	});
}

// Mutations
export function useContactMutation() {
	const qc = useQueryClient();
	return useMutation({
		mutationFn: client.contact,
		onSuccess: () => {
			// No list to invalidate yet, but could toast or track
			qc.invalidateQueries({ queryKey: qk.knowledgeSources });
		},
	});
}

export function useChatAskMutation() {
	return useMutation<components["schemas"]["ChatLog"], unknown, components["schemas"]["ChatAsk"]>({
		mutationFn: client.chatAsk,
	});
}

// Admin-only pinned repo ingestion
export function useIngestPinnedMutation() {
	const qc = useQueryClient();
	return useMutation<components["schemas"]["Project"][], unknown, { username?: string } | undefined>({
		mutationFn: (body) => client.ingestPinned(body),
		onSuccess: () => {
			qc.invalidateQueries({ queryKey: qk.projects });
		},
	});
}

// Blog series
export function useBlogSeries() {
	return useQuery({
		queryKey: [...qk.blog, "series"],
		queryFn: client.listBlogSeries,
		select: (d) => d.results,
	});
}

// Related posts
export function useRelatedPosts(id: number) {
	return useQuery({
		queryKey: [...qk.blogPost(id), "related"],
		queryFn: () => client.getRelatedPosts(id),
		enabled: Number.isFinite(id),
	});
}

// Interactions: like / bookmark with optimistic updates
export function useLikeMutation(id: number) {
	const qc = useQueryClient();
	return useMutation({
		mutationFn: () => client.likePost(id),
		onSuccess: (res) => {
			qc.setQueryData<components["schemas"]["BlogPost"] | undefined>(qk.blogPost(id), (prev) => (prev ? { ...prev, likes_count: res.likes } : prev));
		},
	});
}

export function useUnlikeMutation(id: number) {
	const qc = useQueryClient();
	return useMutation({
		mutationFn: () => client.unlikePost(id),
		onSuccess: (res) => {
			qc.setQueryData<components["schemas"]["BlogPost"] | undefined>(qk.blogPost(id), (prev) => (prev ? { ...prev, likes_count: res.likes } : prev));
		},
	});
}

export function useBookmarkMutation(id: number) {
	const qc = useQueryClient();
	return useMutation({
		mutationFn: () => client.bookmarkPost(id),
		onSuccess: (res) => {
			qc.setQueryData<components["schemas"]["BlogPost"] | undefined>(qk.blogPost(id), (prev) => (prev ? { ...prev, bookmarks_count: res.bookmarks } : prev));
		},
	});
}

export function useUnbookmarkMutation(id: number) {
	const qc = useQueryClient();
	return useMutation({
		mutationFn: () => client.unbookmarkPost(id),
		onSuccess: (res) => {
			qc.setQueryData<components["schemas"]["BlogPost"] | undefined>(qk.blogPost(id), (prev) => (prev ? { ...prev, bookmarks_count: res.bookmarks } : prev));
		},
	});
}

// Comments
export function useComments(id: number) {
	return useQuery<BlogComment[]>({
		queryKey: [...qk.blogPost(id), "comments"],
		queryFn: () => client.listComments(id),
		enabled: Number.isFinite(id),
	});
}

export function useAddCommentMutation(id: number) {
	const qc = useQueryClient();
	return useMutation<BlogComment, unknown, { name?: string; email?: string; content: string; parent?: number }>({
		mutationFn: (body) => client.addComment(id, body),
		onSuccess: () => {
			qc.invalidateQueries({ queryKey: [...qk.blogPost(id), "comments"] });
			qc.invalidateQueries({ queryKey: qk.blogPost(id) });
		},
	});
}

// Subscriptions
export function useSubscribeMutation() {
	return useMutation<{ email: string; verified: boolean; active: boolean }, unknown, { email: string }>({
		mutationFn: ({ email }) => client.subscribe(email),
	});
}
export function useVerifySubscriptionMutation() {
	return useMutation<{ email: string; verified: boolean; active: boolean }, unknown, { token: string }>({
		mutationFn: ({ token }) => client.verifySubscription(token),
	});
}
export function useUnsubscribeMutation() {
	return useMutation<unknown, unknown, { token: string }>({
		mutationFn: ({ token }) => client.unsubscribe(token),
	});
}

