import { Outlet } from "react-router-dom";
import SideNav from "../dashboard/components/SideNav";
import Categories from "./components/Categories";

const Marketplace = () => {
    return (
        <main className="hero overflow-hidden lg:px-4">
            <div className="grid max-lg:grid-cols-1 gap-4 max-xl:grid-cols-[1fr_232px] xl:grid-cols-[243px_1fr_232px] max-w-screen-xl mx-auto">
                <SideNav />
                <div className="bg-white shadow-md px-4 py-8 space-y-8 overflow-hidden">
                    <Outlet />
                </div>
                <Categories />
            </div>
        </main>
    );
};

export default Marketplace;
