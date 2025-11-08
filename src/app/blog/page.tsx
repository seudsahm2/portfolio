import { redirect } from "next/navigation";

// Legacy blog index page: redirect to single-page section
export default function BlogRedirect() {
  redirect("/#blog");
  return null;
}
