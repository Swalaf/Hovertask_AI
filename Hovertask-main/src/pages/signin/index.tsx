import { useForm } from "react-hook-form";
import { useState } from "react";
import { Link } from "react-router-dom";
import logo from "../../assets/brand-logo.svg";
import spinner from "../../assets/spinner.gif";
import Input from "../../components/Input";
import signin from "./utils/signin";
import RecoverPasswordModal from "../../components/RecoverPasswordModal";

const SignIn = () => {
	const {
		register,
		handleSubmit,
		formState: { errors, isSubmitting },
	} = useForm({ mode: "all" });

	const [modalOpen, setModalOpen] = useState(false);

	return (
		<div className="min-h-screen bg-gradient-to-br from-blue-50 to-white p-4 flex items-center justify-center">
			<div className="bg-white rounded-2xl shadow-xl p-8 w-full max-w-5xl flex flex-col md:flex-row gap-8">
				{/* Left Section */}
				<div className="w-full md:w-1/2">
					<div className="relative h-[500px] rounded-2xl overflow-hidden transform hover:rotate-0 transition-transform duration-300 rotate-[-2deg]">
						<img
							src="/assets/images/newgilr.jpeg"
							alt="Welcome Back"
							className="w-full h-full object-cover"
						/>
						<div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
							<div className="absolute bottom-0 p-6 text-white">
								<h2 className="text-2xl font-bold mb-2">Welcome Back</h2>
								<p className="text-gray-200">
									Sign in to continue your journey with us
								</p>
							</div>
						</div>
					</div>
				</div>

				{/* Right Section */}
				<div className="w-full md:w-1/2 flex flex-col">
					<div className="pb-6 mb-6 border-b border-gray-200">
						<img src={logo} alt="Hovertask Logo" className="h-8" />
					</div>

					<div className="mb-8">
						<h2 className="text-2xl font-bold text-gray-800">Welcome Back</h2>
						<p className="text-gray-600 mt-2">
							Sign in to your Hovertask account
						</p>
					</div>

					<form
						onSubmit={handleSubmit(async (form) => await signin(form))}
						className="space-y-6"
					>
						<div>
							<Input
								label="Email Address"
								id="email"
								type="email"
								{...register("email", {
									required: { value: true, message: "Please enter your email" },
									pattern: {
										value: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
										message: "Enter a valid email address",
									},
								})}
							/>
							<small className="text-red-500">
								{errors.email && (errors.email.message as string)}
							</small>
						</div>

						<div>
							<Input
								label="Password"
								id="password"
								type="password"
								{...register("password", {
									required: {
										value: true,
										message: "Please enter your password",
									},
									pattern: {
										value: /^[^\s]*$/,
										message: "No empty spaces in password",
									},
								})}
							/>
							<small className="text-red-500">
								{errors.password && (errors.password.message as string)}
							</small>
						</div>

						<div className="flex items-center justify-between">
							<div className="flex items-center gap-2">
								<input
									id="remember"
									type="checkbox"
									className="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
								/>
								<label htmlFor="remember" className="text-sm text-gray-600">
									Remember me
								</label>
							</div>
							<button
								type="button"
								onClick={() => setModalOpen(true)}
								className="text-sm text-blue-600 hover:text-blue-700 bg-none border-none p-0 underline cursor-pointer"
								style={{ background: "none" }}
							>
								Forgot Password?
							</button>
						</div>

						<button
							type="submit"
							className="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors duration-200 shadow-lg shadow-blue-600/20"
						>
							Sign In
						</button>
					</form>

					<p className="text-center text-gray-600 mt-6">
						Don't have an account?{" "}
						<Link
							to="/signup"
							className="text-blue-600 hover:text-blue-700 font-medium"
						>
							Create Account
						</Link>
					</p>
				</div>

				{/* Form submission progress indicator */}
				{isSubmitting && (
					<div className="fixed inset-0 bg-white/30 backdrop-blur-sm z-999 flex flex-col items-center justify-center">
						<img src={spinner} alt="Spinner" />
						<p className="text-2xl">Login To Your Account</p>
					</div>
				)}
			</div>

			<RecoverPasswordModal
				isOpen={modalOpen}
				onClose={() => setModalOpen(false)}
			/>
		</div>
	);
};

export default SignIn;
