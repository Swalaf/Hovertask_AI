import { Outlet } from "react-router-dom";
import SideNav from "../dashboard/components/SideNav";
import Categories from "./components/Categories";

const Marketplace = () => {
    return (
        <main className="hero dark:hero overflow-hidden lg:px-2">
            <div className="grid max-lg:grid-cols-1 gap-3 max-xl:grid-cols-[1fr_232px] xl:grid-cols-[220px_1fr_232px] max-w-screen-xl mx-auto">
                <SideNav />
                <div className="bg-white dark:bg-slate-800 shadow-sm dark:shadow-2xl dark:shadow-indigo-500/10 rounded-lg md:rounded-xl px-3 md:px-5 py-5 space-y-5 overflow-hidden">
                    <Outlet />
                </div>
                <Categories />
            </div>
        </main>
    );
};

export default Marketplace;
