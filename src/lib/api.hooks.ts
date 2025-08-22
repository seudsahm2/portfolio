"use client";

import { useInfiniteQuery, useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { client } from "./api.client";
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

export function useBlogPosts() {
	return useQuery({
		queryKey: qk.blog,
		queryFn: client.listBlogPosts,
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

