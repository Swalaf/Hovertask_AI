import { RiGogglesLine, RiTeamLine } from "react-icons/ri";
import CoreValues from "./components/CoreValues";

const About = () => {
    return (
        <div>
            <section className="hero p-4">
                <div className="space-y-6 p-4 text-center py-16">
                    <h1 className="text-[55.62px] mb-4 gradient-text">About Us - Hovertask</h1>
                    <p className="text-[33.37px]">Introduction</p>
                </div>
                <div className=" max-[1255px]:p-4">
                    <div className="w-full max-w-[1223.5px] mx-auto bg-[#e9edfe] rounded-[44.5px] px-8 transform rotate-[-2deg] p-12 mb-36">
                        <p className="text-xl font-light max-md:text-lg">
                            Welcome to Hovertask, your trusted platform for earning and advertising! At Hovertask, we
                            connect businesses with individuals who are ready to perform simple social media tasks,
                            advertise products, and help brands grow. Our mission is to create opportunities for people
                            to earn daily income while helping businesses reach a wider audience.
                        </p>
                    </div>
                </div>
                <div className="w-full flex max-md:flex-col justify-center gap-14 max-md:gap-0 items-center max-w-[1223.5px] mx-auto mb-36">
                    <img
                        src="/assets/images/Young african man having video call on laptop at home 1.png"
                        alt="Video Call"
                        className="w-[40%] max-md:w-full h-auto"
                        loading="lazy"
                    />
                    <div className="flex flex-col justify-center gap-3 px-3">
                        <h3 className="gradient-text text-6xl">Our Mission</h3>
                        <p className="font-light text-[20px]">
                            To empower individuals by providing them with easy, flexible ways to earn and to support
                            businesses in achieving their marketing goals through innovative solutions.
                        </p>
                    </div>
                </div>
                <div className="w-full mb-18 space-y-18  max-w-[1223px] mx-auto max-[1255px]:p-4">
                    <div className="max-w-[887.1px] w-full">
                        <h3 className="gradient-text text-[41.26px]">Our Vision</h3>
                        <div className="shadow-lg p-6 shadow-gray-200 bg-[#EEF0FF] rounded-3xl md:flex justify-center gap-14 items-center max-m px-2 text-[20px] font-light">
                            <RiGogglesLine
                                size={70}
                                className="text-base max-md:text-lg max-md:float-left max-md:mr-4"
                            />
                            <p className="text-light">
                                To become the leading platform for micro-jobs, advertising, and product reselling in the
                                digital space, empowering millions of users globally.
                            </p>
                        </div>
                    </div>
                    <div className="max-w-[887.1px] w-full float-right">
                        <h3 className="gradient-text text-[41.26px]">Our Team</h3>
                        <div className="shadow-lg p-6 shadow-gray-200 bg-[#00B3060D] rounded-3xl md:flex justify-center gap-14 items-center max-md:w-full px-2 text-[20px] font-light">
                            <RiTeamLine size={70} className="text-base max-md:text-lg max-md:float-left max-md:mr-4" />
                            <p className="text-light">
                                Hovertask is powered by a team of dedicated professionals who are passionate about
                                creating opportunities for individuals and businesses.
                            </p>
                        </div>
                    </div>
                    <div className="clear-right"></div>
                </div>
            </section>
            <CoreValues />
        </div>
    );
};

export default About;
