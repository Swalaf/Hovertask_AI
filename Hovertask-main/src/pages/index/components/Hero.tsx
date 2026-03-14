import { Link } from "react-router-dom";

const Hero = () => {
    return (
        <section className="hero py-20 md:py-28 relative overflow-visible dark:bg-gradient-to-b dark:from-slate-900 dark:via-indigo-950/30 dark:to-slate-900">
            {/* Background Pattern */}
            <div className="absolute inset-0 overflow-hidden pointer-events-none">
                <div className="absolute top-0 left-1/4 w-96 h-96 bg-[#2C418F]/5 dark:bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div className="absolute bottom-0 right-1/4 w-80 h-80 bg-blue-500/5 dark:bg-purple-500/10 rounded-full blur-3xl"></div>
            </div>
            <div className="flex gap-10 flex-col">
                <div className="text-center space-y-6 p-4 max-w-[900px] mx-auto">
                    <div className="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-indigo-500/20 rounded-full text-blue-600 dark:text-indigo-400 text-sm font-medium mb-2">
                        <span className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        Trusted by 500,000+ users worldwide
                    </div>
                    <h1 className="text-4xl md:text-5xl lg:text-6xl max-w-3xl mx-auto font-bold text-zinc-900 dark:text-white leading-tight">
                        <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400">Earn Money</span> Online or <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400">Advertise</span> Your Business
                    </h1>
                    <p className="text-lg md:text-xl max-w-2xl mx-auto text-zinc-600 dark:text-slate-300 leading-relaxed">
                        Complete simple social media tasks to earn extra income, or promote your products to thousands of potential customers. Start today — it takes less than 2 minutes to join.
                    </p>
                </div>
                <div className="space-y-8 p-4">
                    <div className="flex items-center gap-4 justify-center flex-wrap">
                        <Link 
                            to="/signup" 
                            className="bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 dark:from-indigo-600 dark:to-purple-600 dark:hover:from-indigo-500 dark:hover:to-purple-500 px-8 py-4 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 font-semibold text-base inline-flex items-center gap-2"
                        >
                            Get Started Free
                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </Link>
                        <Link
                            to="/signin"
                            className="border-2 border-[#2C418F] dark:border-indigo-400 text-[#2C418F] dark:text-indigo-400 px-8 py-4 rounded-2xl hover:bg-[#2C418F] dark:hover:bg-indigo-500 hover:text-white dark:hover:text-white shadow-md hover:shadow-lg transition-all hover:-translate-y-1 font-semibold text-base"
                        >
                            Sign In
                        </Link>
                    </div>
                    <div className="flex items-center gap-6 justify-center text-sm text-zinc-500 dark:text-slate-400">
                        <span className="flex items-center gap-2">
                            <svg className="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" /></svg>
                            No credit card required
                        </span>
                        <span className="flex items-center gap-2">
                            <svg className="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" /></svg>
                            Cancel anytime
                        </span>
                    </div>
                </div>
            </div>
            <div className="">
                <img
                    src="/assets/images/black-girls-city.png"
                    className="max-w-lg mx-auto block w-full rounded-2xl shadow-2xl dark:shadow-indigo-500/20"
                    alt="Hovertask - Earn money online and advertise your business"
                    loading="eager"
                />
                <div className="bg-gradient-to-br from-[#2C418F] via-blue-700 to-blue-600 dark:from-indigo-600 dark:via-purple-700 dark:to-purple-600 p-6 md:p-8 flex items-center justify-around gap-4 flex-wrap rounded-2xl shadow-2xl max-w-4xl mx-auto mt-10">
                    <div className="text-center p-3 rounded-xl bg-white/10 backdrop-blur-sm text-white">
                        <span className="text-2xl md:text-3xl font-bold">500k+</span> <br /> <span className="text-sm opacity-90">Active Members</span>
                    </div>
                    <div className="w-px h-12 bg-white/20 hidden md:block"></div>
                    <div className="text-center p-3 rounded-xl bg-white/10 backdrop-blur-sm text-white">
                        <span className="text-2xl md:text-3xl font-bold">₦500M+</span> <br /> <span className="text-sm opacity-90">Paid to Users</span>
                    </div>
                    <div className="w-px h-12 bg-white/20 hidden md:block"></div>
                    <div className="text-center p-3 rounded-xl bg-white/10 backdrop-blur-sm text-white">
                        <span className="text-2xl md:text-3xl font-bold">120k+</span> <br /> <span className="text-sm opacity-90">App Downloads</span>
                    </div>
                    <div className="w-px h-12 bg-white/20 hidden md:block"></div>
                    <div className="text-center p-3 rounded-xl bg-white/10 backdrop-blur-sm text-white">
                        <span className="text-2xl md:text-3xl font-bold">15M+</span> <br /> <span className="text-sm opacity-90">Ad Impressions</span>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Hero;
