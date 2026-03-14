import { Link } from "react-router-dom";

const ReferAndEarn = () => {
    return (
        <section className="space-y-8 mb-24 py-8 dark:bg-slate-900">
            <div className="max-w-4xl mx-auto px-4">
                <h2 className="text-3xl md:text-4xl font-bold bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 text-transparent bg-clip-text">
                    Refer & Earn Money
                </h2>
            </div>
            
            <div className="bg-gradient-to-b from-white via-[#DAE2FF]/30 to-[#DAE2FF]/50 dark:from-slate-900 dark:via-indigo-950/50 dark:to-slate-900 rounded-3xl flex flex-col items-center p-8 md:p-12 max-w-5xl mx-auto">
                <div className="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                    <div className="flex-1 text-center lg:text-left">
                        <h3 className="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-4">
                            Share the Opportunity, Earn Rewards
                        </h3>
                        <p className="text-lg text-gray-600 dark:text-slate-300 mb-6 leading-relaxed">
                            Share your referral link with friends and get rewarded. Earn{" "}
                            <span className="font-bold text-[#2C418F] dark:text-indigo-400">₦500</span> for every new member who joins the platform.
                        </p>
                        <ul className="space-y-3 mb-8">
                            {[
                                "₦500 when they sign up",
                                "Bonus when they make their first deposit",
                                "Lifetime earnings from their activity"
                            ].map((benefit, index) => (
                                <li key={index} className="flex items-center gap-3 text-gray-600 dark:text-slate-300">
                                    <svg className="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                                    </svg>
                                    {benefit}
                                </li>
                            ))}
                        </ul>
                        <Link 
                            to="/signup" 
                            className="inline-flex items-center gap-2 bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 dark:from-indigo-600 dark:to-purple-600 dark:hover:from-indigo-500 dark:hover:to-purple-500 text-white py-3 px-8 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5"
                        >
                            Get Your Referral Link
                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </Link>
                    </div>
                    
                    <div className="relative flex-shrink-0">
                        <img
                            src="/assets/images/closeup-shot-two-pretty-afro-american-girls-using-their-phones-while-holding-shopping-bags.png"
                            alt="Friends shopping together - Earn with HoverTask referral program"
                            className="w-full max-w-sm object-cover rounded-2xl shadow-xl dark:shadow-2xl dark:shadow-indigo-500/20"
                            loading="lazy"
                        />
                        <div className="absolute top-4 right-4 bg-white dark:bg-slate-800 px-4 py-3 rounded-xl shadow-lg">
                            <div className="text-sm text-gray-500 dark:text-slate-400">Earn up to</div>
                            <div className="text-2xl font-bold text-[#2C418F] dark:text-indigo-400">₦10,000+</div>
                            <div className="text-xs text-gray-400 dark:text-slate-500">per referral</div>
                        </div>
                    </div>
                </div>
                
                {/* CTA Banner */}
                <div className="mt-10 w-full">
                    <div className="bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-600 dark:to-purple-600 text-white text-center p-6 md:p-8 rounded-2xl">
                        <p className="text-lg md:text-xl font-medium">
                            Bring new members and earn when they deposit and when they work. <span className="font-bold">Passive income for life!</span>
                        </p>
                        <p className="mt-2 opacity-90">Yes, it's that easy!</p>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default ReferAndEarn;
