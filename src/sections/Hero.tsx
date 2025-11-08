"use client";
import { useProfiles } from "@/lib/api.hooks";

export function Hero() {
  const profiles = useProfiles();
  const profile = profiles.data?.[0];
  return (
    <section id="about" data-section="about" className="scroll-mt-24 py-20">
      <div className="max-w-7xl mx-auto px-5 md:px-8 grid md:grid-cols-12 gap-10 items-start">
        <div className="md:col-span-7 space-y-6">
          <h1 className="text-5xl font-semibold tracking-tight bg-gradient-to-r from-teal-400 via-emerald-400 to-amber-300 text-transparent bg-clip-text">
            {profile?.full_name || "Your Name"}
          </h1>
          <p className="text-slate-300 text-lg max-w-[60ch] leading-relaxed">
            {profile?.bio || "Add a compelling professional summary here to replace the placeholder text."}
          </p>
          <div className="flex flex-wrap gap-3 pt-2">
            <a href="#contact" className="px-4 py-2 rounded-md bg-teal-500 text-slate-900 text-sm font-medium" onClick={(e) => { e.preventDefault(); document.getElementById("contact")?.scrollIntoView({ behavior: "smooth" }); }}>Get in touch</a>
            <button className="px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-200 text-sm font-medium">Download CV</button>
          </div>
        </div>
        <div className="md:col-span-5">
          {/* Placeholder for avatar / visual element */}
          <div className="aspect-square rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center text-slate-500 text-sm">
            Avatar / Illustration
          </div>
        </div>
      </div>
    </section>
  );
}
