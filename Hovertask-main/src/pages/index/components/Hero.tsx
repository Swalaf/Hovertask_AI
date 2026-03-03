import { Link } from "react-router-dom";

const Hero = () => {
    return (
        <section className="hero py-20 space-y-12 relative overflow-visible">
            <div className="flex gap-10 flex-col">
                <div className="text-center space-y-3 p-4 max-w-[778px] mx-auto">
                    <h1 className="text-5xl max-w-xl mx-auto font-medium">
                        Earn or Advertise on Social Media and Grow Your Business
                    </h1>
                    <p className="text-2xl max-w-lg mx-auto">
                        Earn by completing simple social media tasks or advertise your products to the right audience.
                    </p>
                </div>
                <div className="space-y-6 p-4">
                    <div className="flex items-center gap-6 justify-center flex-wrap">
                        <Link to="/signup" className="bg-base p-4 rounded-3xl text-white hover:bg-blue-500">
                            Create Account
                        </Link>
                        <Link
                            to="/signin"
                            className="border-[1.5px] border-base p-4 rounded-3xl text-base hover:bg-base hover:text-white"
                        >
                            Login Your Account
                        </Link>
                    </div>
                    <div className="flex items-center gap-6 justify-center">
                        <a href="#">
                            <img src="/assets/images/Google.png" alt="Google play logo" />
                        </a>
                        <a href="#">
                            <img src="/assets/images/Apple.png" alt="Apple store logo" />
                        </a>
                    </div>
                </div>
            </div>
            <div className="">
                <img
                    src="/assets/images/black-girls-city.png"
                    className="max-w-lg mx-auto block w-full"
                    alt="Girls using mobile phone"
                />
                <div className="bg-gradient-to-br from-blue-800 to-blue-600 p-6 flex items-center justify-around gap-2 flex-wrap">
                    <div className="text-sm text-center p-2 rounded-lg bg-gradient-to-b from-blue-600 via-blue-800 to-blue-900 text-white">
                        500k+ <br /> Members
                    </div>
                    <div className="text-sm text-center p-2 rounded-lg bg-gradient-to-b from-blue-600 via-blue-800 to-blue-900 text-white">
                        120k+ <br /> Downloads
                    </div>
                    <div className="text-sm text-center p-2 rounded-lg bg-gradient-to-b from-blue-600 via-blue-800 to-blue-900 text-white">
                        123k+ <br /> Advertisers
                    </div>
                    <div className="text-sm text-center p-2 rounded-lg bg-gradient-to-b from-blue-600 via-blue-800 to-blue-900 text-white">
                        15m+ <br /> Advert Views
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Hero;
