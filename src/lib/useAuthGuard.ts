"use client";

import { useEffect } from "react";
import { useRouter } from "next/navigation";
import { getAccessToken } from "./auth";

export function useAuthGuard() {
  const router = useRouter();
  useEffect(() => {
    const token = getAccessToken();
    if (!token) router.replace("/login");
  }, [router]);
}
