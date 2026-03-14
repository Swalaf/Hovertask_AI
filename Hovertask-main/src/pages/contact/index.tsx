import { useState } from "react";
import { FaYoutube, FaInstagram, FaTwitter, FaLinkedin, FaWhatsapp } from "react-icons/fa";
import { CgMail } from "react-icons/cg";
import { Link } from "react-router-dom";

const ContactUs = () => {
    return (
        <div className="w-full h-auto flex flex-col items-center dark:bg-slate-900">
            <h2 className="gradient-text dark:gradient-text-dark text-3xl md:text-4xl lg:text-5xl font-bold text-center pt-8 md:pt-14 dark:text-white">Contact Us</h2>
            <div className="relative w-full h-48 md:h-64 rounded-2xl overflow-hidden transform rotate-[-1deg] mb-8 md:mb-10 px-2">
                <img
                    src="/assets/images/Group 1000004576.png"
                    alt="Contact HoverTask - Get in touch with our team"
                    className="w-full h-full object-cover"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-[#2C418F]/80 via-[#2C418F]/40 to-transparent flex items-center justify-center">
                    <p className="text-white text-center px-6 text-lg md:text-xl font-medium w-full">
                        We'd love to hear from you! Whether you have questions, feedback, or need assistance, feel free to reach out
                    </p>
                </div>
            </div>
            <ContactForm />
        </div>
    );
};

const ContactForm = () => {
    const [formData, setFormData] = useState({ firstName: "", email: "", message: "" });
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [submitted, setSubmitted] = useState(false);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setIsSubmitting(true);
        // Simulate submission
        await new Promise(resolve => setTimeout(resolve, 1500));
        setIsSubmitting(false);
        setSubmitted(true);
    };

    return (
        <div className="w-full px-4 space-y-10 pb-12">
            {/* Section Title */}
            <div className="text-center">
                <h2 className="gradient-text text-3xl md:text-4xl font-bold text-center">Get In Touch</h2>
                <p className="text-gray-600 dark:text-slate-300 mt-3 max-w-xl mx-auto">
                    Have a question or need support? Fill out the form below and we'll get back to you as soon as possible.
                </p>
            </div>

            {/* Contact Container */}
            <div className="flex max-md:flex-col gap-6 md:gap-8 dark:bg-slate-900 dark:bg-slate-800 shadow-xl dark:shadow-2xl dark:shadow-indigo-500/10 rounded-2xl overflow-hidden">
                {/* Left Section - Contact Info */}
                <div className="w-full md:w-1/2 bg-gradient-to-br from-[#2C418F]/5 to-blue-50 dark:from-indigo-500/20 dark:to-slate-800 p-6 md:p-8 space-y-6">
                    <div className="space-y-6">
                        <h3 className="text-xl font-bold text-gray-800">Contact Information</h3>
                        
                        <div className="flex items-center gap-4">
                            <div className="w-10 h-10 rounded-full bg-[#2C418F]/10 flex items-center justify-center flex-shrink-0">
                                <CgMail className="text-[#2C418F] w-5 h-5" />
                            </div>
                            <div>
                                <p className="font-semibold text-gray-800">Email</p>
                                <a href="mailto:support@hovertask.com" className="text-gray-600 dark:text-slate-300 hover:text-[#2C418F] dark:hover:text-indigo-400 transition-colors">
                                    support@hovertask.com
                                </a>
                            </div>
                        </div>

                        <div className="flex items-center gap-4">
                            <div className="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <FaWhatsapp className="text-green-500 w-5 h-5" />
                            </div>
                            <div>
                                <p className="font-semibold text-gray-800">WhatsApp Community</p>
                                <a href="https://chat.whatsapp.com/FQ9p0JMv6BY2wtevK2htVu" target="_blank" rel="noopener noreferrer" className="text-[#2C418F] hover:text-blue-700 font-medium transition-colors">
                                    Join our Community
                                </a>
                            </div>
                        </div>
                    </div>

                    <div className="pt-6 border-t border-gray-200">
                        <h4 className="font-semibold text-gray-800 mb-4">Follow Us</h4>
                        <div className="flex gap-3">
                            <a href="https://web.facebook.com/hovertaskng" target="_blank" rel="noopener noreferrer" className="p-3 rounded-full border border-gray-200 hover:bg-[#2C418F] hover:text-white hover:border-[#2C418F] transition-all">
                                <FaTwitter size={18} />
                            </a>
                            <a href="https://www.instagram.com/hovertaskng/" target="_blank" rel="noopener noreferrer" className="p-3 rounded-full border border-gray-200 hover:bg-[#2C418F] hover:text-white hover:border-[#2C418F] transition-all">
                                <FaInstagram size={18} />
                            </a>
                            <a href="https://www.linkedin.com/company/hovertask-ng" target="_blank" rel="noopener noreferrer" className="p-3 rounded-full border border-gray-200 hover:bg-[#2C418F] hover:text-white hover:border-[#2C418F] transition-all">
                                <FaLinkedin size={18} />
                            </a>
                            <a href="https://www.youtube.com/@Hovertaskng" target="_blank" rel="noopener noreferrer" className="p-3 rounded-full border border-gray-200 hover:bg-[#2C418F] hover:text-white hover:border-[#2C418F] transition-all">
                                <FaYoutube size={18} />
                            </a>
                        </div>
                    </div>
                </div>

                {/* Right Section - Contact Form */}
                <div className="w-full md:w-1/2 p-6 md:p-8">
                    {submitted ? (
                        <div className="h-full flex flex-col items-center justify-center text-center space-y-4">
                            <div className="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                                <svg className="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-gray-800">Message Sent!</h3>
                            <p className="text-gray-600">Thank you for reaching out. We'll get back to you within 24 hours.</p>
                            <button onClick={() => setSubmitted(false)} className="text-[#2C418F] hover:text-blue-700 font-medium">
                                Send another message
                            </button>
                        </div>
                    ) : (
                        <form onSubmit={handleSubmit} className="space-y-5">
                            <div>
                                <label htmlFor="firstName" className="block text-sm font-semibold text-gray-700 mb-1.5">
                                    First Name
                                </label>
                                <input
                                    id="firstName"
                                    type="text"
                                    required
                                    placeholder="Enter your first name"
                                    value={formData.firstName}
                                    onChange={(e) => setFormData({ ...formData, firstName: e.target.value })}
                                    className="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2C418F] focus:ring-2 focus:ring-[#2C418F]/20 transition-all outline-none bg-gray-50/50"
                                />
                            </div>
                            <div>
                                <label htmlFor="email" className="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Email Address
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    required
                                    placeholder="Enter your email"
                                    value={formData.email}
                                    onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                                    className="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2C418F] focus:ring-2 focus:ring-[#2C418F]/20 transition-all outline-none bg-gray-50/50"
                                />
                            </div>
                            <div>
                                <label htmlFor="message" className="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Message
                                </label>
                                <textarea
                                    id="message"
                                    required
                                    placeholder="How can we help you?"
                                    rows={4}
                                    value={formData.message}
                                    onChange={(e) => setFormData({ ...formData, message: e.target.value })}
                                    className="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2C418F] focus:ring-2 focus:ring-[#2C418F]/20 transition-all outline-none bg-gray-50/50 resize-none"
                                ></textarea>
                            </div>
                            <button 
                                type="submit" 
                                disabled={isSubmitting}
                                className="w-full bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 disabled:opacity-70 text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2"
                            >
                                {isSubmitting ? (
                                    <>
                                        <svg className="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                        </svg>
                                        Sending...
                                    </>
                                ) : (
                                    <>
                                        Send Message
                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </>
                                )}
                            </button>
                        </form>
                    )}
                </div>
            </div>

            {/* Social Media Section */}
            <div className="text-center space-y-6 pt-4">
                <h2 className="gradient-text text-2xl md:text-3xl font-bold text-center">Follow Us On Social Media</h2>
                <p className="text-gray-600 max-w-lg mx-auto">
                    Stay updated with our latest news, features, and community events
                </p>
                <div className="flex justify-center gap-4">
                    {[FaTwitter, FaInstagram, FaLinkedin, FaYoutube].map((Icon, index) => (
                        <a
                            key={index}
                            href="#"
                            className="p-4 rounded-full border border-gray-200 hover:bg-[#2C418F] hover:text-white hover:border-[#2C418F] transition-all transform hover:scale-110"
                        >
                            <Icon size={20} />
                        </a>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default ContactUs;
