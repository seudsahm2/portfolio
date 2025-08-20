import * as React from "react";

export interface BadgeProps extends React.HTMLAttributes<HTMLSpanElement> {
  color?: "gray" | "green" | "blue" | "red" | "yellow";
}

const colorMap = {
  gray: "bg-neutral-100 text-neutral-700 dark:bg-neutral-800 dark:text-neutral-200",
  green: "bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300",
  blue: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300",
  red: "bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-300",
  yellow: "bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300",
};

export function Badge({ className = "", color = "gray", ...props }: BadgeProps) {
  return (
    <span
      className={[
        "inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium",
        colorMap[color],
        className,
      ].join(" ")}
      {...props}
    />
  );
}

export default Badge;
