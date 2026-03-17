@extends('layouts.public')

@section('title', 'About Us - Hovertask')
@section('meta_description', 'Learn about Hovertask - the leading platform for earning money online through tasks, advertising, and reselling in Nigeria. Discover our mission, vision, and team.')
@section('meta_keywords', 'about hovertask, earn money online, Nigeria, mission, vision, team, social media tasks')

@section('content')
<!-- About Us Hero Section -->
<section class="hero p-4">
    <div class="space-y-6 p-4 text-center py-16">
        <h1 class="text-[55.62px] mb-4 gradient-text">About Us - Hovertask</h1>
        <p class="text-[33.37px]">Introduction</p>
    </div>
    <div class=" max-[1255px]:p-4">
        <div class="w-full max-w-[1223.5px] mx-auto bg-[#e9edfe] rounded-[44.5px] px-8 transform rotate-[-2deg] p-12 mb-36">
            <p class="text-xl font-light max-md:text-lg">
                Welcome to Hovertask, your trusted platform for earning and advertising! At Hovertask, we
                connect businesses with individuals who are ready to perform simple social media tasks,
                advertise products, and help brands grow. Our mission is to create opportunities for people
                to earn daily income while helping businesses reach a wider audience.
            </p>
        </div>
    </div>
    <div class="w-full flex max-md:flex-col justify-center gap-14 max-md:gap-0 items-center max-w-[1223.5px] mx-auto mb-36">
        <img
            src="/assets/Young african man having video call on laptop at home 1.png"
            alt="Video Call"
            class="w-[40%] max-md:w-full h-auto"
            loading="lazy"
        />
        <div class="flex flex-col justify-center gap-3 px-3">
            <h3 class="gradient-text text-6xl">Our Mission</h3>
            <p class="font-light text-[20px]">
                To empower individuals by providing them with easy, flexible ways to earn and to support
                businesses in achieving their marketing goals through innovative solutions.
            </p>
        </div>
    </div>
    <div class="w-full mb-18 space-y-18  max-w-[1223px] mx-auto max-[1255px]:p-4">
        <div class="max-w-[887.1px] w-full">
            <h3 class="gradient-text text-[41.26px]">Our Vision</h3>
            <div class="shadow-lg p-6 shadow-gray-200 bg-[#EEF0FF] rounded-3xl md:flex justify-center gap-14 items-center max-m px-2 text-[20px] font-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="#2C418F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-base max-md:text-lg max-md:float-left max-md:mr-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                <p class="text-light">
                    To become the leading platform for micro-jobs, advertising, and product reselling in the
                    digital space, empowering millions of users globally.
                </p>
            </div>
        </div>
        <div class="max-w-[887.1px] w-full float-right">
            <h3 class="gradient-text text-[41.26px]">Our Team</h3>
            <div class="shadow-lg p-6 shadow-gray-200 bg-[#00B3060D] rounded-3xl md:flex justify-center gap-14 items-center max-md:w-full px-2 text-[20px] font-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="#2C418F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-base max-md:text-lg max-md:float-left max-md:mr-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <p class="text-light">
                    Hovertask is powered by a team of dedicated professionals who are passionate about
                    creating opportunities for individuals and businesses.
                </p>
            </div>
        </div>
        <div class="clear-right"></div>
    </div>
</section>

<!-- Core Values Section -->
<div class="w-full flex flex-col bg-white items-center justify-center py-12 px-14 max-md:px-1">
    <div class="w-full flex items-center justify-center gap-5 max-lg:flex-col">
        <div class="lg:w-[40%] w-[90%]">
            <div class="lg:w-[60%] max-lg:justify-center bg-gradient-to-l from-[#DAE2FF]/10 to-[#DAE2FF] h-[7rem] flex justify-center items-center rounded-3xl transform rotate-[-2deg] ">
                <p class="text-4xl font-light bg-gradient-to-l from-[#2C418F] to-base text-transparent bg-clip-text">
                    Our Core <span class="text-black">Values</span>
                </p>
            </div>
            <img src="/assets/Rectangle 39338.png" alt="Core Values" class="rounded-xl" />
        </div>
        <div class="lg:w-[50%] max-md:w-full space-y-3 leading-8 text-[20px] max-md:p-4">
            <p class="md:flex items-start gap-4">
                <span class="text-base inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#2C418F"><circle cx="12" cy="12" r="10"/></svg> Transparency:
                </span> 
                We ensure honesty and clarity in all transactions.
            </p>
            <p class="md:flex items-start gap-4">
                <span class="text-base inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#2C418F"><circle cx="12" cy="12" r="10"/></svg> Innovation:
                </span> 
                We continuously improve to serve you better.
            </p>
            <p class="md:flex items-start gap-4">
                <span class="text-base inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#2C418F"><circle cx="12" cy="12" r="10"/></svg> Empowerment:
                </span> 
                We aim to uplift individuals and businesses alike.
            </p>
            <p class="md:flex items-start gap-4">
                <span class="text-base inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#2C418F"><circle cx="12" cy="12" r="10"/></svg> Community:
                </span> 
                We are building a network where everyone can thrive together.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="/signup" class="px-6 py-2 bg-base text-white rounded-3xl shadow-md hover:bg-[#2C418F] transition">
                    Create Account
                </a>
                <a href="/signin" class="px-6 py-2 border border-base text-base rounded-3xl shadow-md hover:bg-base hover:text-white transition">
                    Login your Account
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
