"use client";

export function ContactSection() {
  return (
    <section id="contact" data-section="contact" className="scroll-mt-24">
      <div className="max-w-7xl mx-auto px-5 md:px-8 py-10">
        <header className="mb-6">
          <h2 className="text-3xl font-semibold text-amber-300">Contact</h2>
        </header>
        <p className="text-slate-300 mb-4 max-w-[60ch]">
          Feel free to reach out for collaboration, freelance work, or to say hello.
        </p>
        <div className="flex gap-3 flex-wrap">
          <a href="mailto:you@example.com" className="px-4 py-2 rounded-md bg-teal-500 hover:bg-teal-400 text-slate-900 text-sm font-medium">Email Me</a>
          <a href="#" className="px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-slate-200 text-sm font-medium">LinkedIn</a>
          <a href="#" className="px-4 py-2 rounded-md border border-slate-700 hover:border-teal-400 text-slate-200 text-sm font-medium">GitHub</a>
        </div>
      </div>
    </section>
  );
}
