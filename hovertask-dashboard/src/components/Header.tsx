/** biome-ignore-all lint/a11y/noStaticElementInteractions: allow static interactive elements */
import {
  Bell,
  Search,
  Menu,
  User,
  ChevronDown,
  LogOut,
  Settings,
  Wallet
} from "lucide-react";
import { useState } from "react";
import { useSelector } from "react-redux";
import { Link } from "react-router";
import type { AuthUserDTO } from "../../types";
import DarkModeToggle from "./DarkModeToggle";

export default function Header() {
  const [showUserMenu, setShowUserMenu] = useState(false);
  const authUser = useSelector<{ auth: { value: AuthUserDTO } }, AuthUserDTO>(
    (state) => state.auth.value,
  );

  return (
    <header className="h-[72px] bg-white dark:bg-slate-900 border-b border-zinc-200 dark:border-slate-700 sticky top-0 z-50 transition-colors duration-300">
      <div className="h-full px-4 lg:px-6 flex items-center justify-between">
        {/* Left - Logo & Mobile Menu */}
        <div className="flex items-center gap-4">
          <button
            type="button"
            onClick={() => {/* Toggle mobile menu */}}
            title="Menu"
            className="lg:hidden p-2 rounded-xl hover:bg-zinc-100 transition-colors"
          >
            <Menu size={24} className="text-zinc-700" />
          </button>
          <Link to="/" className="flex items-center">
            <img src="/images/logo.png" width={100} alt="HoverTask" className="hidden sm:block" />
            <img src="/images/logo.png" width={80} alt="HoverTask" className="sm:hidden" />
          </Link>
        </div>

        {/* Center - Search (hidden on mobile) */}
        <div className="hidden md:flex flex-1 max-w-xl mx-8">
          <div className="w-full relative">
            <input
              type="text"
              placeholder="Search tasks, products, campaigns..."
              className="w-full h-10 pl-10 pr-4 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
            />
            <Search size={18} className="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400" />
          </div>
        </div>

        {/* Right - Actions */}
        <div className="flex items-center gap-2">
          {/* Dark Mode Toggle */}
          <DarkModeToggle />

          {/* Notifications */}
          <Link
            to="/notifications"
            className="relative p-2.5 rounded-xl hover:bg-zinc-100 dark:hover:bg-slate-800 transition-colors"
          >
            <Bell size={20} className="text-zinc-600 dark:text-slate-300" />
            <span className="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
          </Link>

          {/* Wallet Balance */}
          <Link
            to="/fund-wallet"
            className="hidden sm:flex items-center gap-2 px-3 py-2 bg-primary/10 text-primary rounded-xl hover:bg-primary/20 transition-colors"
          >
            <Wallet size={16} />
            <span className="text-sm font-semibold">₦{authUser.balance.toLocaleString()}</span>
          </Link>

          {/* User Menu */}
          <div className="relative">
            <button
              type="button"
              onClick={() => setShowUserMenu(!showUserMenu)}
              className="flex items-center gap-2 p-1.5 pr-3 rounded-xl hover:bg-zinc-100 transition-colors"
            >
              <div className="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white">
                <User size={16} />
              </div>
              <span className="hidden md:block text-sm font-medium text-zinc-700">
                {authUser.fname}
              </span>
              <ChevronDown size={16} className="text-zinc-400" />
            </button>

            {/* Dropdown Menu */}
            {showUserMenu && (
              <>
                <div 
                  className="fixed inset-0 z-40" 
                  onClick={() => setShowUserMenu(false)} 
                />
                <div className="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-lg border border-zinc-200 py-2 z-50">
                  <div className="px-4 py-2 border-b border-zinc-100">
                    <p className="text-sm font-semibold text-zinc-800">{authUser.fname} {authUser.lname}</p>
                    <p className="text-xs text-zinc-500">@{authUser.username}</p>
                  </div>
                  <div className="py-1">
                    <Link
                      to="/edit-profile"
                      className="flex items-center gap-3 px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50"
                      onClick={() => setShowUserMenu(false)}
                    >
                      <Settings size={16} /> Settings
                    </Link>
                    <Link
                      to="/fund-wallet"
                      className="flex items-center gap-3 px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50"
                      onClick={() => setShowUserMenu(false)}
                    >
                      <Wallet size={16} /> Fund Wallet
                    </Link>
                    <button
                      type="button"
                      className="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                    >
                      <LogOut size={16} /> Sign Out
                    </button>
                  </div>
                </div>
              </>
            )}
          </div>
        </div>
      </div>
    </header>
  );
}
