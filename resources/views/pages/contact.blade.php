@extends('layouts.public')

@section('title', 'Contact Us - Hovertask')
@section('meta_description', 'Get in touch with Hovertask. We are here to help with any questions about earning, advertising, or our platform. Contact us via email or WhatsApp.')
@section('meta_keywords', 'contact hovertask, support, help, email, whatsapp, customer service')

@section('content')
<!-- Contact Us Header -->
<div class="w-full h-auto flex flex-col items-center">
    <h2 class="gradient-text text-[53.92px] text-center pt-14">Contact Us</h2>
    <div class="relative w-full max-w-4xl h-[20rem] rounded-2xl overflow-hidden transform rotate-[-2deg] mb-10 px-2">
        <img
            src="/assets/Group 1000004576.png"
            alt="Contact Us"
            class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-opacity-50 flex items-center justify-center">
            <p class="text-white text-center px-6 text-lg">
                We'd love to hear from you! Whether you have questions, feedback, or need assistance, feel free
                to reach out to us through any of the channels below
            </p>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="w-full max-w-6xl px-4 space-y-10">
        <!-- Section Title -->
        <div class="text-center">
            <h2 class="gradient-text text-[53.92px] text-center pt-14">Get In Touch</h2>
        </div>

        <!-- Contact Container -->
        <div class="flex max-md:flex-col gap-8 bg-white shadow-xl rounded-2xl overflow-hidden">
            <!-- Left Section - Contact Info -->
            <div class="w-1/2 max-md:w-full bg-[#F5F7FF] p-8 space-y-6">
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2C418F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-base w-6 h-6"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <div>
                            <p class="font-semibold text-base">Email</p>
                            <p>hovertask@gmail.com</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <img src="/assets/whatsapp-removebg-preview.png" alt="WhatsApp" class="w-8 h-8 object-contain" />
                        <div>
                            <p class="font-semibold text-base">Forum</p>
                            <a href="https://chat.whatsapp.com/FQ9p0JMv6BY2wtevK2htVu" class="text-blue-500 hover:underline">
                                Join our Forum
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section - Contact Form -->
            <div class="w-1/2 max-md:w-full p-8">
                <form class="space-y-4">
                    <input type="text" placeholder="First Name" class="w-full p-3 rounded-md bg-[#F4F4FA] border border-gray-200 focus:outline-[#2C418F]" />
                    <input type="email" placeholder="Email Address" class="w-full p-3 rounded-md bg-[#F4F4FA] border border-gray-200 focus:outline-[#2C418F]" />
                    <textarea placeholder="Your Message" class="w-full p-3 rounded-md h-24 bg-[#F4F4FA] border border-gray-200 focus:outline-[#2C418F]"></textarea>
                    <button type="button" class="w-full bg-base text-white p-3 rounded-md hover:bg-[#2C418F] transition">
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="text-center space-y-6">
            <h2 class="gradient-text text-[53.92px] text-center pt-14">Follow Us On Social Media</h2>
            <div class="flex justify-center space-x-4 text-base">
                <a href="https://www.youtube.com/@Hovertaskng" target="_blank" class="p-3 rounded-full border border-base hover:bg-base hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="https://x.com/hovertaskng" target="_blank" class="p-3 rounded-full border border-base hover:bg-base hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://www.instagram.com/hovertaskng/" target="_blank" class="p-3 rounded-full border border-base hover:bg-base hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <a href="https://www.linkedin.com/company/hovertask-ng" target="_blank" class="p-3 rounded-full border border-base hover:bg-base hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
