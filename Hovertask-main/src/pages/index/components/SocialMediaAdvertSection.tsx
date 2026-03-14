import { Link } from "react-router-dom";
import { FaBullhorn, FaChartLine, FaMoneyBillWave } from "react-icons/fa";

const features = [
    {
        title: "Boost Your Brand Visibility",
        description: "Each user who shares your ad has a minimum of 1,000 active followers, ensuring massive exposure in record time—driving conversions and skyrocketing your revenue.",
        cta: "Start Advertising",
        ctaLink: "/signup"
    },
    {
        title: "Cost-Effective Advertising Solutions",
        description: "Maximize your reach without overspending. For as little as ₦150, you can have influential users post your ads to their audience, giving you great value at a fraction of the cost.",
        cta: "View Pricing",
        ctaLink: "/signup"
    },
    {
        title: "Earn Passive Income Every Day",
        description: "Join HoverTask and start earning daily by posting ads for top businesses and brands on your social media accounts. It's quick, easy, and rewarding.",
        cta: "Start Earning",
        ctaLink: "/signup"
    }
];

const SocialMediaAdvertSection = () => {
    return (
        <section className="bg-gradient-to-b from-white via-gray-50 to-white dark:from-slate-900 dark:via-slate-800/50 dark:to-slate-900 py-16 md:py-24 relative overflow-hidden">
            {/* Background decorations */}
            <div className="absolute inset-0 pointer-events-none">
                <div className="absolute top-20 left-10 w-72 h-72 bg-[#2C418F]/3 dark:bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div className="absolute bottom-20 right-10 w-96 h-96 bg-blue-400/3 dark:bg-purple-500/10 rounded-full blur-3xl"></div>
            </div>
            {/* Header */}
            <div className="text-center mb-12 px-4 relative z-10">
                <h2 className="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 text-transparent bg-clip-text mb-4">
                    Unleash the Power of Social Media Advertising
                </h2>
                <p className="text-lg md:text-xl text-gray-600 dark:text-slate-300 max-w-3xl mx-auto leading-relaxed">
                    What if you could get thousands of users with strong social media influence to share your ad with their engaged followers? That's what we bring to the table.
                </p>
            </div>

            {/* Content Container */}
            <div className="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full max-w-6xl mx-auto px-4 relative z-10">
                {/* Floating Dashboard Images */}
                <div className="order-2 lg:order-1">
                    <div className="relative">
                        {/* Glow effect behind */}
                        <div className="absolute -inset-4 bg-gradient-to-r from-[#2C418F]/20 to-blue-400/20 dark:from-indigo-500/20 dark:to-purple-500/20 rounded-3xl blur-2xl"></div>
                        {/* Image container */}
                        <div className="relative bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-4 border border-gray-100 dark:border-slate-700">
                            <img 
                                src="/assets/images/app-uis.png" 
                                alt="HoverTask App Dashboard - Track your advertising performance" 
                                className="rounded-xl w-full" 
                                loading="lazy"
                            />
                        </div>
                    </div>
                </div>

                {/* Features Cards */}
                <div className="space-y-6 order-1 lg:order-2">
                    {features.map((feature, index) => (
                        <div
                            key={index}
                            className={`bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-slate-700 ${
                                index === 1 ? "lg:translate-x-8" : ""
                            }`}
                        >
                            <div className="flex items-start gap-4">
                                <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-[#2C418F] to-blue-600 dark:from-indigo-600 dark:to-purple-600 flex items-center justify-center flex-shrink-0">
                                    {index === 0 && <FaBullhorn className="text-white w-5 h-5" />}
                                    {index === 1 && <FaChartLine className="text-white w-5 h-5" />}
                                    {index === 2 && <FaMoneyBillWave className="text-white w-5 h-5" />}
                                </div>
                                <div className="flex-1">
                                    <h3 className="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2">{feature.title}</h3>
                                    <p className="text-gray-600 dark:text-slate-300 leading-relaxed mb-4">{feature.description}</p>
                                    <Link 
                                        to={feature.ctaLink}
                                        className="inline-flex items-center gap-2 bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 dark:from-indigo-600 dark:to-purple-600 dark:hover:from-indigo-500 dark:hover:to-purple-500 text-white py-2.5 px-6 rounded-xl font-semibold transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5"
                                    >
                                        {feature.cta}
                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default SocialMediaAdvertSection;
