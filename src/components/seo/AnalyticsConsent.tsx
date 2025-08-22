"use client";

import { useEffect, useState } from "react";
import Script from "next/script";
import { env } from "@/lib/env";

const CONSENT_KEY = "analytics_consent_v1";

export default function AnalyticsConsent() {
  const gaId = env.NEXT_PUBLIC_GA_ID;
  const [consent, setConsent] = useState<string | null>(null);

  useEffect(() => {
    try {
      setConsent(localStorage.getItem(CONSENT_KEY));
    } catch {}
  }, []);

  const grant = () => {
    try { localStorage.setItem(CONSENT_KEY, "granted"); } catch {}
    setConsent("granted");
  };
  const deny = () => {
    try { localStorage.setItem(CONSENT_KEY, "denied"); } catch {}
    setConsent("denied");
  };

  if (!gaId) return null;

  return (
    <>
      {consent === "granted" && (
        <>
          <Script src={`https://www.googletagmanager.com/gtag/js?id=${gaId}`} strategy="afterInteractive" />
          <Script id="ga4-init" strategy="afterInteractive">
            {`
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', '${gaId}');
            `}
          </Script>
        </>
      )}

      {consent === null && (
        <div className="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 z-50 max-w-xl rounded-lg border bg-white dark:bg-neutral-900 p-4 shadow-xl text-sm">
          <div className="mb-3">
            We use cookies to measure traffic (Google Analytics). Do you consent?
          </div>
          <div className="flex gap-2 justify-end">
            <button className="px-3 h-9 rounded border" onClick={deny}>Decline</button>
            <button className="px-3 h-9 rounded bg-neutral-900 text-white dark:bg-white dark:text-black" onClick={grant}>Allow</button>
          </div>
        </div>
      )}
    </>
  );
}
