import { useState } from "react";
import { BiMinus, BiPlus } from "react-icons/bi";

const faqData = [
    {
        question: "What is Hovertask?",
        answer: "Hovertask is a comprehensive online marketplace platform that enables users to earn through various channels. You can buy and sell products, complete social media tasks, participate in marketing campaigns, and earn commissions through our reseller program. Our platform is designed to create opportunities for both individuals and businesses to grow their online presence and income."
    },
    {
        question: "How do I start earning on Hovertask?",
        answer: "Getting started on Hovertask is simple: 1) Create your account and complete your profile, 2) Choose your preferred earning method (tasks, selling, or reselling), 3) Complete the necessary verifications, 4) Start engaging with available opportunities. For task completion, browse available tasks and follow instructions. For selling, list your products with detailed descriptions. For reselling, select products from our marketplace to promote."
    },
    {
        question: "What are the payment methods available?",
        answer: "Hovertask supports multiple payment methods including bank transfers, digital wallets, and cryptocurrency. Payments are processed securely and typically released within 24-72 hours after task completion or successful sale. We maintain a minimum payout threshold of $10 for most payment methods."
    },
    {
        question: "Is KYC verification mandatory?",
        answer: "Yes, KYC (Know Your Customer) verification is mandatory for sellers and resellers to ensure platform security and prevent fraud. The verification process is quick and requires basic identification documents. Regular task performers may not need KYC unless their earnings exceed certain thresholds."
    },
    {
        question: "What types of tasks can I complete?",
        answer: "Hovertask offers various task categories including social media engagement (likes, follows, shares), content creation, survey completion, app testing, and more. Task availability varies by region and your profile status. Higher-paying tasks become available as you build a positive completion history."
    },
    {
        question: "How does the reseller program work?",
        answer: "Our reseller program allows you to earn commissions by promoting and selling products from our marketplace. You can: 1) Select products from verified sellers, 2) Set your markup within platform guidelines, 3) Promote through your channels, 4) Earn commission on successful sales. We provide marketing materials and analytics to help optimize your sales."
    },
    {
        question: "What support does Hovertask provide?",
        answer: "We offer comprehensive support through multiple channels: 24/7 chat support, email assistance (support@hovertask.com), detailed FAQ section, video tutorials, and a community forum. Premium sellers and high-volume resellers get access to dedicated account managers."
    },
    {
        question: "How are disputes handled?",
        answer: "Hovertask has a structured dispute resolution process: 1) Submit a detailed dispute ticket, 2) Provide relevant evidence, 3) Our team reviews within 48 hours, 4) Both parties can present their case, 5) Resolution is provided based on platform policies and evidence. We maintain an escrow system to protect both buyers and sellers."
    }
];

const SectionHeader = ({ title }: { title: string }) => (
    <div className="relative">
        <h2 className="text-4xl font-light bg-gradient-to-l from-[#2C418F] to-base text-transparent bg-clip-text">
            {title}
        </h2>
    </div>
);

const FaqItem = ({ question, answer }: { question: string; answer: string }) => {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <div className=" border-[#737373] border-b   transition-all duration-200">
            <button
                className={`w-full p-5 flex items-start gap-4 text-left transition-colors duration-200 ${
                    isOpen ? "" : ""
                }`}
                onClick={() => setIsOpen(!isOpen)}
            >
                <span className="mt-1">
                    {isOpen ? (
                        <BiMinus className="w-5 h-5 text-blue-600" />
                    ) : (
                        <BiPlus className="w-5 h-5 text-blue-500" />
                    )}
                </span>
                <div className="flex-1">
                    <h3 className={`text-lg font-medium ${isOpen ? "text-blue-600" : "text-gray-800"}`}>{question}</h3>
                    {isOpen && (
                        <p className="mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-base">
                            {answer}
                        </p>
                    )}
                </div>
            </button>
        </div>
    );
};

const Faq = () => {
    return (
        <div className="hero w-full h-auto mx-auto py-16 px-6">
            <div className="text-center space-y-8 mb-12">
                <SectionHeader title="Frequently Asked Questions" />
                <p className="text-gray-600 mt-8 max-w-2xl mx-auto">
                    Need help? Check out our most commonly asked questions below. If you can't find what you're looking
                    for, reach out to our support team at{" "}
                    <a href="mailto:support@hovertask.com" className="text-blue-600 hover:text-blue-700 font-medium">
                        support@hovertask.com
                    </a>
                </p>
            </div>

            <div className=" py-12">
                <div className="max-w-4xl mx-auto px-6">
                    <div className="space-y-4">
                        {faqData.map((item, index) => (
                            <FaqItem key={index} question={item.question} answer={item.answer} />
                        ))}
                    </div>
                </div>
            </div>

            {/* <div className="mt-12 text-center bg-blue-50 rounded-xl p-8">
        <h3 className="text-xl font-semibold text-gray-800 mb-3">
          Still have questions?
        </h3>
        <p className="text-gray-600 mb-6">
          Our support team is here to help you 24/7
        </p>
        <button className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200 shadow-lg shadow-blue-600/20">
          Contact Support
        </button>
      </div> */}
        </div>
    );
};

export default Faq;
