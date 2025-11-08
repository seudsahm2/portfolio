import { redirect } from "next/navigation";

// Dynamic project route is deprecated in favor of single-page section
export default function ProjectDetailRedirect() {
  redirect("/#projects");
}
