import listImage from "../../../assets/Ellipse 1564.svg";

const EarnByHelpingSection = () => {
    return (
        <section className="max-w-screen-lg mx-auto flex max-lg:flex-col items-center justify-center px-4 pb-32">
            <div className="container max-w-lg ">
                <h2 className="text-4xl mb-4 gradient-text">Earn money by helping other people grow</h2>
                <p className="text-[20px] mb-12">
                    Get paid by helping people grow, no investment or signup fee required.
                </p>
                <ul className="list-inside mb-6 text-[20px] space-y-2">
                    <li className="flex items-center gap-4">
                        <img src={listImage} alt="." /> Over 1000 daily tasks
                    </li>
                    <li className="flex items-center gap-4">
                        <img src={listImage} alt="." /> Instant withdrawals
                    </li>
                    <li className="flex items-center gap-4">
                        <img src={listImage} alt="." /> No investment or signup fee required
                    </li>
                </ul>
                <button className="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-3xl">Create Account</button>
            </div>
            <div className="lg:block w-1/2 relative">
                <img
                    src="/assets/images/hand-holding-phone.png"
                    alt="Phone with Social Media Icons"
                    className="w-full object-cover h-full max-w-sm"
                />
                <div className="absolute h-24 w-full -bottom-4 bg-gradient-to-b from-white/10 via-white to-white blur-sm"></div>
            </div>
        </section>
    );
};

export default EarnByHelpingSection;
