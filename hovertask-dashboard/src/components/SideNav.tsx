/** biome-ignore-all lint/a11y/noStaticElementInteractions: allow static element interaction */
import {
  LayoutDashboard,
  Wallet,
  Megaphone,
  Store,
  Users,
  BarChart3,
  Settings,
  HelpCircle,
  TrendingUp,
  CheckCircle,
  List,
  Target,
  UserPlus
} from "lucide-react";
import { useState } from "react";
import { Link } from "react-router";
import useActiveLink from "../hooks/useActiveLink";
import cn from "../utils/cn";
import { FaWhatsapp, FaFacebook, FaInstagram, FaTwitter } from "react-icons/fa";
import { SiTiktok } from "react-icons/si";

export default function SideNav() {
  const activeLink = useActiveLink();

  // Navigation items with icons
  const navItems = [
    { icon: <LayoutDashboard size={20} />, label: "Dashboard", path: "/" },
    {
      icon: <Wallet size={20} />,
      label: "Earn",
      path: "/earn",
      hasDropdown: true,
      options: [
        { icon: <Megaphone size={16} />, label: "Post Adverts", path: "/earn/adverts" },
        { icon: <CheckCircle size={16} />, label: "Complete Tasks", path: "/earn/tasks" },
        { icon: <TrendingUp size={16} />, label: "Resell Products", path: "/earn/resell" },
        { icon: <List size={16} />, label: "Task History", path: "/earn/tasks-history" },
      ]
    },
    {
      icon: <Megaphone size={20} />,
      label: "Advertise",
      path: "/advertise",
      hasDropdown: true,
      options: [
        { icon: <FaWhatsapp size={16} />, label: "WhatsApp", path: "/advertise/post-advert?platform=WhatsApp" },
        { icon: <FaFacebook size={16} />, label: "Facebook", path: "/advertise/post-advert?platform=Facebook" },
        { icon: <FaInstagram size={16} />, label: "Instagram", path: "/advertise/post-advert?platform=Instagram" },
        { icon: <FaTwitter size={16} />, label: "Twitter/X", path: "/advertise/post-advert?platform=X" },
        { icon: <SiTiktok size={16} />, label: "TikTok", path: "/advertise/post-advert?platform=TikTok" },
        { icon: <List size={16} />, label: "Ad History", path: "/advertise/advert-tasks-history" },
      ]
    },
    { icon: <Wallet size={20} />, label: "Wallet", path: "/fund-wallet" },
    {
      icon: <Store size={20} />,
      label: "Marketplace",
      path: "/dashboard/marketplace",
      hasDropdown: true,
      options: [
        { icon: <List size={16} />, label: "Browse", path: "/dashboard/marketplace" },
        { icon: <Target size={16} />, label: "My Listings", path: "/dashboard/marketplace/listings" },
        { icon: <Target size={16} />, label: "Add Product", path: "/dashboard/marketplace/list-product?type=list-product" },
        { icon: <Target size={16} />, label: "Resell Product", path: "/dashboard/marketplace/list-product?type=resell" },
        { icon: <TrendingUp size={16} />, label: "Reseller Stats", path: "/reseller-conversion" },
      ]
    },
    { icon: <BarChart3 size={20} />, label: "Reseller Stats", path: "/reseller-conversion" },
    { icon: <Users size={20} />, label: "Refer & Earn", path: "/refer-and-earn" },
    {
      icon: <UserPlus size={20} />, label: "AddMeUp", path: "/add-me-up", hasDropdown: true, options: [
        { icon: <Target size={16} />, label: "My Profile", path: "/add-me-up/profile" },
        { icon: <List size={16} />, label: "Points", path: "/add-me-up/points" },
        { icon: <Users size={16} />, label: "List Profile", path: "/add-me-up/list-profile" },
      ]
    },
  ];

  return (
    <div className="h-full bg-white border-r border-zinc-200 py-6 px-4 flex flex-col">
      {/* Navigation */}
      <nav className="space-y-1 flex-1 overflow-y-auto">
        {navItems.map((item, index) => (
          item.hasDropdown ? (
            <NavDropdown key={index} item={item} activeLink={activeLink} />
          ) : (
            <NavLink key={index} item={item} activeLink={activeLink} />
          )
        ))}
      </nav>

      {/* Bottom Actions */}
      <div className="pt-4 border-t border-zinc-100 space-y-1 mt-4">
        <NavLink
          item={{ icon: <Settings size={18} />, label: "Settings", path: "/edit-profile" }}
          activeLink={activeLink}
        />
        <NavLink
          item={{ icon: <HelpCircle size={18} />, label: "Help Center", path: "/contact" }}
          activeLink={activeLink}
        />
        <button
          onClick={() => {
            localStorage.removeItem("auth_token");
            window.location.href = import.meta.env.VITE_MAIN_SITE_URL || "https://hovertask.com";
          }}
          className="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 transition-colors"
        >
          <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          <span className="text-sm font-medium">Logout</span>
        </button>
      </div>
    </div>
  );
}

// Nav Link Component
function NavLink({ item, activeLink }: { item: { icon: React.ReactNode; label: string; path: string }; activeLink: string }) {
  const isActive = activeLink === item.path || (item.path !== "/" && activeLink.startsWith(item.path));

  return (
    <Link
      to={item.path}
      className={cn(
        "flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all",
        isActive
          ? "bg-primary text-white shadow-md"
          : "text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900"
      )}
    >
      {item.icon}
      <span>{item.label}</span>
    </Link>
  );
}

// Nav Dropdown Component
function NavDropdown({ item, activeLink }: { item: { icon: React.ReactNode; label: string; path: string; options: { icon: React.ReactNode; label: string; path: string }[] }; activeLink: string }) {
  const [isOpen, setIsOpen] = useState(false);
  const isParentActive = activeLink.startsWith(item.path);

  return (
    <div className="relative">
      <button
        type="button"
        onClick={() => setIsOpen(!isOpen)}
        className={cn(
          "w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all",
          isParentActive
            ? "bg-primary/10 text-primary"
            : "text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900"
        )}
      >
        <div className="flex items-center gap-3">
          {item.icon}
          <span>{item.label}</span>
        </div>
        <svg
          className={cn("w-4 h-4 transition-transform", isOpen && "rotate-180")}
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      {isOpen && (
        <div className="mt-1 ml-4 space-y-1 py-2 border-l-2 border-zinc-200 relative z-50">
          {item.options?.map((option, i) => (
            <Link
              key={i}
              to={option.path}
              className="flex items-center gap-3 px-4 py-2 text-sm text-zinc-600 hover:text-primary hover:bg-zinc-50 rounded-r-lg transition-colors"
              onClick={() => setIsOpen(false)}
            >
              {option.icon}
              <span>{option.label}</span>
            </Link>
          ))}
        </div>
      )}
    </div>
  );
}
