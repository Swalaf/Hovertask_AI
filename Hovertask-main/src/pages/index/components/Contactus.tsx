import { PiNavigationArrow } from "react-icons/pi";
import { FaYoutube, FaInstagram, FaTwitter, FaLinkedin } from "react-icons/fa";
import { CgMail } from "react-icons/cg";
import { BiPhone } from "react-icons/bi";

const SectionHeader = ({ title }: { title: string }) => (
    <p className="text-4xl font-light bg-gradient-to-l from-[#2C418F] to-base text-transparent bg-clip-text">{title}</p>
);

const ContactUs = () => {
    return (
        <div className="w-full h-auto flex flex-col items-center py-5">
            {/* Section Title */}
            <div className="w-full h-[20vh] flex justify-center gap-2 items-center flex-col">
                <SectionHeader title="Contact Us" />
            </div>

            {/* Background Image Section */}
            <div className="relative w-full max-w-4xl h-[20rem] rounded-2xl overflow-hidden transform rotate-[-2deg] mb-10 px-2">
                <img
                    src="/assets/images/Group 1000004576.png"
                    alt="Contact Us"
                    className="w-full h-full object-cover"
                />
                <div className="absolute inset-0 bg-opacity-50 flex items-center justify-center">
                    <p className="text-white text-center px-6 text-lg">
                        We'd love to hear from you! Whether you have questions, feedback, or need assistance, feel free
                        to reach out to us through any of the channels below
                    </p>
                </div>
            </div>

            <Contact />
        </div>
    );
};

const Contact = () => {
    return (
        <div className="w-full max-w-6xl px-4 space-y-10">
            {/* Section Title */}
            <div className="text-center">
                <SectionHeader title="Get in Touch" />
            </div>

            {/* Contact Container */}
            <div className="flex max-md:flex-col gap-8 bg-white shadow-xl rounded-2xl overflow-hidden">
                {/* Left Section - Contact Info */}
                <div className="w-1/2 max-md:w-full bg-[#F5F7FF] p-8 space-y-6">
                    <div className="space-y-4">
                        <div className="flex items-center space-x-4">
                            <BiPhone className="text-base w-6 h-6" />
                            <div>
                                <p className="font-semibold text-base">Phone Number</p>
                                <p>+234-XXX-XXX-XXXX</p>
                            </div>
                        </div>

                        <div className="flex items-center space-x-4">
                            <CgMail className="text-base w-6 h-6" />
                            <div>
                                <p className="font-semibold text-base">Email</p>
                                <p>support@hovertask.com</p>
                            </div>
                        </div>

                        <div className="flex items-center space-x-4">
                            <img
                                src="/assets/images/whatsapp-removebg-preview.png"
                                alt="WhatsApp"
                                className="w-8 h-8 object-contain"
                            />
                            <div>
                                <p className="font-semibold text-base">WhatsApp Support</p>
                                <a href="#" className="text-blue-500 hover:underline">
                                    Click here to chat
                                </a>
                            </div>
                        </div>

                        <div className="flex items-start space-x-4">
                            <PiNavigationArrow className="text-base w-6 h-6 mt-1" />
                            <div>
                                <p className="font-semibold text-base">Address</p>
                                <p>Hovertask Headquarters, 123 Business Lane, Lagos, Nigeria</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Right Section - Contact Form */}
                <div className="w-1/2 max-md:w-full p-8">
                    <form className="space-y-4">
                        <input
                            type="text"
                            placeholder="First Name"
                            className="w-full p-3 rounded-md bg-[#F4F4FA] border border-gray-200 focus:outline-base"
                        />
                        <input
                            type="email"
                            placeholder="Email Address"
                            className="w-full p-3 rounded-md bg-[#F4F4FA] border border-gray-200 focus:outline-base"
                        />
                        <textarea
                            placeholder="Your Message"
                            className="w-full p-3 rounded-md h-24 bg-[#F4F4FA] border border-gray-200 focus:outline-base"
                        ></textarea>
                        <button className="w-full bg-base text-white p-3 rounded-md hover:bg-[#2C418F] transition">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            {/* Social Media Section */}
            <div className="text-center space-y-6">
                <SectionHeader title="Follow Us on Social Media" />
                <div className="flex justify-center space-x-4 text-base">
                    {[FaYoutube, FaTwitter, FaInstagram, FaLinkedin].map((Icon, index) => (
                        <button
                            key={index}
                            className="p-3 rounded-full border border-base hover:bg-base hover:text-white transition"
                        >
                            <Icon size={24} />
                        </button>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default ContactUs;
