import { useForm } from "react-hook-form";
import { useEffect } from "react";
import { useLocation, Link } from "react-router-dom";
import Input from "../../../components/Input";

const PersonalInfoForm = ({
	onSubmit,
}: { onSubmit(...props: unknown[]): unknown }) => {
	const {
		register,
		handleSubmit,
		setValue,
		formState: { errors },
	} = useForm({ mode: "all" });

	const location = useLocation();

	useEffect(() => {
		const params = new URLSearchParams(location.search);
		const referralCode = params.get("ref");
		if (referralCode) {
			setValue("referral_code", referralCode);
		}
	}, [location.search, setValue]);

	return (
		<div className="w-full">
			<div className="mb-6">
				<h2 className="text-xl md:text-2xl font-bold text-gray-800 dark:text-white">
					Create Your Account
				</h2>
				<p className="text-gray-600 dark:text-slate-400 mt-1 text-sm">
					Join thousands earning and advertising on HoverTask
				</p>
			</div>

			<form
				onSubmit={handleSubmit((form) => onSubmit(form))}
				className="space-y-5"
			>
				<div className="grid grid-cols-2 gap-4">
					<div>
						<Input
							label="First Name"
							id="firstName"
							type="text"
							placeholder="John"
							{...register("fname", {
								required: { value: true, message: "First name is required" },
								pattern: {
									value: /^[A-Za-z'-]{2,}$/,
									message: "Enter a valid name",
								},
							})}
						/>
						{errors.fname && (
							<p className="text-red-500 text-xs mt-1">{errors.fname.message as string}</p>
						)}
					</div>
					<div>
						<Input
							label="Last Name"
							id="lastName"
							type="text"
							placeholder="Doe"
							{...register("lname", {
								required: { value: true, message: "Last name is required" },
								pattern: {
									value: /^[A-Za-z'-]{2,}$/,
									message: "Enter a valid name",
								},
							})}
						/>
						{errors.lname && (
							<p className="text-red-500 text-xs mt-1">{errors.lname.message as string}</p>
						)}
					</div>
				</div>

				<div>
					<Input
						label="Email Address"
						id="email"
						type="email"
						placeholder="you@example.com"
						{...register("email", {
							required: { value: true, message: "Email is required" },
							pattern: {
								value: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
								message: "Please enter a valid email",
							},
						})}
					/>
					{errors.email && (
						<p className="text-red-500 text-xs mt-1">{errors.email.message as string}</p>
					)}
				</div>

				<div className="grid grid-cols-2 gap-4">
					<div>
						<Input
							label="Username"
							id="username"
							type="text"
							placeholder="johndoe123"
							{...register("username", {
								required: { value: true, message: "Username is required" },
								pattern: {
									value: /^[a-zA-Z0-9_]{3,20}$/,
									message: "3-20 characters, no spaces",
								},
							})}
						/>
						{errors.username && (
							<p className="text-red-500 text-xs mt-1">{errors.username.message as string}</p>
						)}
					</div>
					<div>
						<Input
							label="Referral Code"
							id="referrer"
							type="text"
							placeholder="Optional"
							{...register("referal_username", {
								pattern: {
									value: /^[a-zA-Z0-9_]{3,20}$/,
									message: "Invalid username format",
								},
							})}
						/>
					</div>
				</div>

				{/* hidden field for referral_code (autofilled from URL) */}
				<input type="hidden" {...register("referral_code")} />

				<div>
					<label htmlFor="account-type" className="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">
						How will you use HoverTask?
					</label>
					<select
						id="account-type"
						className="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-slate-600 focus:border-[#2C418F] focus:ring-2 focus:ring-[#2C418F]/20 transition-all outline-none bg-gray-50/50 dark:bg-slate-700 dark:text-white"
						{...register("role_id", {
							required: { value: true, message: "Please select an option" },
						})}
					>
						<option value="">Select an option</option>
						<option value="earner">Earn Money (Complete tasks)</option>
						<option value="advertiser">Advertise My Products</option>
						<option value="both">Resell Products</option>
					</select>
					{errors.role_id && (
						<p className="text-red-500 text-xs mt-1">{errors.role_id.message as string}</p>
					)}
				</div>

				<div className="flex items-start gap-3">
					<div className="flex items-center h-5">
						<input
							required
							id="terms"
							type="checkbox"
							className="w-4 h-4 text-[#2C418F] rounded border-gray-300 focus:ring-[#2C418F]"
						/>
					</div>
					<label htmlFor="terms" className="text-sm text-gray-600 dark:text-slate-300">
						I agree to the{" "}
						<Link to="/terms" className="text-[#2C418F] hover:text-blue-700 font-medium">
							Terms of Service
						</Link>{" "}
						and{" "}
						<Link to="/privacy-policy" className="text-[#2C418F] hover:text-blue-700 font-medium">
							Privacy Policy
						</Link>
					</label>
				</div>

				<button
					type="submit"
					className="w-full bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5"
				>
					Continue
				</button>
			</form>
		</div>
	);
};

export default PersonalInfoForm;
