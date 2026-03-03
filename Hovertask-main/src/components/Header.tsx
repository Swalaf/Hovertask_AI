import logo from "../assets/brand-logo.svg";
import { RiMenu2Line } from "react-icons/ri";
import { MdClose } from "react-icons/md";
import { Dispatch, SetStateAction, useState } from "react";
import { Link, useLocation } from "react-router-dom";
import navLinks from "../lib/navLinks";

const Header = () => {
    const [menuOpen, setMenuOpen] = useState(false);
    const { pathname } = useLocation();

    return (
        <header className="bg-gradient-to-b sticky top-0 w-full left-0 z-50 bg-white from-[#31187D59] to-[#7373731A] shadow-md p-8">
            <div className="mx-auto max-w-[1098px] flex justify-between items-center">
                <Link to="/">
                    <img src={logo} alt="Hover Task Logo" className="w-24" />
                </Link>

                {/* Desktop Navigation */}
                <DesktopNav pathname={pathname} />
                {/* Desktop Navigation */}

                {/* Create Account Button */}
                <div className="hidden lg:block">
                    <Link
                        to="/signup"
                        className="bg-base hover:bg-blue-500 text-white p-4 rounded-full font-medium shadow-md transition-all duration-300"
                    >
                        Create Account
                    </Link>
                </div>
                {/* Create Account Button */}

                {/* Mobile Menu Button */}
                <div className="lg:hidden">
                    <button onClick={() => setMenuOpen(!menuOpen)} className="text-gray-800 text-2xl">
                        {menuOpen ? <MdClose /> : <RiMenu2Line />}
                    </button>
                </div>
                {/* Mobile Menu Button */}
            </div>

            {/* Mobile Menu */}
            {menuOpen && <MobileNav setMenuOpen={setMenuOpen} pathname={pathname} />}
        </header>
    );
};

const DesktopNav = ({ pathname }: { pathname: string }) => (
    <nav role="navigation" className="hidden lg:flex gap-[50px] items-center">
        {navLinks.map((item) => (
            <Link
                to={item.path}
                key={item.label}
                className={`${pathname === item.path ? "text-base" : "hover:text-blue-600"} transition-colors`}
            >
                {item.label}
                {pathname === item.path && (
                    <span className="flex gap-1 justify-center max-w-[25px] mx-auto">
                        <span className="h-[5px] w-[5px] bg-base rounded-full"></span>
                        <span className="h-[5px] bg-base rounded-full flex-1"></span>
                    </span>
                )}
            </Link>
        ))}
    </nav>
);

const MobileNav = ({ pathname, setMenuOpen }: { pathname: string; setMenuOpen: Dispatch<SetStateAction<boolean>> }) => (
    <div className="lg:hidden bg-white shadow-md absolute top-[94.2px] left-0 w-full z-50 py-6 bg-gradient-to-r from-blue-50 to-purple-100">
        <div className="flex flex-col items-center space-y-6">
            {navLinks.map((item) => (
                <Link
                    to={item.path}
                    onClick={() => setMenuOpen(false)} // Close menu after clicking a link
                    key={item.label}
                    className={`${pathname === item.path ? "text-base" : "hover:text-blue-600"} transition-colors`}
                >
                    {item.label}
                    {pathname === item.path && (
                        <span className="flex gap-1 justify-center max-w-[25px] mx-auto">
                            <span className="h-[5px] w-[5px] bg-base rounded-full"></span>
                            <span className="h-[5px] bg-base rounded-full flex-1"></span>
                        </span>
                    )}
                </Link>
            ))}
            <Link
                to="/signup"
                onClick={() => setMenuOpen(false)} // Close menu after clicking "Create Account"
                className="bg-base hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium shadow-md transition-all duration-300"
            >
                Create Account
            </Link>
        </div>
    </div>
);

export default Header;
