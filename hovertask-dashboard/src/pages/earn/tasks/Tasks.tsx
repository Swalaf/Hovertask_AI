import { ArrowLeft, Hexagon, Megaphone, ArrowRight } from "lucide-react";
import { Link } from "react-router";
import { useState } from "react";
import cn from "../../../utils/cn";

export default function Tasks() {
  const [activeTab, setActiveTab] = useState<"tasks" | "adverts">("tasks");
  const [currentCategory, setCurrentCategory] = useState("social_media");

  const categories = [
    { key: "social_media", label: "Social Media" },
    { key: "whatsapp", label: "WhatsApp" },
    { key: "facebook", label: "Facebook" },
    { key: "instagram", label: "Instagram" },
    { key: "twitter", label: "Twitter/X" },
    { key: "tiktok", label: "TikTok" },
  ];

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 text-white">
        <div className="flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="flex items-start gap-4">
            <Link to="/earn" className="mt-1">
              <ArrowLeft className="w-5 h-5" />
            </Link>
            <div>
              <h1 className="text-2xl font-bold mb-2">Find Tasks & Earn</h1>
              <p className="text-green-100">Complete simple tasks and earn money instantly</p>
            </div>
          </div>
          <div className="hidden md:block">
            <img
              src="/images/Media_Sosial_Pictures___Freepik-removebg-preview 2.png"
              alt="Tasks"
              className="w-40"
            />
          </div>
        </div>
      </div>

      {/* Tab Switcher */}
      <div className="flex gap-2 p-1 bg-zinc-100 rounded-xl w-fit">
        <button
          onClick={() => setActiveTab("tasks")}
          className={cn(
            "flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-all",
            activeTab === "tasks" 
              ? "bg-white text-primary shadow-sm" 
              : "text-zinc-500 hover:text-zinc-700"
          )}
        >
          <Hexagon className="w-4 h-4" /> Perform Tasks
        </button>
        <Link
          to="/earn/adverts"
          className={cn(
            "flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-all",
            activeTab === "adverts" 
              ? "bg-white text-primary shadow-sm" 
              : "text-zinc-500 hover:text-zinc-700"
          )}
        >
          <Megaphone className="w-4 h-4" /> Post Adverts
        </Link>
      </div>

      {/* Info Banner */}
      <div className="bg-blue-50 border border-blue-100 rounded-xl p-4">
        <p className="text-sm text-blue-800">
          <span className="font-semibold">How it works:</span> Complete social media tasks to earn rewards. 
          Your earnings are credited instantly after task verification.
        </p>
      </div>

      {/* Category Filter */}
      <div>
        <div className="flex items-center justify-between mb-4">
          <h2 className="text-lg font-semibold text-zinc-800">Browse Tasks</h2>
          <Link to="/earn/tasks-history" className="text-primary text-sm font-medium hover:underline">
            View History →
          </Link>
        </div>
        <div className="flex gap-2 overflow-x-auto pb-2">
          {categories.map((cat) => (
            <button
              key={cat.key}
              onClick={() => setCurrentCategory(cat.key)}
              className={cn(
                "px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-all",
                currentCategory === cat.key
                  ? "bg-primary text-white"
                  : "bg-white border border-zinc-200 text-zinc-600 hover:border-primary/30"
              )}
            >
              {cat.label}
            </button>
          ))}
        </div>
      </div>

      {/* Placeholder for available tasks - actual component renders below */}
      <div className="bg-zinc-50 rounded-xl p-8 text-center">
        <div className="w-16 h-16 bg-zinc-200 rounded-full flex items-center justify-center mx-auto mb-4">
          <Hexagon className="w-8 h-8 text-zinc-400" />
        </div>
        <h3 className="text-lg font-semibold text-zinc-800 mb-2">Available Tasks</h3>
        <p className="text-zinc-500 text-sm mb-4">Loading tasks from the platform...</p>
        <Link 
          to="/earn/tasks-history" 
          className="inline-flex items-center gap-2 text-primary font-medium hover:underline"
        >
          Check completed tasks <ArrowRight size={16} />
        </Link>
      </div>
    </div>
  );
}
