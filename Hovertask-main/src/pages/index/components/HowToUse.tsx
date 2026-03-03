import { useState } from "react";
import { FaPlay } from "react-icons/fa";

const HowToUseSection = () => {
    const [isPlaying, setIsPlaying] = useState(false);

    const videoId = "liawwds71XQ"; // extracted from your YouTube link

    return (
        <section className="bg-white pb-32 px-4 rounded-lg flex flex-col items-center text-center max-w-screen-lg mx-auto">
            <div className="max-w-[717px] mx-auto mb-12">
                <h2 className="text-[40px] gradient-text">How Easy to Use Hovertask</h2>
                <p className="text-2xl">
                    Whether you're an Earner or an Advertiser, getting started is simple! Follow these easy steps to
                    achieve your goals.
                </p>
            </div>

            <div className="relative w-full max-w-[682px] rounded-[26.98px] overflow-hidden">
                {isPlaying ? (
                    // ▶️ When clicked — show iframe video player
                    <iframe
                        className="w-full h-[380px] rounded-[26.98px]"
                        src={`https://www.youtube.com/embed/${videoId}?autoplay=1`}
                        title="How to Use Hovertask"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowFullScreen
                    ></iframe>
                ) : (
                    // 🖼️ Before clicking — show image with play button
                    <div
                        className="relative cursor-pointer"
                        onClick={() => setIsPlaying(true)}
                    >
                        <img
                            src="/assets/images/how.png"
                            alt="How to Use Hovertask"
                            className="rounded-[26.98px] w-full"
                        />

                        <div className="absolute inset-0 flex justify-center items-center">
                            <div className="w-16 h-16 text-white bg-red-500 rounded-full p-3 shadow-lg flex justify-center items-center">
                                <FaPlay />
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </section>
    );
};

export default HowToUseSection;
