import { useRef, useState } from "react";
import type { FieldValues } from "react-hook-form";
import { Link } from "react-router-dom";
import { Helmet } from "react-helmet-async";
import confetti from "../../assets/confetti.gif";
import { FaGoogle } from "react-icons/fa";
import EarnsphereAccountForm from "./components/EarnsphereAccountForm";
import PersonalInfoForm from "./components/PersonalInfoForm";
import EmailVerificationForm from "./components/EmailVerificationForm";
import signup from "./utils/signup";

const Signup = () => {
	const [currentForm, setCurrentForm] = useState<"personal" | "earnsphere" | "verification">("personal");
	const [aggregateForm, setAggregateForm] = useState<FieldValues>({});
	const multiStepForm = useRef<HTMLDivElement>(null);
	const [verificationSuccess, setVerificationSuccess] = useState(false);

	const getStepNumber = () => {
		if (currentForm === "personal") return 1;
		if (currentForm === "earnsphere") return 2;
		return 3;
	};

	return (
		<>
			<Helmet>
				<title>Sign Up - HoverTask | Join 500k+ Members</title>
				<meta name="description" content="Create your free HoverTask account and start earning money through social media tasks, advertising your business, or becoming a reseller. Join 500k+ members today!" />
				<meta name="keywords" content="sign up, register, create account, hovertask, earn money online, social media tasks, reseller" />
				<meta property="og:title" content="Sign Up - HoverTask | Join 500k+ Members" />
				<meta property="og:description" content="Create your free account and start earning. Join Nigeria's fastest-growing earning platform with 500k+ members." />
				<meta property="og:url" content="https://hovertask.com/signup" />
				<link rel="canonical" href="https://hovertask.com/signup" />
			</Helmet>
			<div className="min-h-screen bg-gradient-to-br from-[#2C418F]/5 via-blue-50 to-white dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 flex items-center justify-center">
				<div className="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-6 md:p-8 w-full max-w-md dark:shadow-2xl dark:shadow-indigo-500/10">
					{/* Progress Steps */}
					<div className="flex items-center gap-2 mb-6">
						{[1, 2, 3].map((step) => (
							<>
								<div 
									key={step}
									className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-all ${
										getStepNumber() >= step 
											? "bg-gradient-to-r from-[#2C418F] to-blue-600 text-white" 
											: "bg-gray-200 dark:bg-slate-700 text-gray-500 dark:text-slate-400"
									}`}
								>
									{getStepNumber() > step ? (
										<svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
											<path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
										</svg>
									) : step}
								</div>
								{step < 3 && (
									<div className={`flex-1 h-0.5 ${getStepNumber() > step ? "bg-[#2C418F]" : "bg-gray-200 dark:bg-slate-700"}`} />
								)}
							</>
						))}
					</div>

					{/* Multi-step form - only render current step */}
					<div ref={multiStepForm} className="w-full">
						{/* Google Sign Up Button - at top */}
						<button
							type="button"
							className="w-full flex items-center justify-center gap-3 bg-white dark:bg-slate-700 border-2 border-gray-200 dark:border-slate-600 hover:border-gray-300 dark:hover:border-slate-500 hover:bg-gray-50 dark:hover:bg-slate-600 text-gray-700 dark:text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-sm hover:shadow-md mb-5"
							onClick={() => {
								console.log("Google sign-up clicked");
							}}
						>
							<FaGoogle className="text-lg" />
							Sign up with Google
						</button>

						{/* Divider */}
						<div className="relative mb-5">
							<div className="absolute inset-0 flex items-center">
								<div className="w-full border-t border-gray-200 dark:border-slate-600"></div>
							</div>
							<div className="relative flex justify-center text-sm">
								<span className="px-4 bg-white dark:bg-slate-800 text-gray-500 dark:text-slate-400">Or continue with</span>
							</div>
						</div>

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
						<div className="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex flex-col items-center justify-center">
							<div className="w-full max-w-lg rounded-2xl bg-white dark:bg-slate-800 shadow-2xl p-8 flex flex-col justify-center items-center text-center relative dark:shadow-indigo-500/20">
								<img src={confetti} alt="Confetti" className="mb-4" />
								<h4 className="font-bold text-2xl text-gray-800 dark:text-white mb-2">Congratulations!</h4>
								<p className="text-gray-600 dark:text-slate-400 mb-6">
									Your email has been verified and your HoverTask account is ready!
								</p>
								<Link
									to="/signin"
									className="inline-flex items-center gap-2 bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-3 px-8 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5"
								>
									Continue to Login
									<svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
									</svg>
								</Link>
							</div>
						</div>
					)}

					<p className="text-center text-gray-600 dark:text-slate-400 mt-6">
						Already have an account?{" "}
						<Link to="/signin" className="text-[#2C418F] hover:text-blue-700 font-semibold">
							Sign In
						</Link>
					</p>
				</div>
			</div>
		</>
	);
};

export default Signup;
