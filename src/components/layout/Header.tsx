"use client";

import { useEffect, useState } from "react";
import ThemeToggle from "./ThemeToggle";

const SECTIONS = [
  { id: "about", label: "About" },
  { id: "skills", label: "Skills" },
  { id: "projects", label: "Projects" },
  { id: "experiences", label: "Experience" },
  { id: "blog", label: "Blog" },
  { id: "contact", label: "Contact" },
];

export default function Header() {
  const [open, setOpen] = useState(false);
  const [active, setActive] = useState<string>(SECTIONS[0].id);

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        const topMost = entries
          .filter((e) => e.isIntersecting)
          .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top)[0];
        const id = topMost?.target.getAttribute("data-section");
        if (id) setActive(id);
      },
      { root: null, rootMargin: "0px 0px -60% 0px", threshold: 0.2 }
    );
    SECTIONS.forEach((s) => {
      const el = document.getElementById(s.id);
      if (el) observer.observe(el);
    });
    return () => observer.disconnect();
  }, []);

  // Smooth scrolling handled natively via anchor hashes and CSS (html { scroll-behavior: smooth; })

  return (
    <header className="sticky top-0 z-40 backdrop-blur bg-slate-900/70 border-b border-slate-800">
      <div className="max-w-7xl mx-auto px-4 h-14 flex items-center justify-between">
        <a href="#about" className="font-semibold text-base">
          <span className="gradient-text">seud.dev</span>
        </a>
        <div className="flex items-center gap-2 md:hidden">
          <ThemeToggle />
          <button aria-label="Menu" className="px-3 py-1.5 rounded-md border border-slate-700 text-slate-200" onClick={() => setOpen((v) => !v)}>
            ☰
          </button>
        </div>
        <nav className="hidden md:flex items-center gap-2">
          {SECTIONS.map((s) => (
            <a
              key={s.id}
              href={`#${s.id}`}
              className={[
                "px-3 py-1.5 rounded-full text-sm transition-colors",
                active === s.id ? "bg-teal-500 text-slate-900" : "bg-slate-800 text-slate-300 hover:bg-slate-700",
              ].join(" ")}
            >
              {s.label}
            </a>
          ))}
          <ThemeToggle />
          <a
            href="#contact"
            className="ml-2 px-3 py-1.5 rounded-md bg-teal-500 text-slate-900 text-sm"
          >
            Hire me
          </a>
        </nav>
      </div>
      {open && (
        <div className="md:hidden border-t border-slate-800">
          <div className="max-w-7xl mx-auto px-4 py-3 flex flex-col gap-2">
            {SECTIONS.map((s) => (
              <a
                key={s.id}
                href={`#${s.id}`}
                className={[
                  "px-3 py-1.5 rounded-md text-sm transition-colors",
                  active === s.id ? "bg-teal-500 text-slate-900" : "bg-slate-800 text-slate-300 hover:bg-slate-700",
                ].join(" ")}
              >
                {s.label}
              </a>
            ))}
            <a
              href="#contact"
              className="px-3 py-1.5 rounded-md bg-teal-500 text-slate-900 text-sm text-center"
            >
              Hire me
            </a>
          </div>
        </div>
      )}
    </header>
  );
}
