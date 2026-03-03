import { Link } from "react-router-dom";

const JoinUsSection = () => {
    return (
        <section className="relative bg-gradient-to-r from-base to-[#2C418F] text-white rounded-full flex items-center p-4 max-w-[1199px] mx-auto overflow-hidden max-md:rounded-2xl max-md:py-10 mb-32 z-0">
            {/* Gradient decoration */}
            <div className="bg-gradient-to-r from-[#BAC7F8] to-base h-[80%] w-[159px] rounded-[192px] right-1/2 absolute z-0"></div>
            <div className="max-md:hidden -translate-x-2">
                <img src="/assets/images/sittingdown.png" alt="Woman sitting down" />
            </div>
            <div className="text-center md:text-left space-y-6">
                <h2 className="text-[40px] relative">Join Us Today and Start Earning or Advertising!</h2>
                <div className="flex flex-wrap justify-center md:justify-start gap-6 relative">
                    <Link
                        to="#"
                        className="bg-white text-blue-700 px-6 py-2 rounded-3xl font-medium shadow hover:bg-gray-200 transition"
                    >
                        Create Account
                    </Link>
                    <Link
                        to="#"
                        className="bg-transparent border border-white px-6 py-2 rounded-3xl font-medium hover:bg-white hover:text-blue-700 transition"
                    >
                        Login to Account
                    </Link>
                </div>
                <div className="flex justify-center md:justify-start gap-6">
                    <img
                        src="/assets/images/Apple.png"
                        alt="App Store"
                        className="h-12 transform hover:scale-105 transition"
                    />
                    <img
                        src="/assets/images/Google.png"
                        alt="Google Play"
                        className="h-12 transform hover:scale-105 transition"
                    />
                </div>
            </div>
        </section>
    );
};

export default JoinUsSection;
