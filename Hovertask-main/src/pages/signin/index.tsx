import { useForm } from "react-hook-form";
import { useState } from "react";
import { Link } from "react-router-dom";
import { Helmet } from "react-helmet-async";
import Input from "../../components/Input";
import signin from "./utils/signin";
import RecoverPasswordModal from "../../components/RecoverPasswordModal";
import { FaGoogle } from "react-icons/fa";

const SignIn = () => {
	const {
		register,
		handleSubmit,
		formState: { errors, isSubmitting },
	} = useForm({ mode: "all" });

	const [modalOpen, setModalOpen] = useState(false);

	return (
		<>
			<Helmet>
				<title>Sign In - HoverTask | Earn Money Online</title>
				<meta name="description" content="Sign in to your HoverTask account to continue earning money through social media tasks, advertising your business, or managing your reseller store." />
				<meta name="keywords" content="sign in, login, hovertask account, earn money online, social media tasks" />
				<meta property="og:title" content="Sign In - HoverTask | Earn Money Online" />
				<meta property="og:description" content="Sign in to continue earning, advertising, and growing your business on Nigeria's leading earning platform." />
				<meta property="og:url" content="https://hovertask.com/signin" />
				<link rel="canonical" href="https://hovertask.com/signin" />
			</Helmet>
			<div className="min-h-screen bg-gradient-to-br from-[#2C418F]/5 via-blue-50 to-white dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 p-4 flex items-center justify-center">
				<div className="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-6 md:p-8 w-full max-w-md dark:shadow-2xl dark:shadow-indigo-500/10">
					<div className="mb-8 text-center">
						<h2 className="text-2xl font-bold text-gray-800 dark:text-white">Sign In</h2>
						<p className="text-gray-600 dark:text-slate-400 mt-2">
							Enter your credentials to access your account
						</p>
					</div>

					{/* Google Sign In Button */}
					<button
						type="button"
						className="w-full flex items-center justify-center gap-3 bg-white dark:bg-slate-700 border-2 border-gray-200 dark:border-slate-600 hover:border-gray-300 dark:hover:border-slate-500 hover:bg-gray-50 dark:hover:bg-slate-600 text-gray-700 dark:text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-sm hover:shadow-md mb-6"
						onClick={() => {
							console.log("Google sign-in clicked");
						}}
					>
						<FaGoogle className="text-lg" />
						Sign in with Google
					</button>

					{/* Divider */}
					<div className="relative my-5">
						<div className="absolute inset-0 flex items-center">
							<div className="w-full border-t border-gray-200 dark:border-slate-600"></div>
						</div>
						<div className="relative flex justify-center text-sm">
							<span className="px-4 bg-white dark:bg-slate-800 text-gray-500 dark:text-slate-400">Or continue with</span>
						</div>
					</div>

					<form
						onSubmit={handleSubmit(async (form) => await signin(form))}
						className="space-y-5"
					>
						<div>
							<Input
								label="Email Address"
								id="email"
								type="email"
								placeholder="Enter your email"
								{...register("email", {
									required: { value: true, message: "Email is required" },
									pattern: {
										value: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
										message: "Please enter a valid email address",
									},
								})}
							/>
							{errors.email && (
								<p className="text-red-500 text-sm mt-1">
									{errors.email.message as string}
								</p>
							)}
						</div>

						<div>
							<Input
								label="Password"
								id="password"
								type="password"
								placeholder="Enter your password"
								{...register("password", {
									required: {
										value: true,
										message: "Password is required",
									},
									minLength: {
										value: 6,
										message: "Password must be at least 6 characters",
									},
								})}
							/>
							{errors.password && (
								<p className="text-red-500 text-sm mt-1">
									{errors.password.message as string}
								</p>
							)}
						</div>

						<div className="flex items-center justify-between">
							<label className="flex items-center gap-2 cursor-pointer">
								<input
									id="remember"
									type="checkbox"
									className="w-4 h-4 text-[#2C418F] rounded border-gray-300 focus:ring-[#2C418F]"
								/>
								<span className="text-sm text-gray-600 dark:text-slate-300">
									Remember me
								</span>
							</label>
							<button
								type="button"
								onClick={() => setModalOpen(true)}
								className="text-sm text-[#2C418F] hover:text-blue-700 font-medium cursor-pointer transition-colors"
							>
								Forgot Password?
							</button>
						</div>

						<button
							type="submit"
							disabled={isSubmitting}
							className="w-full bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 disabled:opacity-70 disabled:cursor-not-allowed text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-blue-600/20 hover:shadow-xl hover:-translate-y-0.5"
						>
							{isSubmitting ? (
								<span className="flex items-center justify-center gap-2">
									<svg className="animate-spin h-5 w-5" viewBox="0 0 24 24">
										<circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
										<path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
									</svg>
									Signing in...
								</span>
							) : (
								"Sign In"
							)}
						</button>
					</form>

					<p className="text-center text-gray-600 dark:text-slate-400 mt-8">
						Don't have an account?{" "}
						<Link
							to="/signup"
							className="text-[#2C418F] hover:text-blue-700 font-semibold transition-colors"
						>
							Create Account
						</Link>
					</p>
				</div>

				{/* Form submission progress indicator */}
				{isSubmitting && (
					<div className="fixed inset-0 bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm z-50 flex flex-col items-center justify-center">
						<div className="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-2xl flex flex-col items-center dark:shadow-indigo-500/20">
							<svg className="animate-spin h-10 w-10 text-[#2C418F] mb-4" viewBox="0 0 24 24">
								<circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
								<path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
							</svg>
							<p className="text-gray-700 dark:text-white font-medium">Authenticating...</p>
						</div>
					</div>
				)}
			</div>

			<RecoverPasswordModal
				isOpen={modalOpen}
				onClose={() => setModalOpen(false)}
			/>
		</>
	);
};

export default SignIn;
