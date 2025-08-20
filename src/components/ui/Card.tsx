import * as React from "react";

type CardProps = React.HTMLAttributes<HTMLDivElement>;

export function Card({ className = "", ...props }: CardProps) {
  return (
    <div
      className={[
        "rounded-xl border border-neutral-200 bg-white shadow-sm",
        "dark:border-neutral-800 dark:bg-neutral-900",
        className,
      ].join(" ")}
      {...props}
    />
  );
}

export function CardHeader({ className = "", ...props }: CardProps) {
  return (
    <div className={["px-4 py-3 border-b border-neutral-100 dark:border-neutral-800", className].join(" ")} {...props} />
  );
}

export function CardContent({ className = "", ...props }: CardProps) {
  return <div className={["px-4 py-3", className].join(" ")} {...props} />;
}

export function CardFooter({ className = "", ...props }: CardProps) {
  return (
    <div className={["px-4 py-3 border-t border-neutral-100 dark:border-neutral-800", className].join(" ")} {...props} />
  );
}

export default Card;
