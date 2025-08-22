"use client";

import { useProfiles } from "@/lib/api.hooks";

function ScriptTag({ json }: { json: unknown }) {
  return (
  <script type="application/ld+json" dangerouslySetInnerHTML={{ __html: JSON.stringify(json) }} />
  );
}

export default function SeoJsonLd() {
  const profiles = useProfiles();
  const p = profiles.data?.[0];
  const name = p?.full_name || "Seud";
  const title = p?.title || "Software Developer";
  const url = typeof window !== "undefined" ? window.location.origin : "";

  const person = {
    "@context": "https://schema.org",
    "@type": "Person",
    name,
    jobTitle: title,
    url,
  };

  const website = {
    "@context": "https://schema.org",
    "@type": "WebSite",
    name: "Seud Portfolio",
    url,
    potentialAction: {
      "@type": "SearchAction",
      target: `${url}/search?q={search_term_string}`,
      "query-input": "required name=search_term_string",
    },
  };

  return (
    <>
      <ScriptTag json={person} />
      <ScriptTag json={website} />
    </>
  );
}
