// src/layouts/RootLayout.tsx - Completely Redesigned Layout
import { Outlet, useLocation } from "react-router-dom";
import Header from "./Header";
import SideNav from "./SideNav";
import { useState } from "react";
import getAuthUser from "../utils/getAuthUser";
import { useDispatch, useSelector } from "react-redux";
import { setAuthUser } from "../redux/slices/auth";
import Loading from "../shared/components/Loading";
import useRequirementPoll from "../hooks/useRequirementPoll";
import type { AuthUserDTO } from "../../types";

export default function RootLayout() {
  const dispatch = useDispatch();
  const location = useLocation();
  const path = location.pathname;

  const user = useSelector<{ auth: { value: AuthUserDTO | null } }, AuthUserDTO | null>(
    (s) => s.auth.value ?? null
  );

  const [initialLoading, setInitialLoading] = useState(!user);

  // Polling hook - simplified without blocking requirements
  useRequirementPoll({
    enabled: true,
    refreshUser: async () => {
      const refreshed = await getAuthUser();
      dispatch(setAuthUser(refreshed));
      if (initialLoading) setInitialLoading(false);
      return refreshed;
    },
    conditionToStop: () => false, // Always keep refreshed, no blocking
    immediate: true,
  });

  if (initialLoading) return <Loading fixed />;

  return (
    <div className="min-h-screen bg-zinc-50 dark:bg-slate-900 transition-colors duration-300">
      {/* Full-width Header */}
      <Header />
      
      {/* Full-width Layout */}
      <div className="flex">
        {/* Sidebar - Full height, fixed width on desktop */}
        <aside className="hidden lg:block w-64 fixed left-0 top-[72px] bottom-0 overflow-y-auto z-40 bg-white dark:bg-slate-800 border-r dark:border-slate-700 transition-colors duration-300">
          <SideNav />
        </aside>

        {/* Main Content - Full width with proper padding */}
        <main className="flex-1 lg:ml-64 min-h-[calc(100vh-72px)] p-4 md:p-6 lg:p-8">
          <Outlet />
        </main>
      </div>
    </div>
  );
}
