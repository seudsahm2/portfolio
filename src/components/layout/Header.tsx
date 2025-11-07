"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useState } from "react";
import ThemeToggle from "./ThemeToggle";

function NavLink({ href, children }: { href: string; children: React.ReactNode }) {
  const pathname = usePathname();
  const active = pathname === href || (href !== "/" && pathname?.startsWith(href));
  return (
    <Link
      href={href}
      className={[
        "px-3 py-1.5 rounded-md text-sm transition-colors",
        active
          ? "bg-neutral-900 text-white dark:bg-white dark:text-black"
          : "hover:bg-neutral-100 dark:hover:bg-neutral-800",
      ].join(" ")}
    >
      {children}
    </Link>
  );
}

export default function Header() {
  const [open, setOpen] = useState(false);
  return (
    <header className="sticky top-0 z-40 backdrop-blur bg-white/70 dark:bg-neutral-950/70 border-b border-neutral-200 dark:border-neutral-800">
      <div className="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
        <Link href="/" className="font-semibold text-base">
          <span className="gradient-text">seud.dev</span>
        </Link>
        <div className="flex items-center gap-2 md:hidden">
          <ThemeToggle />
          <button aria-label="Menu" className="px-3 py-1.5 rounded-md border" onClick={() => setOpen((v) => !v)}>
            ☰
          </button>
        </div>
        <nav className="hidden md:flex items-center gap-2">
          <NavLink href="/about">About</NavLink>
          <NavLink href="/projects">Projects</NavLink>
          <NavLink href="/skills">Skills</NavLink>
          <NavLink href="/experiences">Experience</NavLink>
          <NavLink href="/blog">Blog</NavLink>
          <NavLink href="/contact">Contact</NavLink>
          <ThemeToggle />
          <Link href="/contact" className="ml-2 px-3 py-1.5 rounded-md bg-neutral-900 text-white dark:bg-white dark:text-black text-sm">
            Hire me
          </Link>
        </nav>
      </div>
      {open && (
        <div className="md:hidden border-t border-neutral-200 dark:border-neutral-800">
          <div className="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-2">
            <NavLink href="/about">About</NavLink>
            <NavLink href="/projects">Projects</NavLink>
            <NavLink href="/skills">Skills</NavLink>
            <NavLink href="/experiences">Experience</NavLink>
            <NavLink href="/blog">Blog</NavLink>
            <NavLink href="/contact">Contact</NavLink>
            <Link href="/contact" className="px-3 py-1.5 rounded-md bg-neutral-900 text-white dark:bg-white dark:text-black text-sm text-center">
              Hire me
            </Link>
          </div>
        </div>
      )}
    </header>
  );
}
