import { CircularProgress } from "@heroui/react";
import { Link } from "react-router";
import { type Task } from "../../../types.d";
import { ArrowUpRight, Layers, Smartphone } from "lucide-react";

export default function TaskCard(props: Task) {
  // Determine status badge color based on completion
  const getStatusBadge = () => {
    if (props.completed === "Available") {
      return { bg: "bg-green-50", text: "text-green-700", label: "Available" };
    }
    return { bg: "bg-zinc-100", text: "text-zinc-600", label: "Completed" };
  };
  const status = getStatusBadge();

  // Get platform icons
  const getPlatformIcon = () => {
    const platforms = props.platforms?.toLowerCase() || "";
    if (platforms.includes("whatsapp")) return "WA";
    if (platforms.includes("facebook")) return "FB";
    if (platforms.includes("instagram")) return "IG";
    if (platforms.includes("twitter") || platforms.includes("x")) return "X";
    if (platforms.includes("tiktok")) return "TK";
    if (platforms.includes("telegram")) return "TG";
    return "ALL";
  };

  return (
    <div className="border border-zinc-200 rounded-2xl p-5 bg-white shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
      {/* Header Section */}
      <div className="flex items-start justify-between gap-4 mb-4">
        <div className="flex items-start gap-3">
          <div className="p-2.5 rounded-xl bg-primary/10 text-primary">
            <Layers size={20} />
          </div>
          <div className="flex-1 min-w-0">
            <h3 className="font-semibold text-zinc-800 truncate">
              {props.title}
            </h3>
            <div className="flex items-center gap-2 mt-1.5">
              <span className={`px-2 py-0.5 rounded-md ${status.bg} ${status.text} text-xs font-medium`}>
                {status.label}
              </span>
              <span className="text-xs text-zinc-500 flex items-center gap-1">
                <Smartphone size={12} />
                {getPlatformIcon()}
              </span>
            </div>
          </div>
        </div>
        <div className="text-right">
          <p className="text-xl font-bold text-primary">
            ₦{props.payment_per_task.toLocaleString()}
          </p>
          <p className="text-xs text-zinc-500">per task</p>
        </div>
      </div>

      {/* Progress and Action */}
      <div className="flex items-center justify-between pt-4 border-t border-zinc-100">
        <div className="flex items-center gap-3">
          <CircularProgress
            color={
              props.completion_percentage > 69
                ? "success"
                : props.completion_percentage > 44
                ? "warning"
                : "danger"
            }
            size="sm"
            value={props.completion_percentage}
            className="scale-75"
          />
          <span className="text-xs text-zinc-500">
            {props.completion_percentage}% filled
          </span>
        </div>
        <Link
          to={`/earn/tasks/${props.id}`}
          className="flex items-center gap-1.5 px-4 py-2 rounded-full border border-primary text-primary text-sm font-medium transition-all hover:bg-primary hover:text-white"
        >
          View <ArrowUpRight size={14} />
        </Link>
      </div>
    </div>
  );
}
