import {
  ArrowLeft,
  Hexagon,
  History,
  Megaphone,
  ArrowRight,
  Users,
  TrendingUp,
  Shield,
  Globe,
  Plus,
  BarChart3,
  FileText,
  Zap,
  Briefcase,
  GraduationCap
} from "lucide-react";
import { useSelector } from "react-redux";
import { Link } from "react-router";
import type { AuthUserDTO } from "../../../../types";
import FeatureCard from "../components/FeatureCard";
import advertFeatures from "../utils/advertFeatures";
import advertTypes from "../utils/advertTypes";
import { useState } from "react";
import cn from "../../../utils/cn";

export default function AdvertisePage() {
  const authUser = useSelector<{ auth: { value: AuthUserDTO } }, AuthUserDTO>(
    (state) => state.auth.value
  );

  const [activeTab, setActiveTab] = useState<"advert-tasks" | "engagement">("advert-tasks");

  // Quick action cards for streamlined navigation
  const quickActions = [
    {
      title: "Create New Campaign",
      description: "Start a new advert or engagement campaign",
      icon: <Plus className="w-6 h-6" />,
      link: "/advertise/post-advert",
      color: "bg-primary",
      hoverColor: "hover:bg-primary/90"
    },
    {
      title: "View All Campaigns",
      description: "See your advert and engagement task history",
      icon: <FileText className="w-6 h-6" />,
      link: "/advertise/advert-tasks-history",
      color: "bg-blue-500",
      hoverColor: "hover:bg-blue-600"
    },
    {
      title: "Track Performance",
      description: "Monitor your campaign results",
      icon: <BarChart3 className="w-6 h-6" />,
      link: "/advertise/advert-tasks-history",
      color: "bg-green-500",
      hoverColor: "hover:bg-green-600"
    }
  ];

  return (
    <div className="space-y-6">
      {/* Hero Header */}
      <div className="bg-gradient-to-r from-primary to-blue-700 rounded-2xl p-8 text-white">
        <div className="flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="flex items-start gap-4">
            <Link
              to="/"
              className="mt-1 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors"
            >
              <ArrowLeft className="w-5 h-5" />
            </Link>
            <div>
              <h1 className="text-2xl font-bold mb-2">Advertise Your Products & Services</h1>
              <p className="text-blue-100">Reach thousands of active users on our platform every day</p>
            </div>
          </div>
          <div className="hidden md:block">
            <img
              src="/images/Premium_Photo___Composition_with_smartphone_used_for_digital_shopping_and_online_ordering-removebg-preview 2.png"
              alt="Advertise"
              className="w-48"
            />
          </div>
        </div>
      </div>

      {/* Quick Actions - Unified Campaign Management */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        {quickActions.map((action, index) => (
          <Link
            key={index}
            to={action.link}
            className={cn(
              "group p-5 rounded-xl text-white transition-all duration-200",
              action.color,
              action.hoverColor,
              "hover:shadow-lg hover:-translate-y-1"
            )}
          >
            <div className="flex items-start gap-4">
              <div className="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                {action.icon}
              </div>
              <div className="flex-1">
                <h3 className="font-semibold text-lg mb-1">{action.title}</h3>
                <p className="text-white/80 text-sm">{action.description}</p>
              </div>
              <ArrowRight className="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity" />
            </div>
          </Link>
        ))}
      </div>

      {/* Quick Stats */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        {[
          { label: "Active Users", value: "50K+", icon: Users, color: "bg-blue-500" },
          { label: "Daily Reach", value: "200K+", icon: TrendingUp, color: "bg-green-500" },
          { label: "Countries", value: "15+", icon: Globe, color: "bg-purple-500" },
          { label: "Verified", value: "100%", icon: Shield, color: "bg-amber-500" },
        ].map((stat, index) => (
          <div key={index} className="bg-white rounded-xl p-4 border border-zinc-100">
            <div className={cn("w-10 h-10 rounded-lg flex items-center justify-center mb-3", stat.color)}>
              <stat.icon className="w-5 h-5 text-white" />
            </div>
            <p className="text-xl font-bold text-zinc-800">{stat.value}</p>
            <p className="text-xs text-zinc-500">{stat.label}</p>
          </div>
        ))}
      </div>

      {/* Features Section */}
      <div className="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
        <h2 className="text-lg font-semibold text-zinc-800 mb-2 text-center">Why Advertise With Us?</h2>
        <p className="text-sm text-zinc-600 text-center mb-6 max-w-2xl mx-auto">
          Advertise your products and services to thousands of active users on our website and mobile app every day.
        </p>

        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
          {advertFeatures.map((feature) => (
            <FeatureCard key={feature.title} {...feature} />
          ))}
        </div>
      </div>

      {/* Duration Card */}
      <div className="bg-white rounded-xl p-6 border border-zinc-100">
        <div className="flex items-center gap-3 mb-4">
          <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
            <History className="w-6 h-6 text-primary" />
          </div>
          <div>
            <h3 className="font-semibold text-zinc-800">Advert Duration</h3>
            <p className="text-sm text-zinc-500">How long your advert stays active</p>
          </div>
        </div>
        <div className="bg-primary text-white p-4 rounded-xl">
          <p className="text-center font-medium">
            Your advert will stay visible on our platform for 1 month. After this period,
            you'll need to renew by placing another advert to maintain visibility.
          </p>
        </div>
        <p className="text-center text-sm text-zinc-500 mt-4">
          Take advantage of Hovertask today and sell faster than ever!
        </p>
      </div>

      {/* Campaign Type Tabs */}
      <div className="bg-white rounded-xl p-1 border border-zinc-100 w-fit">
        <div className="flex gap-1 p-1 bg-zinc-100 rounded-lg">
          <button
            onClick={() => setActiveTab("advert-tasks")}
            className={cn(
              "flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-all",
              activeTab === "advert-tasks"
                ? "bg-white text-primary shadow-sm"
                : "text-zinc-500 hover:text-zinc-700"
            )}
          >
            <Hexagon className="w-4 h-4" /> Advert Tasks
          </button>
          <Link
            to="/advertise/engagement-tasks"
            className={cn(
              "flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-all",
              activeTab === "engagement"
                ? "bg-white text-primary shadow-sm"
                : "text-zinc-500 hover:text-zinc-700"
            )}
          >
            <Megaphone className="w-4 h-4" /> Engagement Tasks
          </Link>
        </div>
      </div>

      {/* Info Banner */}
      <div className="bg-blue-50 border border-blue-100 rounded-xl p-4">
        <p className="text-sm text-blue-800">
          <span className="font-semibold">How it works:</span> Pay users to perform specific actions
          that increase the reach and visibility of your content. From likes to shares, get the engagement
          you need to grow your brand.
        </p>
      </div>

      {/* Campaign Types */}
      <div className="space-y-4">
        <h2 className="text-lg font-semibold text-zinc-800">Choose Your Campaign Type</h2>
        {advertTypes.map((ad) => (
          <CampaignTypeCard key={ad.platform} {...ad} />
        ))}
      </div>

      {/* CTA */}
      <div className="bg-primary text-white rounded-2xl p-8 text-center">
        <h2 className="text-2xl font-bold mb-2">Ready to Grow Your Business?</h2>
        <p className="text-blue-100 mb-6 max-w-lg mx-auto">
          Start advertising your products and services to thousands of potential customers today.
        </p>
        <div className="flex flex-col sm:flex-row gap-4 justify-center">
          <Link
            to="/advertise/post-advert"
            className="inline-flex items-center gap-2 px-8 py-3 bg-white text-primary rounded-xl font-semibold hover:bg-blue-50 transition-colors"
          >
            <Zap className="w-5 h-5" />
            Start New Campaign
          </Link>
          <Link
            to="/advertise/advert-tasks-history"
            className="inline-flex items-center gap-2 px-8 py-3 bg-white/20 backdrop-blur-sm text-white rounded-xl font-semibold hover:bg-white/30 transition-colors"
          >
            <FileText className="w-5 h-5" />
            View My Campaigns
          </Link>
        </div>
      </div>
    </div>
  );
}

// Enhanced Campaign Type Card
function CampaignTypeCard({
  platform,
  description,
  price,
  iconUrl,
  bgColor,
  borderColor,
}: any) {
  return (
    <div
      className={`flex items-center gap-4 p-5 max-sm:flex-col rounded-xl border ${borderColor} ${bgColor} hover:shadow-md transition-shadow`}
    >
      <img src={iconUrl} alt={platform} className="w-12 h-12" />
      <div className="flex-1">
        <h3 className="font-medium text-sm sm:text-base text-zinc-800">
          Get Your Adverts on {platform}
        </h3>
        <p className="text-xs sm:text-sm text-gray-700 mt-1">{description}</p>
        <p className="text-xs font-medium text-black mt-2">
          <span className="font-semibold">Price:</span> {price} per Advert Post
        </p>
      </div>
      <div className="flex flex-col sm:flex-row gap-2">
        <Link
          to={`/advertise/post-advert?platform=${platform.toLowerCase()}`}
          className="bg-primary text-white text-xs px-4 py-2 rounded-lg hover:bg-primary/90 transition flex items-center justify-center gap-2"
        >
          <Plus className="w-4 h-4" />
          Create Campaign
        </Link>
      </div>
    </div>
  );
}
