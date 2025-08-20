"use client";

import { useEffect } from "react";

export default function Error({ error, reset }: { error: Error & { digest?: string }; reset: () => void }) {
  useEffect(() => {
    // NOTE: replace with real logging later
    console.error(error);
  }, [error]);

  return (
    <div className="min-h-[60vh] grid place-items-center p-8">
      <div className="max-w-lg text-center">
        <h2 className="text-xl font-semibold mb-2">Something went wrong</h2>
        <p className="text-sm text-neutral-600 dark:text-neutral-300 mb-4">
          An unexpected error occurred. You can try again.
        </p>
        <button
          onClick={() => reset()}
          className="inline-flex items-center justify-center h-10 px-4 rounded-md bg-black text-white hover:bg-neutral-800 dark:bg-white dark:text-black dark:hover:bg-neutral-200"
        >
          Try again
        </button>
      </div>
    </div>
  );
}
