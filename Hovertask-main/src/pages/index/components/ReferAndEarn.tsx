const ReferAndEarn = () => {
    return (
        <section className="space-y-8 mb-32">
            <div className=" max-w-[1100px] mx-auto max-md:p-4">
                <h2 className="text-[40px] gradient-text w-fit">Refer & Earn Money</h2>
            </div>
            <div className="bg-gradient-to-b from-[#DAE2FF00] to-[#DAE2FF] rounded-2xl md:rounded-full flex flex-col items-center p-10">
                <div className="flex items-center max-md:flex-col">
                    <p className="text-2xl max-w-sm">
                        Share your referral link with friends and get rewarded. Earn{" "}
                        <span className="font-semibold text-blue-600">₦500</span> rewards for every new member who joins
                        the platform.
                    </p>
                    <div className="relative">
                        <img
                            src="/assets/images/closeup-shot-two-pretty-afro-american-girls-using-their-phones-while-holding-shopping-bags.png"
                            alt="Refer & Earn"
                            className="w-full max-w-md object-cover"
                        />
                        <div className="absolute top-2 right-0 bg-white px-4 py-2 rounded-lg shadow-md text-blue-600 font-semibold">
                            ₦10,000 <br />
                            Expected Future Deposit
                        </div>
                    </div>
                </div>
                {/* Title */}
                <div className="bg-blue-500 text-white text-center p-6 text-2xl rounded-2xl max-w-[1061px] md:rounded-full">
                    Bring new members and earn when they deposit and when they work. Passive income for life! <br />{" "}
                    Yes, it's that easy!
                </div>
            </div>
        </section>
    );
};

export default ReferAndEarn;
