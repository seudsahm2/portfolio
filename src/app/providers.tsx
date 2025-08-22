"use client";

import { PropsWithChildren, useState } from "react";
import {
	QueryClient,
	QueryClientProvider,
} from "@tanstack/react-query";
import { ReactQueryDevtools } from "@tanstack/react-query-devtools";
import { Toaster } from "react-hot-toast";

export default function Providers({ children }: PropsWithChildren) {
	// Create once per mount to preserve cache across navigations
	const [client] = useState(
		() =>
			new QueryClient({
				defaultOptions: {
								queries: {
						staleTime: 60_000, // 1m fresh
						gcTime: 5 * 60_000, // 5m cache
						retry: 2,
						refetchOnWindowFocus: true,
						refetchOnReconnect: true,
						// carry over last successful data while refetching
									placeholderData: (prev: unknown) => prev,
					},
					mutations: {
						retry: 0,
					},
				},
			})
	);

	return (
		<QueryClientProvider client={client}>
			{children}
			<ReactQueryDevtools initialIsOpen={false} buttonPosition="bottom-left" />
			<Toaster position="bottom-right" toastOptions={{ duration: 4000 }} />
		</QueryClientProvider>
	);
}

