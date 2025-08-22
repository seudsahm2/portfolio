import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import Header from "@/components/layout/Header";
import Footer from "@/components/layout/Footer";
import Providers from "./providers";
import ChatDock from "@/components/chat/ChatDock";
import AnalyticsConsent from "@/components/seo/AnalyticsConsent";
import SeoJsonLd from "@/components/seo/SeoJsonLd";
import Script from "next/script";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  metadataBase: new URL("http://localhost:3000"),
  title: {
    default: "Seud Portfolio",
    template: "%s | Seud Portfolio",
  },
  description: "Personal portfolio with projects, blog, and an AI assistant.",
  keywords: [
    "Seud",
    "Portfolio",
    "Software Developer",
    "AI",
    "AI chatbot portfolio",
    "Full Stack",
    "Projects",
    "Blog",
  ],
  icons: {
    icon: "/favicon.ico",
  },
  openGraph: {
    type: "website",
    title: "Seud Portfolio",
    description: "Projects, blog, and AI chat",
    url: "/",
    siteName: "Seud Portfolio",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en" suppressHydrationWarning>
      <body className={`${geistSans.variable} ${geistMono.variable} antialiased min-h-screen bg-background text-foreground`}>
        <Providers>
          {/* Google tag (gtag.js) - Manual GA4 install as requested */}
          <Script src="https://www.googletagmanager.com/gtag/js?id=G-LFX02TQLHD" strategy="afterInteractive" />
          <Script id="ga4-init" strategy="afterInteractive">{
            `window.dataLayer = window.dataLayer || [];
             function gtag(){dataLayer.push(arguments);} 
             gtag('js', new Date());
             gtag('config', 'G-LFX02TQLHD');`
          }</Script>

          <Header />
          <main className="min-h-[calc(100vh-8rem)]">{children}</main>
          <Footer />
          <ChatDock />
          <AnalyticsConsent />
          <SeoJsonLd />
        </Providers>
      </body>
    </html>
  );
}
