import Link from "next/link";
import ThemeToggle from "./ThemeToggle";

export default function Header() {
  return (
    <header className="sticky top-0 z-40 backdrop-blur supports-[backdrop-filter]:bg-white/70 bg-white/80 dark:bg-neutral-950/80 border-b border-neutral-200 dark:border-neutral-800">
      <div className="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
        <Link href="/" className="font-semibold">
          seud.dev
        </Link>
        <nav className="flex items-center gap-4 text-sm">
          <Link href="/about" className="hover:underline underline-offset-4">About</Link>
          <Link href="/projects" className="hover:underline underline-offset-4">Projects</Link>
          <Link href="/skills" className="hover:underline underline-offset-4">Skills</Link>
          <Link href="/experiences" className="hover:underline underline-offset-4">Experience</Link>
          <Link href="/blog" className="hover:underline underline-offset-4">Blog</Link>
          <Link href="/contact" className="hover:underline underline-offset-4">Contact</Link>
          <ThemeToggle />
        </nav>
      </div>
    </header>
  );
}
