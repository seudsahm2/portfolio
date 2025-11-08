"use client";
import { Hero } from "@/sections/Hero";
import { SkillsSection } from "@/sections/Skills";
import { ProjectsSection } from "@/sections/Projects";
import { ExperienceSection } from "@/sections/Experience";
import { BlogSection } from "@/sections/Blog";
import { ContactSection } from "@/sections/Contact";

export default function Home() {
  return (
    <main className="space-y-24">
      <Hero />
      <SkillsSection />
      <ProjectsSection />
      <ExperienceSection />
      <BlogSection />
      <ContactSection />
    </main>
  );
}
