import { Link } from "react-router-dom";
import listImage from "../../../assets/Ellipse 1564.svg";

const EarnByHelpingSection = () => {
    return (
        <section className="bg-gradient-to-b from-gray-50 via-white to-gray-50 dark:from-slate-900 dark:via-slate-800/50 dark:to-slate-900 py-16 md:py-24 relative overflow-hidden">
            {/* Background decorations */}
            <div className="absolute inset-0 pointer-events-none">
                <div className="absolute top-0 left-1/4 w-64 h-64 bg-blue-400/5 dark:bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div className="absolute bottom-0 right-1/4 w-80 h-80 bg-[#2C418F]/5 dark:bg-purple-500/10 rounded-full blur-3xl"></div>
            </div>
            <div className="max-w-screen-xl mx-auto flex max-lg:flex-col items-center justify-center px-4 relative z-10">
                <div className="container max-w-lg ">
                    <h2 className="text-3xl md:text-4xl font-bold mb-6 bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 text-transparent bg-clip-text">
                        Earn money by helping other people grow
                    </h2>
                    <p className="text-lg md:text-xl text-gray-600 dark:text-slate-300 mb-10 leading-relaxed">
                        Get paid by helping people grow, no investment or signup fee required.
                    </p>
                    <ul className="mb-8 text-base md:text-lg space-y-4">
                        <li className="flex items-center gap-3">
                            <img src={listImage} alt="" className="w-5 h-5" /> 
                            <span className="text-gray-700 dark:text-slate-300">Over 1,000+ daily tasks available</span>
                        </li>
                        <li className="flex items-center gap-3">
                            <img src={listImage} alt="" className="w-5 h-5" /> 
                            <span className="text-gray-700 dark:text-slate-300">Instant withdrawals to your bank or wallet</span>
                        </li>
                        <li className="flex items-center gap-3">
                            <img src={listImage} alt="" className="w-5 h-5" /> 
                            <span className="text-gray-700 dark:text-slate-300">No investment or signup fee required</span>
                        </li>
                    </ul>
                    <Link 
                        to="/signup" 
                        className="inline-flex items-center gap-2 bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 dark:from-indigo-600 dark:to-purple-600 dark:hover:from-indigo-500 dark:hover:to-purple-500 text-white px-8 py-4 rounded-2xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5"
                    >
                        Create Free Account
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>
                <div className="lg:block w-full md:w-1/2 relative mt-10 lg:mt-0">
                    <div className="relative">
                        {/* Glow effect behind */}
                        <div className="absolute -inset-4 bg-gradient-to-r from-[#2C418F]/20 to-blue-400/20 dark:from-indigo-500/20 dark:to-purple-500/20 rounded-3xl blur-2xl"></div>
                        {/* Image container */}
                        <div className="relative bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-4 border border-gray-100 dark:border-slate-700">
                            <img
                                src="/assets/images/hand-holding-phone.png"
                                alt="Earn money by completing social media tasks on HoverTask"
                                className="rounded-xl w-full object-cover"
                                loading="lazy"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default EarnByHelpingSection;
