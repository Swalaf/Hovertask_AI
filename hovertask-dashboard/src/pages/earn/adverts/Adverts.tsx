import { Check, Hexagon, Megaphone, ArrowRight, ArrowLeft, Users, TrendingUp, DollarSign, Plus, FileText, BarChart3 } from "lucide-react";
import { Link } from "react-router";
import { useState } from "react";
import cn from "../../../utils/cn";

export default function Adverts() {
  const [activeTab, setActiveTab] = useState<"tasks" | "adverts">("adverts");

  const hasNewlyLinkedAccount = new URLSearchParams(window.location.search).has(
    "newlyLinkedAccounts",
  );

  // Quick action cards
  const quickActions = [
    {
      title: "Find Adverts",
      description: "Browse available adverts to perform",
      icon: <Megaphone className="w-6 h-6" />,
      link: "/earn/tasks",
      color: "bg-green-500",
      hoverColor: "hover:bg-green-600"
    },
    {
      title: "View History",
      description: "See your completed adverts and earnings",
      icon: <FileText className="w-6 h-6" />,
      link: "/earn/tasks-history",
      color: "bg-blue-500",
      hoverColor: "hover:bg-blue-600"
    },
    {
      title: "Track Performance",
      description: "Monitor your earnings and stats",
      icon: <BarChart3 className="w-6 h-6" />,
      link: "/earn/tasks-history",
      color: "bg-purple-500",
      hoverColor: "hover:bg-purple-600"
    }
  ];

  // Mock data for demo
  const stats = [
    { label: "Total Adverts Posted", value: "124", icon: Megaphone, color: "bg-blue-500" },
    { label: "Total Engagement", value: "12.4K", icon: TrendingUp, color: "bg-green-500" },
    { label: "Total Earned", value: "₦45,200", icon: DollarSign, color: "bg-amber-500" },
    { label: "Active Campaigns", value: "3", icon: Users, color: "bg-purple-500" },
  ];

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white">
        <div className="flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="flex items-start gap-4">
            <Link to="/earn" className="mt-1">
              <ArrowLeft className="w-5 h-5 hover:bg-white/20 rounded-lg p-1" />
            </Link>
            <div>
              <h1 className="text-2xl font-bold mb-2">Post Adverts & Earn</h1>
              <p className="text-blue-100">Share adverts for businesses and earn money for every engagement</p>
            </div>
          </div>
          <div className="hidden md:block">
            <img
              src="/images/Premium_Vector___Digital_marketing_3d_render_illustration_Social_Media_Marketing_Promotion_and_Internet_advertising_concept_3d_vector_illustration-removebg-preview 1.png"
              alt="Adverts"
              className="w-40"
            />
          </div>
        </div>
      </div>

      {/* Quick Actions */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        {quickActions.map((action, index) => (
          <Link
            key={index}
            to={action.link}
            className={cn(
              "group p-4 rounded-xl text-white transition-all duration-200",
              action.color,
              action.hoverColor,
              "hover:shadow-lg hover:-translate-y-1"
            )}
          >
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                {action.icon}
              </div>
              <div className="flex-1">
                <h3 className="font-semibold text-sm">{action.title}</h3>
                <p className="text-white/80 text-xs">{action.description}</p>
              </div>
              <ArrowRight className="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" />
            </div>
          </Link>
        ))}
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        {stats.map((stat, index) => (
          <div key={index} className="bg-white rounded-xl p-4 border border-zinc-100 shadow-sm">
            <div className={cn("w-10 h-10 rounded-lg flex items-center justify-center mb-3", stat.color)}>
              <stat.icon className="w-5 h-5 text-white" />
            </div>
            <p className="text-2xl font-bold text-zinc-800">{stat.value}</p>
            <p className="text-xs text-zinc-500">{stat.label}</p>
          </div>
        ))}
      </div>

      {/* Tab Switcher */}
      <div className="flex gap-2 p-1 bg-zinc-100 rounded-xl w-fit">
        <Link
          to="/earn/tasks"
          className={cn(
            "flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-all",
            activeTab === "tasks"
              ? "bg-white text-primary shadow-sm"
              : "text-zinc-500 hover:text-zinc-700"
          )}
        >
          <Hexagon className="w-4 h-4" /> Perform Tasks
        </Link>
        <button
          onClick={() => setActiveTab("adverts")}
          className={cn(
            "flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-all",
            activeTab === "adverts"
              ? "bg-white text-primary shadow-sm"
              : "text-zinc-500 hover:text-zinc-700"
          )}
        >
          <Megaphone className="w-4 h-4" /> Post Adverts
        </button>
      </div>

      {/* Success Banner */}
      {hasNewlyLinkedAccount && (
        <div className="flex items-center gap-4 p-4 bg-green-50 border border-green-200 rounded-xl">
          <div className="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
            <Check className="w-6 h-6 text-green-600" />
          </div>
          <div>
            <h3 className="font-semibold text-green-800">Account Linked Successfully</h3>
            <p className="text-sm text-green-600">You can now start posting adverts and earning</p>
          </div>
        </div>
      )}

      {/* Eligibility Card */}
      <div className="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
        <h2 className="text-lg font-semibold text-zinc-800 mb-4">Are You Eligible?</h2>
        <div className="grid md:grid-cols-2 gap-4">
          <div className="flex items-start gap-3">
            <div className="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
              <Check className="w-4 h-4 text-white" />
            </div>
            <p className="text-sm text-zinc-700">Minimum of 1,000 followers on Facebook, Instagram, Twitter, or TikTok</p>
          </div>
          <div className="flex items-start gap-3">
            <div className="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
              <Check className="w-4 h-4 text-white" />
            </div>
            <p className="text-sm text-zinc-700">Active and engaging account with regular posts</p>
          </div>
        </div>
      </div>

      {/* How It Works */}
      <div className="bg-white rounded-2xl p-6 border border-zinc-100">
        <h2 className="text-lg font-semibold text-zinc-800 mb-6">How It Works</h2>
        <div className="grid md:grid-cols-3 gap-6">
          {[
            { step: "1", title: "Choose an Advert", desc: "Browse available adverts from businesses and choose what to share" },
            { step: "2", title: "Share & Engage", desc: "Post the advert on your social media and drive engagement" },
            { step: "3", title: "Get Paid", desc: "Earn money instantly after your post is verified" },
          ].map((item, index) => (
            <div key={index} className="text-center">
              <div className="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                {item.step}
              </div>
              <h3 className="font-semibold text-zinc-800 mb-2">{item.title}</h3>
              <p className="text-sm text-zinc-500">{item.desc}</p>
            </div>
          ))}
        </div>
      </div>

      {/* Quick Actions */}
      <div className="grid md:grid-cols-2 gap-4">
        <Link
          to="/earn/tasks-history"
          className="flex items-center justify-between p-4 bg-white rounded-xl border border-zinc-200 hover:border-primary/30 transition-all group"
        >
          <div>
            <h3 className="font-semibold text-zinc-800">View Task History</h3>
            <p className="text-sm text-zinc-500">See your completed tasks and earnings</p>
          </div>
          <ArrowRight className="w-5 h-5 text-zinc-400 group-hover:text-primary transition-colors" />
        </Link>
        <Link
          to="/advertise/post-advert"
          className="flex items-center justify-between p-4 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all group"
        >
          <div>
            <h3 className="font-semibold">Post Your Own Advert</h3>
            <p className="text-sm text-blue-100">Promote your business to thousands</p>
          </div>
          <Plus className="w-5 h-5 text-white group-hover:translate-x-1 transition-transform" />
        </Link>
      </div>

      {/* Available Adverts Section - placeholder */}
      <div className="bg-zinc-50 rounded-xl p-8 text-center">
        <div className="w-16 h-16 bg-zinc-200 rounded-full flex items-center justify-center mx-auto mb-4">
          <Megaphone className="w-8 h-8 text-zinc-400" />
        </div>
        <h3 className="text-lg font-semibold text-zinc-800 mb-2">Available Adverts</h3>
        <p className="text-zinc-500 text-sm mb-4">Loading adverts from the platform...</p>
        <Link
          to="/earn/tasks-history"
          className="inline-flex items-center gap-2 text-primary font-medium hover:underline"
        >
          Check completed adverts <ArrowRight size={16} />
        </Link>
      </div>
    </div>
  );
}
