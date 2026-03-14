import { Link } from "react-router";
import {
  CheckCircle,
  ArrowRight,
  Wallet,
  Users,
  TrendingUp,
  Plus,
  FileText,
  BarChart3,
  Link2,
  ShoppingBag,
  Megaphone
} from "lucide-react";
import { useState } from "react";
import cn from "../../../utils/cn";

export default function Earn() {
  const [activeTab, setActiveTab] = useState<"tasks" | "adverts">("tasks");

  // Quick action cards - streamlined navigation
  const quickActions = [
    {
      title: "Find Tasks",
      description: "Browse available social media tasks",
      icon: <CheckCircle className="w-6 h-6" />,
      link: "/earn/tasks",
      color: "bg-green-500",
      hoverColor: "hover:bg-green-600"
    },
    {
      title: "Task History",
      description: "View your completed tasks and earnings",
      icon: <FileText className="w-6 h-6" />,
      link: "/earn/tasks-history",
      color: "bg-blue-500",
      hoverColor: "hover:bg-blue-600"
    },
    {
      title: "Connect Accounts",
      description: "Link your social media accounts",
      icon: <Link2 className="w-6 h-6" />,
      link: "/earn/connect-accounts",
      color: "bg-purple-500",
      hoverColor: "hover:bg-purple-600"
    }
  ];

  const earningOptions = [
    {
      title: "Complete Tasks",
      description: "Earn money by completing simple social media tasks",
      icon: <CheckCircle className="w-8 h-8" />,
      linkText: "Start Earning",
      linkUrl: "/earn/tasks",
      color: "bg-green-500"
    },
    {
      title: "Post Adverts",
      description: "Promote your products to thousands of users",
      icon: <Megaphone className="w-8 h-8" />,
      linkText: "Create Ad",
      linkUrl: "/advertise",
      color: "bg-blue-500"
    },
    {
      title: "Resell Products",
      description: "Sell products and earn commissions",
      icon: <TrendingUp className="w-8 h-8" />,
      linkText: "Start Selling",
      linkUrl: "/earn/resell",
      color: "bg-purple-500"
    }
  ];

  return (
    <div className="space-y-6">
      {/* Hero Banner */}
      <div className="bg-gradient-to-r from-primary via-primary/80 to-blue-600 rounded-2xl p-8 text-white">
        <div className="flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="space-y-4">
            <h1 className="text-3xl font-bold">Choose Your Earning Path</h1>
            <p className="text-white/90 text-lg max-w-xl">
              Select how you want to earn and start making money today
            </p>
            <div className="flex gap-3 flex-wrap">
              <Link
                to="/earn/tasks"
                className="bg-white text-primary px-6 py-3 rounded-xl font-semibold flex items-center gap-2 hover:bg-gray-100 transition-colors"
              >
                Find Tasks <ArrowRight size={18} />
              </Link>
              <Link
                to="/advertise"
                className="bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 hover:bg-white/30 transition-colors"
              >
                Post Adverts
              </Link>
            </div>
          </div>
          <div className="hidden md:block">
            <img
              src="/images/3D_rendering_of_new_1000_Nigerian_naira_notes_flying_in_different_angles_and_orientations_isolated_on_transparent_background-removebg-preview 1.png"
              alt="Earn money"
              className="w-48"
            />
          </div>
        </div>
      </div>

      {/* Quick Actions - Unified Task Management */}
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
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
              <CheckCircle className="w-6 h-6 text-green-600" />
            </div>
            <div>
              <p className="text-sm text-zinc-500">Tasks Completed</p>
              <p className="text-2xl font-bold text-zinc-800">124</p>
            </div>
          </div>
        </div>
        <div className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
              <Wallet className="w-6 h-6 text-blue-600" />
            </div>
            <div>
              <p className="text-sm text-zinc-500">Total Earned</p>
              <p className="text-2xl font-bold text-zinc-800">₦45,200</p>
            </div>
          </div>
        </div>
        <div className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
              <Users className="w-6 h-6 text-purple-600" />
            </div>
            <div>
              <p className="text-sm text-zinc-500">Referrals</p>
              <p className="text-2xl font-bold text-zinc-800">12</p>
            </div>
          </div>
        </div>
      </div>

      {/* Task/Adverts Toggle */}
      <div className="bg-white rounded-xl p-1 border border-zinc-100 w-fit">
        <div className="flex gap-1 p-1 bg-zinc-100 rounded-lg">
          <button
            onClick={() => setActiveTab("tasks")}
            className={cn(
              "flex items-center gap-2 px-6 py-3 rounded-lg font-medium transition-all",
              activeTab === "tasks"
                ? "bg-white text-primary shadow-sm"
                : "text-zinc-500 hover:text-zinc-700"
            )}
          >
            <CheckCircle className="w-4 h-4" /> Perform Tasks
          </button>
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
      </div>

      {/* Content based on active tab */}
      {activeTab === "tasks" ? (
        <>
          {/* Eligibility Card */}
          <div className="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
            <h2 className="text-lg font-semibold text-zinc-800 mb-4">Are You Eligible?</h2>
            <div className="grid md:grid-cols-2 gap-4">
              <div className="flex items-start gap-3">
                <div className="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center mt-0.5">
                  <CheckCircle className="w-4 h-4 text-white" />
                </div>
                <p className="text-sm text-zinc-700">Minimum of 1,000 followers on Facebook, Instagram, Twitter, or TikTok</p>
              </div>
              <div className="flex items-start gap-3">
                <div className="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center mt-0.5">
                  <CheckCircle className="w-4 h-4 text-white" />
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
                { step: "1", title: "Find Tasks", desc: "Browse available adverts from businesses and choose what to share" },
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
        </>
      ) : (
        <>
          {/* Adverts Info */}
          <div className="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
            <h2 className="text-lg font-semibold text-zinc-800 mb-4">Earn by Posting Adverts</h2>
            <div className="grid md:grid-cols-2 gap-4">
              <div className="flex items-start gap-3">
                <div className="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
                  <CheckCircle className="w-4 h-4 text-white" />
                </div>
                <p className="text-sm text-zinc-700">Share business adverts on your social media</p>
              </div>
              <div className="flex items-start gap-3">
                <div className="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
                  <CheckCircle className="w-4 h-4 text-white" />
                </div>
                <p className="text-sm text-zinc-700">Get paid for every valid engagement</p>
              </div>
            </div>
          </div>

          {/* CTA to Advertise Page */}
          <div className="bg-white rounded-2xl p-6 border border-zinc-100 text-center">
            <h2 className="text-lg font-semibold text-zinc-800 mb-2">Want to advertise YOUR business?</h2>
            <p className="text-sm text-zinc-500 mb-4">Create your own campaigns and reach thousands of potential customers</p>
            <Link
              to="/advertise"
              className="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary/90 transition-colors"
            >
              Go to Advertise <ArrowRight className="w-5 h-5" />
            </Link>
          </div>
        </>
      )}

      {/* Earning Options */}
      <div>
        <h2 className="text-xl font-bold text-zinc-800 mb-4">Ways to Earn</h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          {earningOptions.map((option, index) => (
            <Link
              key={index}
              to={option.linkUrl}
              className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100 hover:shadow-md hover:border-primary/30 transition-all group"
            >
              <div className={`w-14 h-14 ${option.color} rounded-xl flex items-center justify-center text-white mb-4`}>
                {option.icon}
              </div>
              <h3 className="text-lg font-semibold text-zinc-800 mb-2">{option.title}</h3>
              <p className="text-sm text-zinc-500 mb-4">{option.description}</p>
              <span className="text-primary font-medium flex items-center gap-1 group-hover:gap-2 transition-all">
                {option.linkText} <ArrowRight size={16} />
              </span>
            </Link>
          ))}
        </div>
      </div>

      {/* Benefits & Overview */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
          <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
            <CheckCircle className="w-5 h-5 text-green-600" />
            Benefits of Tasks
          </h3>
          <ul className="space-y-3">
            {[
              "Quick and easy earnings - minimal effort required",
              "Flexible schedule - work at your own pace",
              "Instant rewards - get paid as soon as verified",
              "Accessible to anyone with internet connection"
            ].map((benefit, i) => (
              <li key={i} className="flex items-start gap-2 text-sm text-zinc-600">
                <span className="w-1.5 h-1.5 bg-green-500 rounded-full mt-2 flex-shrink-0" />
                {benefit}
              </li>
            ))}
          </ul>
        </div>
        <div className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
          <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
            <TrendingUp className="w-5 h-5 text-purple-600" />
            Reseller Commissions
          </h3>
          <ul className="space-y-3">
            {[
              "High commission rates (10% - 50%)",
              "Wide product selection across categories",
              "No earning caps - unlimited potential",
              "Simple process - just share affiliate links"
            ].map((item, i) => (
              <li key={i} className="flex items-start gap-2 text-sm text-zinc-600">
                <span className="w-1.5 h-1.5 bg-purple-500 rounded-full mt-2 flex-shrink-0" />
                {item}
              </li>
            ))}
          </ul>
        </div>
      </div>
    </div>
  );
}
