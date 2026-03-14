import { useState } from "react";
import { Link } from "react-router-dom";
import { BiMinus, BiPlus } from "react-icons/bi";

const faqData = [
    {
        question: "What is HoverTask?",
        answer: "HoverTask is a comprehensive online marketplace platform that enables users to earn through various channels. You can buy and sell products, complete social media tasks, participate in marketing campaigns, and earn commissions through our reseller program. Our platform is designed to create opportunities for both individuals and businesses to grow their online presence and income."
    },
    {
        question: "How do I start earning on HoverTask?",
        answer: "Getting started on HoverTask is simple: 1) Create your account and complete your profile, 2) Choose your preferred earning method (tasks, selling, or reselling), 3) Complete the necessary verifications, 4) Start engaging with available opportunities. For task completion, browse available tasks and follow instructions. For selling, list your products with detailed descriptions. For reselling, select products from our marketplace to promote."
    },
    {
        question: "What are the payment methods available?",
        answer: "HoverTask supports multiple payment methods including bank transfers, digital wallets, and cryptocurrency. Payments are processed securely and typically released within 24-72 hours after task completion or successful sale. We maintain a minimum payout threshold of $10 for most payment methods."
    },
    {
        question: "Is KYC verification mandatory?",
        answer: "Yes, KYC (Know Your Customer) verification is mandatory for sellers and resellers to ensure platform security and prevent fraud. The verification process is quick and requires basic identification documents. Regular task performers may not need KYC unless their earnings exceed certain thresholds."
    },
    {
        question: "What types of tasks can I complete?",
        answer: "HoverTask offers various task categories including social media engagement (likes, follows, shares), content creation, survey completion, app testing, and more. Task availability varies by region and your profile status. Higher-paying tasks become available as you build a positive completion history."
    },
    {
        question: "How does the reseller program work?",
        answer: "Our reseller program allows you to earn commissions by promoting and selling products from our marketplace. You can: 1) Select products from verified sellers, 2) Set your markup within platform guidelines, 3) Promote through your channels, 4) Earn commission on successful sales. We provide marketing materials and analytics to help optimize your sales."
    },
    {
        question: "What support does HoverTask provide?",
        answer: "We offer comprehensive support through multiple channels: 24/7 chat support, email assistance (support@hovertask.com), detailed FAQ section, video tutorials, and a community forum. Premium sellers and high-volume resellers get access to dedicated account managers."
    },
    {
        question: "How are disputes handled?",
        answer: "HoverTask has a structured dispute resolution process: 1) Submit a detailed dispute ticket, 2) Provide relevant evidence, 3) Our team reviews within 48 hours, 4) Both parties can present their case, 5) Resolution is provided based on platform policies and evidence. We maintain an escrow system to protect both buyers and sellers."
    }
];

const SectionHeader = ({ title }: { title: string }) => (
    <div className="relative">
        <h2 className="text-3xl md:text-4xl font-bold bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 text-transparent bg-clip-text">
            {title}
        </h2>
    </div>
);

const FaqItem = ({ question, answer, index }: { question: string; answer: string; index: number }) => {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <div className="border border-gray-200 dark:border-slate-700 rounded-xl overflow-hidden transition-all duration-200 hover:shadow-md dark:hover:shadow-lg">
            <button
                className={`w-full p-5 flex items-start gap-4 text-left transition-colors duration-200 ${isOpen ? 'bg-gray-50 dark:bg-slate-800' : 'bg-white dark:bg-slate-900'}`}
                onClick={() => setIsOpen(!isOpen)}
                aria-expanded={isOpen}
                aria-controls={`faq-answer-${index}`}
            >
                <span className="mt-0.5 flex-shrink-0">
                    {isOpen ? (
                        <BiMinus className="w-5 h-5 text-[#2C418F] dark:text-indigo-400" />
                    ) : (
                        <BiPlus className="w-5 h-5 text-gray-400" />
                    )}
                </span>
                <div className="flex-1">
                    <h3 className={`text-base md:text-lg font-semibold ${isOpen ? "text-[#2C418F] dark:text-indigo-400" : "text-gray-800 dark:text-white"}`}>
                        {question}
                    </h3>
                    <div 
                        id={`faq-answer-${index}`}
                        className={`overflow-hidden transition-all duration-300 ${isOpen ? 'max-h-96 mt-3' : 'max-h-0'}`}
                    >
                        <p className="text-gray-600 dark:text-slate-300 leading-relaxed pb-2">
                            {answer}
                        </p>
                    </div>
                </div>
            </button>
        </div>
    );
};

const Faq = () => {
    return (
        <section className="bg-gradient-to-b from-gray-50 via-white to-gray-50 dark:from-slate-900 dark:via-slate-800/50 dark:to-slate-900 w-full h-auto mx-auto py-16 md:py-24 px-4 relative overflow-hidden" id="faq">
            {/* Background decorations */}
            <div className="absolute inset-0 pointer-events-none">
                <div className="absolute top-20 left-10 w-72 h-72 bg-[#2C418F]/3 dark:bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div className="absolute bottom-20 right-10 w-96 h-96 bg-blue-400/3 dark:bg-purple-500/10 rounded-full blur-3xl"></div>
            </div>
            <div className="relative z-10">
            <div className="text-center space-y-4 mb-12">
                <SectionHeader title="Frequently Asked Questions" />
                <p className="text-gray-600 dark:text-slate-300 mt-4 max-w-2xl mx-auto text-lg">
                    Need help? Check out our most commonly asked questions below. Can't find what you're looking for?{" "}
                    <Link to="/contact" className="text-[#2C418F] dark:text-indigo-400 hover:text-blue-700 dark:hover:text-indigo-300 font-semibold transition-colors">
                        Contact our support team
                    </Link>
                </p>
            </div>

            <div className="py-8">
                <div className="max-w-3xl mx-auto">
                    <div className="space-y-4">
                        {faqData.map((item, index) => (
                            <FaqItem key={index} question={item.question} answer={item.answer} index={index} />
                        ))}
                    </div>
                </div>
            </div>

            <div className="mt-12 text-center bg-gradient-to-r from-[#2C418F]/5 to-blue-50 dark:from-indigo-900/20 dark:to-slate-800 rounded-2xl p-8 max-w-2xl mx-auto">
                <h3 className="text-xl font-bold text-gray-800 dark:text-white mb-3">
                    Still have questions?
                </h3>
                <p className="text-gray-600 dark:text-slate-300 mb-6">
                    Our support team is here to help you 24/7
                </p>
                <Link 
                    to="/contact" 
                    className="inline-flex items-center gap-2 bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 dark:from-indigo-600 dark:to-purple-600 dark:hover:from-indigo-500 dark:hover:to-purple-500 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5"
                >
                    Contact Support
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </Link>
            </div>
            </div>
        </section>
    );
};

export default Faq;
