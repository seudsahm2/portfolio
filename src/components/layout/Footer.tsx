"use client";

export default function Footer() {
  const nav = [
    { id: "about", label: "About" },
    { id: "projects", label: "Projects" },
    { id: "blog", label: "Blog" },
    { id: "contact", label: "Contact" },
  ];
  return (
    <footer className="mt-28 border-t border-slate-800">
      <div className="max-w-7xl mx-auto px-4 py-10 text-sm text-slate-400 grid md:grid-cols-3 gap-6 items-center">
        <div>
          <div className="font-semibold text-base gradient-text">seud.dev</div>
          <p className="mt-1">© {new Date().getFullYear()} All rights reserved.</p>
        </div>
        <nav className="flex gap-4 justify-center flex-wrap">
          {nav.map((n) => (
            <a
              key={n.id}
              href={`#${n.id}`}
              className="hover:text-teal-400 transition-colors"
            >
              {n.label}
            </a>
          ))}
        </nav>
        <div className="flex gap-4 md:justify-end justify-center">
          <a href="https://github.com" target="_blank" rel="noreferrer" className="hover:text-teal-400 transition-colors">GitHub</a>
          <a href="https://x.com" target="_blank" rel="noreferrer" className="hover:text-teal-400 transition-colors">X</a>
        </div>
      </div>
    </footer>
  );
}
