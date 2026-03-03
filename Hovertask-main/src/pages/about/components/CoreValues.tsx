import { LuDot } from "react-icons/lu";
import { Link } from "react-router-dom";

const CoreValues = () => {
    return (
        <div className="w-full flex flex-col bg-white items-center justify-center py-12 px-14 max-md:px-1">
            <div className="w-full flex items-center justify-center gap-5 max-lg:flex-col">
                <div className="lg:w-[40%] w-[90%]">
                    <div className="lg:w-[60%] max-lg:justify-center bg-gradient-to-l from-[#DAE2FF]/10 to-[#DAE2FF] h-[7rem] flex justify-center items-center rounded-3xl transform rotate-[-2deg] ">
                        <p className="text-4xl font-light bg-gradient-to-l from-[#2C418F] to-base text-transparent bg-clip-text">
                            Our Core <span className="text-black">Values</span>
                        </p>
                    </div>
                    <img src="/assets/images/Rectangle 39338.png" alt="Core Values" className="rounded-xl" />
                </div>
                <div className="lg:w-[50%] max-md:w-full space-y-3 leading-8 text-[20px] max-md:p-4">
                    <p className="md:flex items-start gap-4">
                        <span className="text-base inline-flex items-center gap-2">
                            <LuDot className="text-base" size={24} /> Transparency:
                        </span>{" "}
                        We ensure honesty and clarity in all transactions.
                    </p>
                    <p className="md:flex items-start gap-4">
                        <span className="text-base inline-flex items-center gap-2">
                            <LuDot className="text-base" size={24} /> Innovation:
                        </span>{" "}
                        We continuously improve to serve you better.
                    </p>
                    <p className="md:flex items-start gap-4">
                        <span className="text-base inline-flex items-center gap-2">
                            <LuDot className="text-base" size={24} /> Empowerment:
                        </span>{" "}
                        We aim to uplift individuals and businesses alike.
                    </p>
                    <p className="md:flex items-start gap-4">
                        <span className="text-base inline-flex items-center gap-2">
                            <LuDot className="text-base" size={24} /> Community:
                        </span>{" "}
                        We are building a network where everyone can thrive together.
                    </p>
                    <div className="mt-8 flex flex-wrap gap-4">
                        <Link
                            to="/signup"
                            className="px-6 py-2 bg-base text-white rounded-3xl shadow-md hover:bg-[#2C418F] transition"
                        >
                            Create Account
                        </Link>
                        <Link
                            to="/signin"
                            className="px-6 py-2 border border-base text-base rounded-3xl shadow-md hover:bg-base hover:text-white transition"
                        >
                            Login your Account
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CoreValues;
