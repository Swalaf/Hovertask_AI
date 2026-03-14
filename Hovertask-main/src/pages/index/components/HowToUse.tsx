import { useState } from "react";
import { FaPlay } from "react-icons/fa";

const HowToUseSection = () => {
    const [isPlaying, setIsPlaying] = useState(false);

    const videoId = "liawwds71XQ";

    return (
        <section className="bg-gradient-to-b from-white via-gray-50 to-white dark:from-slate-900 dark:via-slate-800/50 dark:to-slate-900 py-16 md:py-24 px-4 relative overflow-hidden">
            {/* Background decorations */}
            <div className="absolute inset-0 pointer-events-none">
                <div className="absolute top-1/2 left-10 w-72 h-72 bg-[#2C418F]/3 dark:bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div className="absolute top-1/3 right-10 w-96 h-96 bg-blue-400/3 dark:bg-purple-500/10 rounded-full blur-3xl"></div>
            </div>
            <div className="max-w-screen-lg mx-auto relative z-10">
                <div className="max-w-[717px] mx-auto mb-12 text-center">
                    <h2 className="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 text-transparent bg-clip-text">
                        How Easy to Use HoverTask
                    </h2>
                    <p className="text-lg md:text-xl text-gray-600 dark:text-slate-300">
                        Whether you're an Earner or an Advertiser, getting started is simple! Follow these easy steps to achieve your goals.
                    </p>
                </div>

                <div className="relative w-full max-w-[682px] mx-auto rounded-2xl overflow-hidden shadow-2xl">
                    {/* Glow effect */}
                    <div className="absolute -inset-2 bg-gradient-to-r from-[#2C418F]/10 to-blue-400/10 dark:from-indigo-500/20 dark:to-purple-500/20 rounded-3xl blur-xl"></div>
                    <div className="relative bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-2 border border-gray-100 dark:border-slate-700">
                    {isPlaying ? (
                        <iframe
                            className="w-full h-[380px] md:h-[420px] rounded-2xl"
                            src={`https://www.youtube.com/embed/${videoId}?autoplay=1`}
                            title="How to Use HoverTask - Tutorial Video"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowFullScreen
                        ></iframe>
                    ) : (
                        <div
                            className="relative cursor-pointer group"
                            onClick={() => setIsPlaying(true)}
                        >
                            <img
                                src="/assets/images/how.png"
                                alt="Watch how to use HoverTask - Tutorial Video"
                                className="rounded-2xl w-full"
                                loading="lazy"
                            />

                            <div className="absolute inset-0 flex justify-center items-center bg-black/20 group-hover:bg-black/30 transition-colors">
                                <div className="w-20 h-20 md:w-24 md:h-24 text-white bg-red-500 rounded-full p-4 md:p-5 shadow-lg flex justify-center items-center transform group-hover:scale-110 transition-transform">
                                    <FaPlay className="text-xl md:text-2xl ml-1" />
                                </div>
                            </div>
                        </div>
                    )}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default HowToUseSection;
