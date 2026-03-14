import { Link } from "react-router-dom";
import { RiGogglesLine, RiTeamLine } from "react-icons/ri";
import { MdLightbulb, MdVerified } from "react-icons/md";
import CoreValues from "./components/CoreValues";

const About = () => {
    return (
        <div className="w-full">
            <section className="hero p-4 w-full">
                <div className="space-y-6 p-4 text-center py-12 md:py-16 w-full">
                    <h1 className="text-3xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-[#2C418F] to-blue-600 text-transparent bg-clip-text">
                        About HoverTask
                    </h1>
                    <p className="text-xl md:text-2xl text-gray-600 w-full">
                        Empowering individuals and businesses to succeed in the digital economy
                    </p>
                </div>
                
                <div className="w-full p-4 md:p-8">
                    <div className="w-full bg-gradient-to-br from-[#2C418F]/10 via-[#2C418F]/5 to-blue-50 rounded-3xl p-8 md:p-12 transform rotate-[-1deg]">
                        <p className="text-lg md:text-xl text-gray-700 leading-relaxed text-center">
                            Welcome to <span className="font-bold text-[#2C418F]">HoverTask</span>, your trusted platform for earning and advertising! At HoverTask, we 
                            connect businesses with individuals who are ready to perform simple social media tasks, 
                            advertise products, and help brands grow. Our mission is to create opportunities for people 
                            to earn daily income while helping businesses reach a wider audience.
                        </p>
                    </div>
                </div>
                
                <div className="w-full flex flex-col md:flex-row justify-center items-center gap-8 md:gap-14 max-w-5xl mx-auto mb-16 p-4">
                    <img
                        src="/assets/images/Young african man having video call on laptop at home 1.png"
                        alt="Video Call - Team collaboration at HoverTask"
                        className="w-full md:w-[45%] h-auto rounded-2xl shadow-xl"
                        loading="lazy"
                    />
                    <div className="flex flex-col justify-center gap-4 md:gap-6 text-center md:text-left">
                        <h3 className="text-3xl md:text-4xl font-bold bg-gradient-to-r from-[#2C418F] to-blue-600 text-transparent bg-clip-text">
                            Our Mission
                        </h3>
                        <p className="text-lg text-gray-600 leading-relaxed">
                            To empower individuals by providing them with easy, flexible ways to earn and to support 
                            businesses in achieving their marketing goals through innovative solutions.
                        </p>
                        <Link 
                            to="/signup" 
                            className="inline-flex items-center gap-2 text-[#2C418F] hover:text-blue-700 font-semibold transition-colors mt-2"
                        >
                            Join our community
                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </Link>
                    </div>
                </div>
                
                <div className="w-full mb-16 max-w-4xl mx-auto p-4 space-y-8">
                    <div className="w-full">
                        <h3 className="text-2xl md:text-3xl font-bold bg-gradient-to-r from-[#2C418F] to-blue-600 text-transparent bg-clip-text mb-6">
                            Our Vision
                        </h3>
                        <div className="shadow-lg p-6 md:p-8 shadow-gray-200/50 bg-white rounded-2xl flex flex-col md:flex-row gap-6 items-center">
                            <RiGogglesLine
                                size={60}
                                className="text-[#2C418F] flex-shrink-0"
                            />
                            <p className="text-lg text-gray-700 leading-relaxed">
                                To become the leading platform for micro-jobs, advertising, and product reselling in the 
                                digital space, empowering millions of users globally to achieve financial freedom.
                            </p>
                        </div>
                    </div>
                    
                    <div className="w-full">
                        <h3 className="text-2xl md:text-3xl font-bold bg-gradient-to-r from-[#2C418F] to-blue-600 text-transparent bg-clip-text mb-6">
                            Our Team
                        </h3>
                        <div className="shadow-lg p-6 md:p-8 shadow-gray-200/50 bg-white rounded-2xl flex flex-col md:flex-row gap-6 items-center">
                            <RiTeamLine size={60} className="text-green-500 flex-shrink-0" />
                            <p className="text-lg text-gray-700 leading-relaxed">
                                HoverTask is powered by a team of dedicated professionals who are passionate about 
                                creating opportunities for individuals and businesses to thrive in the digital economy.
                            </p>
                        </div>
                    </div>
                </div>

                {/* Stats Section */}
                <div className="max-w-5xl mx-auto px-4 py-8 mb-12">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                        {[
                            { number: "500K+", label: "Active Users" },
                            { number: "₦500M+", label: "Paid to Users" },
                            { number: "120K+", label: "App Downloads" },
                            { number: "15M+", label: "Ad Impressions" }
                        ].map((stat, index) => (
                            <div key={index} className="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow">
                                <div className="text-2xl md:text-3xl font-bold text-[#2C418F]">{stat.number}</div>
                                <div className="text-gray-600 text-sm md:text-base mt-1">{stat.label}</div>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Why Choose Us */}
                <div className="max-w-5xl mx-auto px-4 py-8">
                    <h3 className="text-2xl md:text-3xl font-bold text-center mb-8 bg-gradient-to-r from-[#2C418F] to-blue-600 text-transparent bg-clip-text">
                        Why Choose HoverTask?
                    </h3>
                    <div className="grid md:grid-cols-3 gap-6">
                        {[
                            { icon: MdVerified, title: "Trusted Platform", desc: "Secure payments and verified users" },
                            { icon: MdLightbulb, title: "Easy to Start", desc: "No investment required to begin" },
                            { icon: RiTeamLine, title: "24/7 Support", desc: "Round-the-clock assistance" }
                        ].map((item, index) => (
                            <div key={index} className="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 text-center">
                                <div className="w-14 h-14 mx-auto bg-[#2C418F]/10 rounded-full flex items-center justify-center mb-4">
                                    <item.icon className="w-7 h-7 text-[#2C418F]" />
                                </div>
                                <h4 className="font-bold text-gray-800 mb-2">{item.title}</h4>
                                <p className="text-gray-600 text-sm">{item.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
            <CoreValues />
        </div>
    );
};

export default About;
