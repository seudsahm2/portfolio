"use client";

import Link from "next/link";
import { useProfiles } from "@/lib/api.hooks";

export default function AboutPage() {
  const q = useProfiles();
  const profile = q.data?.[0];

  return (
    <div className="max-w-3xl mx-auto px-4 py-10 space-y-4">
      <h1 className="text-3xl font-semibold gradient-text">About</h1>

      {q.isLoading ? (
        <div className="space-y-3">
          <div className="h-6 w-40 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
          <div className="h-4 w-64 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
          <div className="h-24 rounded bg-black/5 dark:bg-white/5 animate-pulse" />
        </div>
      ) : q.isError ? (
        <div className="text-red-600">Failed to load profile.</div>
      ) : !profile ? (
        <p className="text-neutral-600 dark:text-neutral-300">No profile yet.</p>
      ) : (
        <article className="space-y-3 rounded-xl gradient-border p-6 bg-white/70 dark:bg-neutral-900/70 hover-card">
          <div>
            <div className="text-xl font-medium">{profile.full_name}</div>
            {profile.title && (
              <div className="text-neutral-600 dark:text-neutral-300">{profile.title}</div>
            )}
          </div>
          {profile.bio && (
            <p className="leading-7 text-neutral-800 dark:text-neutral-200 whitespace-pre-line">
              {profile.bio}
            </p>
          )}
          <ul className="text-sm text-neutral-700 dark:text-neutral-300 space-y-1">
            {profile.email && (
              <li>
                Email: <a className="underline underline-offset-4" href={`mailto:${profile.email}`}>{profile.email}</a>
              </li>
            )}
            {profile.website && (
              <li>
                Website: <a className="underline underline-offset-4" href={profile.website} target="_blank" rel="noreferrer">{profile.website}</a>
              </li>
            )}
            {profile.location && (
              <li>Location: {profile.location}</li>
            )}
          </ul>
          <div className="pt-2 text-sm">
            <Link href="/projects" className="underline underline-offset-4">View projects</Link>
            <span className="mx-2">•</span>
            <Link href="/blog" className="underline underline-offset-4">Read blog</Link>
            <span className="mx-2">•</span>
            <Link href="/contact" className="underline underline-offset-4">Contact</Link>
          </div>
        </article>
      )}
    </div>
  );
}
