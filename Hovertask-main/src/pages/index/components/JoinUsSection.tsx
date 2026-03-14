import { Link } from "react-router-dom";

const JoinUsSection = () => {
    return (
        <section className="relative bg-gradient-to-r from-[#2C418F] to-[#1a2a5e] dark:from-indigo-900 dark:to-slate-950 text-white rounded-3xl flex items-center p-6 md:p-12 max-w-5xl mx-auto overflow-hidden mb-20 z-0">
            {/* Gradient decoration */}
            <div className="bg-gradient-to-r from-blue-300 to-[#2C418F] h-[80%] w-[200px] rounded-full right-0 md:right-1/3 absolute z-0 opacity-30"></div>
            
            <div className="hidden md:block absolute -left-4">
                <img 
                    src="/assets/images/sittingdown.png" 
                    alt="Join HoverTask today" 
                    className="max-w-xs"
                    loading="lazy"
                />
            </div>
            
            <div className="text-center md:text-left md:ml-auto space-y-6 relative z-10">
                <h2 className="text-2xl md:text-3xl lg:text-4xl font-bold">
                    Join Us Today and Start Earning or Advertising!
                </h2>
                <p className="text-white/80 text-lg max-w-lg">
                    Join thousands of users already earning and growing their businesses on HoverTask.
                </p>
                <div className="flex flex-wrap justify-center md:justify-start gap-4">
                    <Link
                        to="/signup"
                        className="bg-white text-[#2C418F] dark:text-indigo-600 px-8 py-3 rounded-2xl font-semibold shadow-lg hover:bg-gray-100 dark:hover:bg-slate-100 hover:shadow-xl transition-all hover:-translate-y-0.5"
                    >
                        Create Account
                    </Link>
                    <Link
                        to="/signin"
                        className="bg-transparent border-2 border-white px-8 py-3 rounded-2xl font-semibold hover:bg-white hover:text-[#2C418F] dark:hover:text-indigo-600 transition-all"
                    >
                        Sign In
                    </Link>
                </div>
                <div className="flex justify-center md:justify-start gap-4 pt-2">
                    <a href="#" className="inline-block">
                        <img
                            src="/assets/images/Apple.png"
                            alt="Download on App Store"
                            className="h-10 md:h-12 transform hover:scale-105 transition"
                            loading="lazy"
                        />
                    </a>
                    <a href="#" className="inline-block">
                        <img
                            src="/assets/images/Google.png"
                            alt="Get it on Google Play"
                            className="h-10 md:h-12 transform hover:scale-105 transition"
                            loading="lazy"
                        />
                    </a>
                </div>
            </div>
        </section>
    );
};

export default JoinUsSection;
