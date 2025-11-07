import Link from "next/link";

export default function Footer() {
  return (
    <footer className="mt-16 border-t border-neutral-200 dark:border-neutral-800">
      <div className="max-w-6xl mx-auto px-4 py-10 text-sm text-neutral-600 dark:text-neutral-400 grid md:grid-cols-3 gap-6 items-center">
        <div>
          <div className="font-semibold text-base gradient-text">seud.dev</div>
          <p className="mt-1">© {new Date().getFullYear()} All rights reserved.</p>
        </div>
        <nav className="flex gap-4 justify-center">
          <Link href="/about" className="hover:underline underline-offset-4">About</Link>
          <Link href="/projects" className="hover:underline underline-offset-4">Projects</Link>
          <Link href="/blog" className="hover:underline underline-offset-4">Blog</Link>
          <Link href="/contact" className="hover:underline underline-offset-4">Contact</Link>
        </nav>
        <div className="flex gap-4 md:justify-end justify-center">
          <a href="https://github.com" target="_blank" rel="noreferrer" className="hover:underline underline-offset-4">GitHub</a>
          <a href="https://x.com" target="_blank" rel="noreferrer" className="hover:underline underline-offset-4">X</a>
        </div>
      </div>
    </footer>
  );
}
