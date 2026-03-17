@extends('layouts.public')

@section('title', 'FAQ - Hovertask')
@section('meta_description', 'Find answers to commonly asked questions about Hovertask. Learn how to earn money, advertise your business, and use our platform effectively.')
@section('meta_keywords', 'faq, frequently asked questions, hovertask help, earn money, advertising, support')

@section('content')
<div class="hero w-full h-auto mx-auto py-16 px-6">
    <div class="text-center space-y-8 mb-12">
        <div class="relative">
            <h2 class="text-4xl font-light bg-gradient-to-l from-[#2C418F] to-[#2C418F] text-transparent bg-clip-text">
                Frequently Asked Questions
            </h2>
        </div>
        <p class="text-gray-600 mt-8 max-w-2xl mx-auto">
            Need help? Check out our most commonly asked questions below. If you can't find what you're looking
            for, reach out to our support team at 
            <a href="mailto:support@hovertask.com" class="text-blue-600 hover:text-blue-700 font-medium">
                support@hovertask.com
            </a>
        </p>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6">
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(1)">
                        <span class="mt-1">
                            <svg id="icon-minus-1" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-1" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-1" class="text-lg font-medium text-gray-800">What is Hovertask?</h3>
                            <div id="answer-1" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                Hovertask is a comprehensive online marketplace platform that enables users to earn through various channels. You can buy and sell products, complete social media tasks, participate in marketing campaigns, and earn commissions through our reseller program. Our platform is designed to create opportunities for both individuals and businesses to grow their online presence and income.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(2)">
                        <span class="mt-1">
                            <svg id="icon-minus-2" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-2" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-2" class="text-lg font-medium text-gray-800">How do I start earning on Hovertask?</h3>
                            <div id="answer-2" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                Getting started on Hovertask is simple: 1) Create your account and complete your profile, 2) Choose your preferred earning method (tasks, selling, or reselling), 3) Complete the necessary verifications, 4) Start engaging with available opportunities. For task completion, browse available tasks and follow instructions. For selling, list your products with detailed descriptions. For reselling, select products from our marketplace to promote.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(3)">
                        <span class="mt-1">
                            <svg id="icon-minus-3" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-3" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-3" class="text-lg font-medium text-gray-800">What are the payment methods available?</h3>
                            <div id="answer-3" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                Hovertask supports multiple payment methods including bank transfers, digital wallets, and cryptocurrency. Payments are processed securely and typically released within 24-72 hours after task completion or successful sale. We maintain a minimum payout threshold of $10 for most payment methods.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(4)">
                        <span class="mt-1">
                            <svg id="icon-minus-4" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-4" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-4" class="text-lg font-medium text-gray-800">Is KYC verification mandatory?</h3>
                            <div id="answer-4" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                Yes, KYC (Know Your Customer) verification is mandatory for sellers and resellers to ensure platform security and prevent fraud. The verification process is quick and requires basic identification documents. Regular task performers may not need KYC unless their earnings exceed certain thresholds.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 5 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(5)">
                        <span class="mt-1">
                            <svg id="icon-minus-5" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-5" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-5" class="text-lg font-medium text-gray-800">What types of tasks can I complete?</h3>
                            <div id="answer-5" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                Hovertask offers various task categories including social media engagement (likes, follows, shares), content creation, survey completion, app testing, and more. Task availability varies by region and your profile status. Higher-paying tasks become available as you build a positive completion history.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 6 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(6)">
                        <span class="mt-1">
                            <svg id="icon-minus-6" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-6" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-6" class="text-lg font-medium text-gray-800">How does the reseller program work?</h3>
                            <div id="answer-6" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                Our reseller program allows you to earn commissions by promoting and selling products from our marketplace. You can: 1) Select products from verified sellers, 2) Set your markup within platform guidelines, 3) Promote through your channels, 4) Earn commission on successful sales. We provide marketing materials and analytics to help optimize your sales.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 7 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(7)">
                        <span class="mt-1">
                            <svg id="icon-minus-7" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-7" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-7" class="text-lg font-medium text-gray-800">What support does Hovertask provide?</h3>
                            <div id="answer-7" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                We offer comprehensive support through multiple channels: 24/7 chat support, email assistance (support@hovertask.com), detailed FAQ section, video tutorials, and a community forum. Premium sellers and high-volume resellers get access to dedicated account managers.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 8 -->
                <div class="border-b border-[#737373]">
                    <button class="w-full p-5 flex items-start gap-4 text-left" onclick="toggleFaq(8)">
                        <span class="mt-1">
                            <svg id="icon-minus-8" class="w-5 h-5 text-blue-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg id="icon-plus-8" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 id="question-8" class="text-lg font-medium text-gray-800">How are disputes handled?</h3>
                            <div id="answer-8" class="hidden mt-3 text-gray-600 bg-[#EAEFFF] leading-relaxed rounded-4xl py-3 px-5 border-l border-[#2C418F]">
                                Hovertask has a structured dispute resolution process: 1) Submit a detailed dispute ticket, 2) Provide relevant evidence, 3) Our team reviews within 48 hours, 4) Both parties can present their case, 5) Resolution is provided based on platform policies and evidence. We maintain an escrow system to protect both buyers and sellers.
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFaq(id) {
    const answer = document.getElementById('answer-' + id);
    const question = document.getElementById('question-' + id);
    const minusIcon = document.getElementById('icon-minus-' + id);
    const plusIcon = document.getElementById('icon-plus-' + id);
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        question.classList.add('text-blue-600');
        minusIcon.classList.remove('hidden');
        plusIcon.classList.add('hidden');
    } else {
        answer.classList.add('hidden');
        question.classList.remove('text-blue-600');
        minusIcon.classList.add('hidden');
        plusIcon.classList.remove('hidden');
    }
}
</script>
@endsection
