export default function Footer() {
  return (
    <footer className="border-t border-neutral-200 dark:border-neutral-800 mt-16">
      <div className="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between text-sm text-neutral-600 dark:text-neutral-400">
        <p>© {new Date().getFullYear()} seud.dev</p>
        <div className="flex gap-4">
          <a href="https://github.com" target="_blank" rel="noreferrer" className="hover:underline underline-offset-4">GitHub</a>
          <a href="https://x.com" target="_blank" rel="noreferrer" className="hover:underline underline-offset-4">X</a>
        </div>
      </div>
    </footer>
  );
}
