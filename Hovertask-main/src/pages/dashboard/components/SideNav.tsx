import dashboardIcon from "../../../assets/material-symbols-light_dashboard-outline.svg";
import earnIcon from "../../../assets/solar_wallet-broken.svg";
import advertIcon from "../../../assets/icon-park-outline_add-two.svg";
import marketplaceIcon from "../../../assets/mdi_marketplace-outline.svg";
import addFollowersIcon from "../../../assets/mingcute_user-follow-line.svg";
import addUpIcon from "../../../assets/ci_add-row.svg";
import referAndearnIcon from "../../../assets/carbon_network-admin-control.svg";
import supportFaqIcon from "../../../assets/fluent_person-support-16-regular.svg";
import logoutIcon from "../../../assets/ri_logout-circle-line.svg";
import { Link, useLocation } from "react-router-dom";

const navLinks = [
    {
        label: "Dashboard",
        path: "/dashboard",
        iconSrc: dashboardIcon
    },
    {
        label: "Earn",
        path: "/dashboard/earn",
        iconSrc: earnIcon
    },
    {
        label: "Advertise",
        path: "/dashboard/advertise",
        iconSrc: advertIcon
    },
    {
        label: "Marketplace",
        path: window.location.pathname.includes("dashboard") ? "/dashboard/marketplace" : "marketplace",
        iconSrc: marketplaceIcon
    },
    {
        label: "Buy Followers",
        path: "/dashboard/add-followers",
        iconSrc: addFollowersIcon
    },
    {
        label: "Add Me Up",
        path: "/dashboard/add-up",
        iconSrc: addUpIcon
    },
    {
        label: "Refer and Earn",
        path: "/dashboard/refer-and-earn",
        iconSrc: referAndearnIcon
    },
    {
        label: "Support / FAQ Page",
        path: "/dashboard/support-faq",
        iconSrc: supportFaqIcon
    },
    {
        label: "Logout",
        path: "/dashboard/logout",
        iconSrc: logoutIcon
    }
];

const SideNav = () => {
    const location = useLocation();

    return (
        <div className="max-w-[243px] space-y-12 max-xl:hidden">
            <div className="bg-[#3F5FCF] py-20 pl-6 rounded-3xl text-white">
                <div className="border-1 border-[#FFFFFF33] pl-4 pr-2 py-10 rounded-2xl space-y-3">
                    {navLinks.map((link) => {
                        return (
                            <Link
                                className={`${
                                    location.pathname.includes(link.path) ? "bg-white text-[#3F5FCF]" : ""
                                } text-[14.95px] flex gap-2 items-center py-2 px-6 rounded-xl whitespace-nowrap`}
                                key={link.label}
                                to={link.path}
                            >
                                <img src={link.iconSrc} alt="" /> {link.label}
                            </Link>
                        );
                    })}
                </div>
            </div>
            <div>
                <img src="/assets/images/Frame 1000005292.png" alt="Side banner" />
            </div>
        </div>
    );
};

export default SideNav;
