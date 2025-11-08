import { redirect } from "next/navigation";

// Legacy projects index page: redirect to single-page section
export default function ProjectsRedirect() {
  redirect("/#projects");
  return null;
}
