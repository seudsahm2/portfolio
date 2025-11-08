import { redirect } from "next/navigation";

// Dynamic blog route is deprecated in favor of single-page section
export default function BlogPostRedirect() {
  redirect("/#blog");
}
