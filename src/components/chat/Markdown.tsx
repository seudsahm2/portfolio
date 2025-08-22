"use client";

import React, { useMemo } from "react";
import ReactMarkdown from "react-markdown";
import remarkGfm from "remark-gfm";
import rehypeSanitize from "rehype-sanitize";
import type { Components } from "react-markdown";
import type { PluggableList } from "unified";

function CopyButton({ text }: { text: string }) {
  return (
    <button
      type="button"
      className="absolute top-2 right-2 text-xs px-2 py-1 rounded bg-neutral-800 text-white hover:bg-neutral-700"
      onClick={() => navigator.clipboard.writeText(text)}
      aria-label="Copy code"
    >
      Copy
    </button>
  );
}

export function Markdown({ content }: { content: string }) {
  type CodeProps = {
    inline?: boolean;
    className?: string;
    children?: React.ReactNode;
  } & React.HTMLAttributes<HTMLElement>;
  const components = useMemo<Components>(() => ({
    code({ inline, className, children, ...props }: CodeProps) {
      const match = /language-(\w+)/.exec(className || "");
      const text = String(children ?? "");
      if (inline || !match) {
        return (
          <code className="px-1 py-0.5 rounded bg-black/10 dark:bg-white/10" {...props}>{children}</code>
        );
      }
      return (
        <div className="relative group">
          <CopyButton text={text} />
          <pre className="overflow-x-auto text-sm bg-black/90 text-white rounded-md p-3">
            <code className={className}>{text}</code>
          </pre>
        </div>
      );
    },
  }), []);

  return (
    <ReactMarkdown
      remarkPlugins={[remarkGfm]}
      rehypePlugins={[rehypeSanitize] as PluggableList}
      components={components}
      className="prose dark:prose-invert max-w-none"
    >
      {content}
    </ReactMarkdown>
  );
}

export default Markdown;
