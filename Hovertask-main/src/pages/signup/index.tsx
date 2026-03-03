import { useRef, useState } from "react";
import type { FieldValues } from "react-hook-form";
import { Link } from "react-router-dom";
import logo from "../../assets/brand-logo.svg";
import confetti from "../../assets/confetti.gif";
import EarnsphereAccountForm from "./components/EarnsphereAccountForm";
import PersonalInfoForm from "./components/PersonalInfoForm";
import EmailVerificationForm from "./components/EmailVerificationForm";
import useSlider from "./hooks/useSlider";
import signup from "./utils/signup";

const slides = [
	{
		image: "/assets/images/newgilr.jpeg",
		title: "Unlock Your Earning Potential",
		description:
			"Discover endless opportunities to earn, advertise, and resell products.",
	},
	{
		image: "/assets/images/frackels.webp",
		title: "Boost your brand visibility",
		description:
			"Advertise on our marketplace or levergae social media to grow your business.",
	},
	{
		image: "/assets/images/newgilr.jpeg",
		title: "Turn Product to profit ",
		description:
			"Access a widea way of products to resell and earn commissions.",
	},
];

const Signup = () => {
	const currentSlide = useSlider(slides.length);
	const [currentForm, setCurrentForm] = useState<
		"personal" | "earnsphere" | "verification"
	>("personal");
	const [aggregateForm, setAggregateForm] = useState<FieldValues>({});
	const multiStepForm = useRef<HTMLDivElement>(null);
	const [verificationSuccess, setVerificationSuccess] = useState(false);

	// Remove scroll logic since only one form is rendered at a time

	return (
		<div className="min-h-screen bg-gradient-to-br from-blue-50 to-white p-4 flex items-center justify-center">
			<div className="bg-white rounded-2xl shadow-xl p-8 w-full max-w-5xl flex flex-col md:flex-row gap-8">
				{/* Left Section - Carousel */}
				<div className="w-full md:w-1/2">
					<div className="relative h-[500px] rounded-2xl overflow-hidden">
						{/* Images Container */}
						<div
							className="absolute w-full h-full transition-transform duration-700 ease-in-out"
							style={{ transform: `translateX(-${currentSlide * 100}%)` }}
						>
							<div className="absolute w-full h-full flex">
								{slides.map((slide, index) => (
									<div
										key={index}
										className="min-w-full h-full relative transform hover:rotate-0 transition-transform duration-300 overflow-hidden"
									>
										<img
											src={slide.image}
											alt={slide.title}
											className="w-full h-full object-cover"
										/>
										<div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
											<div
												className="absolute bottom-16 p-6 text-white transition-opacity duration-500"
												style={{ opacity: currentSlide === index ? 1 : 0 }}
											>
												<h2 className="text-2xl font-bold mb-2">
													{slide.title}
												</h2>
												<p className="text-gray-200">{slide.description}</p>
											</div>
										</div>
									</div>
								))}
							</div>
						</div>

						{/* Indicators */}
						<div className="absolute bottom-6 left-6 flex items-center gap-2 transition-transform duration-700">
							{slides.map((img, index) => (
								<button
									type="button"
									key={img.title}
									className={`w-2 h-2 rounded-full transition-all duration-300 ${
										currentSlide === index
											? "scale-150 bg-blue-500"
											: "bg-white/50 hover:bg-white/75"
									}`}
								/>
							))}
						</div>
					</div>
				</div>

				{/* Right Section - Form */}
				<div className="w-full md:w-1/2 flex flex-col">
					<div className="pb-6 mb-6">
						<img src={logo} alt="Hovertask Logo" className="h-8" />
					</div>

					<div className="h-0.5 bg-slate-300 mb-6">
						<div
							style={{
								marginLeft: currentForm === "personal" ? 0 : "50%",
							}}
							className="w-1/2 h-full bg-blue-600 transition-all"
						/>
					</div>

					{/* Multi-step form - only render current step */}
					<div ref={multiStepForm} className="w-full">
						{currentForm === "personal" && (
							<PersonalInfoForm
								onSubmit={(form: FieldValues) => {
									setCurrentForm("earnsphere");
									setAggregateForm({ ...aggregateForm, ...form });
								}}
							/>
						)}
						{currentForm === "earnsphere" && (
							<EarnsphereAccountForm
								onSubmit={async (form: FieldValues) => {
									await signup({ ...aggregateForm, ...form }, () =>
										setCurrentForm("verification")
									);
								}}
								onBackBtnPress={() => setCurrentForm("personal")}
							/>
						)}
						{currentForm === "verification" && (
							<EmailVerificationForm
								email={aggregateForm.email}
								onSubmit={async () => {
									setVerificationSuccess(true);
								}}
							/>
						)}
					</div>

					{/* Success modal after verification */}
					{verificationSuccess && (
						<div className="fixed inset-0 bg-black/30 backdrop-blur-sm z-999 flex flex-col items-center justify-center">
							<div className="w-full max-w-lg rounded-2xl bg-white shadow-lg p-6 flex flex-col justify-center items-center text-center relative">
								<img src={confetti} alt="Confetti" />
								<div>
									<h4 className="font-semibold text-2xl">Congratulations</h4>
									<p className="text-zinc-600 font-light">
										Your email has been verified and your Hovertask account is ready!
									</p>
									<Link
										className="w-fit bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg block mx-auto cursor-pointer font-medium transition-colors duration-200 shadow-lg shadow-blue-600/20 mt-6"
										to="/signin"
									>
										Continue
									</Link>
								</div>
							</div>
						</div>
					)}

					<p className="text-center text-gray-600 mt-6">
						Already have an account?{" "}
						<Link
							to="/signin"
							className="text-blue-600 hover:text-blue-700 font-medium cursor-pointer"
						>
							Sign In
						</Link>
					</p>
				</div>
			</div>
		</div>
	);
};

export default Signup;
