import { FaFacebook, FaTwitter, FaInstagram, FaLinkedin, FaTiktok } from "react-icons/fa";
import { FiMail } from "react-icons/fi";
import logo from "../assets/brand-logo.svg";
import { FaYoutube } from "react-icons/fa6";

const Footer = () => {
    return (
        <footer className="bg-gradient-to-b from-base to-[#2C418F] text-gray-200 py-12 pt-36 relative overflow-hidden">
            <div className="absolute h-[119px] w-[90%] rounded-t-full max-w-[1100px] bg-white top-[calc(100%-.35rem)] left-1/2 -translate-x-1/2"></div>
            <div className="container mx-auto px-6 text-[20px] font-light">
                <div className="flex max-lg:flex-col gap-10 md:px-16 p-4">
                    <div className="flex flex-col">
                        <img src={logo} alt="Hovertask Logo" className="w-36 mb-4" />
                        <p className="lg:max-w-xs">
                            Our mission is to create opportunities for people to earn daily income while helping
                            businesses reach a wider audience.
                        </p>
                    </div>
                    <div className="grid grid-cols-2 md:grid-cols-3 flex-1 gap-10">
                        <div>
                            <h3 className="text-lg font-medium text-white mb-4">Quick Links</h3>
                            <ul className="space-y-2">
                                {["Home", "Marketplace", "About Us", "FAQ", "Contact Us"].map((link) => (
                                    <li key={link}>
                                        <a href="#" className="hover:text-white hover:opacity-80 transition">
                                            {link}
                                        </a>
                                    </li>
                                ))}
                            </ul>
                        </div>
                        <div>
                            <h3 className="text-lg font-medium text-white mb-4">Useful Links</h3>
                            <ul className="space-y-2">
                                {["Privacy Policy", "Terms & Conditions", "Support"].map((link) => (
                                    <li key={link}>
                                        <a href="#" className="hover:text-white hover:opacity-80 transition">
                                            {link}
                                        </a>
                                    </li>
                                ))}
                            </ul>
                        </div>
                        <div className="flex flex-col">
                            <h3 className="text-lg font-medium text-white mb-4">Install Our App</h3>
                            <div className="flex-col flex gap-4">
                                <a href="#">
                                    <img
                                        src="/assets/images/Apple.png"
                                        alt="App Store"
                                        className="h-10 hover:opacity-80 transition object-contain"
                                    />
                                </a>
                                <a href="#">
                                    <img
                                        src="/assets/images/Google.png"
                                        alt="Google Play"
                                        className="h-10 hover:opacity-80 transition object-contain"
                                    />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="mt-12 pt-6">
                    <div className="flex flex-col lg:flex-row justify-between items-center gap-4 px-12">
                        <p className="text-sm">
                            &copy; {new Date().getFullYear()} Hovertask. All rights reserved. Made by Aloyande Nurudeen
                        </p>
                        <div className="flex space-x-6 text-2xl">
                            <a href=" https://web.facebook.com/hovertaskng" className="hover:text-white transition">
                                <FaFacebook />
                            </a>
                            <a href="https://x.com/hovertaskng" className="hover:text-white transition">
                                <FaTwitter />
                            </a>
                            <a href="https://www.instagram.com/hovertaskng/" className="hover:text-white transition">
                                <FaInstagram />
                            </a>
                            <a href="https://www.linkedin.com/company/hovertask-ng " className="hover:text-white transition">
                                <FaLinkedin />
                            </a>
                            <a href=" https://www.tiktok.com/@hovertaskng" className="hover:text-white transition">
                                <FaTiktok />
                            </a>
                            <a href="https://www.youtube.com/@Hovertaskng" className="hover:text-white transition">
                                <FaYoutube />
                            </a>
                            <a href="mailto:hovertask@gmail.com" className="hover:text-white transition">
                                <FiMail />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
