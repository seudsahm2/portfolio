import { redirect } from "next/navigation";

// Legacy contact route: redirect to in-page section
export default function ContactRedirect() {
  redirect("/#contact");
}
