import { useSelector } from "react-redux";
import type { AuthUserDTO } from "../../../types";
import {
  Wallet,
  TrendingUp,
  Users,
  ShoppingBag,
  Megaphone,
  ArrowRight,
  Star,
  Clock,
  CheckCircle2,
  Plus
} from "lucide-react";
import { Link } from "react-router";
import AvailableTasks from "../../shared/components/AvailableTasks";
import AvailableJobs from "../earn/adverts/components/AvailableJobs";
import PopularProducts from "./components/PopularProducts";

export default function Dashboard() {
  const authUser = useSelector<{ auth: { value: AuthUserDTO } }, AuthUserDTO>(
    (state) => state.auth.value,
  );

  return (
    <div className="space-y-8 w-full">
      {/* Hero Welcome Section */}
      <HeroSection user={authUser} />

      {/* Quick Stats Grid */}
      <StatsGrid user={authUser} />

      {/* Quick Actions */}
      <QuickActions />

      {/* Earn Money Section */}
      <EarnSection />

      {/* Available Tasks */}
      <section className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <div className="flex items-center justify-between mb-6">
          <h2 className="text-xl font-bold text-zinc-800">Available Tasks</h2>
          <Link to="/earn/tasks" className="text-primary font-medium flex items-center gap-1 hover:gap-2 transition-all">
            View All <ArrowRight size={16} />
          </Link>
        </div>
        <AvailableTasks mode="preview" />
      </section>

      {/* Available Adverts */}
      <section className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <div className="flex items-center justify-between mb-6">
          <h2 className="text-xl font-bold text-zinc-800">Active Campaigns</h2>
          <Link to="/earn/adverts" className="text-primary font-medium flex items-center gap-1 hover:gap-2 transition-all">
            View All <ArrowRight size={16} />
          </Link>
        </div>
        <AvailableJobs mode="preview" />
      </section>

      {/* Marketplace Preview */}
      <section className="bg-white rounded-2xl p-6 shadow-sm border border-zinc-100">
        <div className="flex items-center justify-between mb-6">
          <h2 className="text-xl font-bold text-zinc-800">Marketplace</h2>
          <Link to="/dashboard/marketplace" className="text-primary font-medium flex items-center gap-1 hover:gap-2 transition-all">
            Explore <ArrowRight size={16} />
          </Link>
        </div>
        <PopularProducts />
      </section>
    </div>
  );
}

// Hero Section Component
function HeroSection({ user }: { user: AuthUserDTO }) {
  return (
    <div className="bg-gradient-to-r from-primary to-[#3A5AE8] rounded-3xl p-8 text-white">
      <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
          <h1 className="text-3xl font-bold mb-2">
            Welcome back, {user.fname}! 👋
          </h1>
          <p className="text-white/80 text-lg">
            Here's what's happening with your account today.
          </p>
        </div>
        <div className="flex gap-3">
          <Link
            to="/advertise/post-advert"
            className="flex items-center gap-2 bg-white text-primary px-6 py-3 rounded-xl font-semibold hover:bg-white/90 transition-colors"
          >
            <Plus size={20} /> Create Ad
          </Link>
          <Link
            to="/earn/tasks"
            className="flex items-center gap-2 bg-white/20 text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/30 transition-colors"
          >
            <TrendingUp size={20} /> Start Earning
          </Link>
        </div>
      </div>
    </div>
  );
}

// Stats Grid Component
function StatsGrid({ user }: { user: AuthUserDTO }) {
  const stats = [
    {
      label: "Wallet Balance",
      value: `₦${user.balance.toLocaleString()}`,
      icon: <Wallet size={24} />,
      color: "bg-green-500",
      bgColor: "bg-green-50",
      textColor: "text-green-700",
    },
    {
      label: "Total Adverts",
      value: user.advertise_count.toString(),
      icon: <Megaphone size={24} />,
      color: "bg-blue-500",
      bgColor: "bg-blue-50",
      textColor: "text-blue-700",
    },
    {
      label: "Tasks Completed",
      value: user.task_count.toString(),
      icon: <CheckCircle2 size={24} />,
      color: "bg-purple-500",
      bgColor: "bg-purple-50",
      textColor: "text-purple-700",
    },
    {
      label: "Membership",
      value: user.is_member ? "Premium" : "Free",
      icon: <Star size={24} />,
      color: user.is_member ? "bg-amber-500" : "bg-zinc-400",
      bgColor: user.is_member ? "bg-amber-50" : "bg-zinc-100",
      textColor: user.is_member ? "text-amber-700" : "text-zinc-600",
    },
  ];

  return (
    <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
      {stats.map((stat, index) => (
        <div
          key={index}
          className="bg-white rounded-2xl p-5 shadow-sm border border-zinc-100 hover:shadow-md transition-shadow"
        >
          <div className="flex items-start justify-between mb-3">
            <div className={`p-3 rounded-xl ${stat.bgColor}`}>
              <span className={stat.textColor}>{stat.icon}</span>
            </div>
          </div>
          <p className="text-2xl font-bold text-zinc-800">{stat.value}</p>
          <p className="text-sm text-zinc-500 mt-1">{stat.label}</p>
        </div>
      ))}
    </div>
  );
}

// Quick Actions Component
function QuickActions() {
  const actions = [
    { label: "Post Ad", icon: <Megaphone size={20} />, path: "/advertise/post-advert", color: "bg-blue-500" },
    { label: "Find Tasks", icon: <CheckCircle2 size={20} />, path: "/earn/tasks", color: "bg-green-500" },
    { label: "Browse Market", icon: <ShoppingBag size={20} />, path: "/dashboard/marketplace", color: "bg-purple-500" },
    { label: "Resell Products", icon: <TrendingUp size={20} />, path: "/earn/resell", color: "bg-amber-500" },
    { label: "Fund Wallet", icon: <Wallet size={20} />, path: "/fund-wallet", color: "bg-cyan-500" },
    { label: "Refer Friends", icon: <Users size={20} />, path: "/refer-and-earn", color: "bg-pink-500" },
  ];

  return (
    <div className="grid grid-cols-3 md:grid-cols-6 gap-3">
      {actions.map((action, index) => (
        <Link
          key={index}
          to={action.path}
          className="flex flex-col items-center gap-2 bg-white p-4 rounded-2xl shadow-sm border border-zinc-100 hover:shadow-md hover:-translate-y-1 transition-all"
        >
          <div className={`p-3 rounded-xl text-white ${action.color}`}>
            {action.icon}
          </div>
          <span className="text-xs font-medium text-zinc-700">{action.label}</span>
        </Link>
      ))}
    </div>
  );
}

// Earn Section Component
function EarnSection() {
  const earnOptions = [
    {
      title: "Complete Tasks",
      description: "Earn money by completing simple social media tasks",
      icon: <CheckCircle2 size={32} />,
      path: "/earn/tasks",
      color: "bg-green-500",
    },
    {
      title: "Post Adverts",
      description: "Advertise your products to thousands of users",
      icon: <Megaphone size={32} />,
      path: "/advertise/post-advert",
      color: "bg-blue-500",
    },
    {
      title: "Resell Products",
      description: "Sell products and earn commission on each sale",
      icon: <TrendingUp size={32} />,
      path: "/earn/resell",
      color: "bg-purple-500",
    },
  ];

  return (
    <div className="grid md:grid-cols-3 gap-4">
      {earnOptions.map((option, index) => (
        <Link
          key={index}
          to={option.path}
          className="group bg-white rounded-2xl p-6 shadow-sm border border-zinc-100 hover:shadow-lg hover:border-primary/20 transition-all"
        >
          <div className={`p-4 rounded-2xl ${option.color} text-white w-fit mb-4 group-hover:scale-110 transition-transform`}>
            {option.icon}
          </div>
          <h3 className="text-lg font-bold text-zinc-800 mb-2">{option.title}</h3>
          <p className="text-sm text-zinc-500">{option.description}</p>
          <div className="mt-4 flex items-center text-primary font-medium">
            Get Started <ArrowRight size={16} className="ml-1 group-hover:translate-x-1 transition-transform" />
          </div>
        </Link>
      ))}
    </div>
  );
}
