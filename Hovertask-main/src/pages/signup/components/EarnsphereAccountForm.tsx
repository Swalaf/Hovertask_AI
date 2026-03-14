import { useState } from "react";
import { useForm } from "react-hook-form";
import { BsArrowLeft } from "react-icons/bs";
import { FaSpinner } from "react-icons/fa";
import Input from "../../../components/Input";

const EarnsphereAccountForm = ({
	onSubmit,
	onBackBtnPress,
}: {
	onSubmit(...props: unknown[]): unknown;
	onBackBtnPress(): unknown;
}) => {
	const {
		register,
		handleSubmit,
		watch,
		setError,
		formState: { errors },
	} = useForm({ mode: "all" });
	const passwordConfirmation = watch("password_confirmation");
	const [isSubmitting, setIsSubmitting] = useState(false);

	return (
		<div className="w-full">
			<div className="mb-6">
				<div className="flex items-center gap-3 mb-4">
					<button
						type="button"
						onClick={onBackBtnPress}
						className="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors dark:text-white"
						title="Back"
						aria-label="Back"
					>
						<BsArrowLeft size={20} />
					</button>
					<h2 className="text-xl md:text-2xl font-bold text-gray-800 dark:text-white">
						Complete Your Profile
					</h2>
				</div>
				<p className="text-gray-600 dark:text-slate-400 text-sm">
					Set up your account preferences to get started
				</p>
			</div>

			<form
				onSubmit={handleSubmit(async (form) => {
					setIsSubmitting(true);
					try {
						if (passwordConfirmation !== form.password) {
							return setError("password_confirmation", {
								message: "Passwords do not match",
							});
						}
						await onSubmit(form);
					} finally {
						setIsSubmitting(false);
					}
				})}
				className="space-y-5"
			>
				<div className="grid grid-cols-2 gap-4">
					<div>
						<label htmlFor="country" className="block text-sm font-semibold text-gray-700 mb-1.5">
							Country
						</label>
						<select
							id="country"
							className="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2C418F] focus:ring-2 focus:ring-[#2C418F]/20 transition-all outline-none bg-gray-50/50"
							{...register("country", {
								required: { value: true, message: "Please select your country" },
							})}
						>
							<option value="">Select country</option>
							<option value="nigeria">Nigeria</option>
						</select>
						{errors.country && (
							<p className="text-red-500 text-xs mt-1">{errors.country.message as string}</p>
						)}
					</div>

					<div>
						<label htmlFor="currency" className="block text-sm font-semibold text-gray-700 mb-1.5">
							Currency
						</label>
						<select
							id="currency"
							className="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2C418F] focus:ring-2 focus:ring-[#2C418F]/20 transition-all outline-none bg-gray-50/50"
							{...register("currency", {
								required: { value: true, message: "Please select currency" },
							})}
						>
							<option value="">Select currency</option>
							<option value="ngn">Nigerian Naira (NGN)</option>
						</select>
						{errors.currency && (
							<p className="text-red-500 text-xs mt-1">{errors.currency.message as string}</p>
						)}
					</div>
				</div>

				<div>
					<Input
						label="Phone Number"
						id="phone-number"
						type="tel"
						placeholder="+234 800 000 0000"
						{...register("phone", {
							required: { value: true, message: "Phone number is required" },
						})}
					/>
					{errors.phone && (
						<p className="text-red-500 text-xs mt-1">{errors.phone.message as string}</p>
					)}
				</div>

				<div className="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<Input
							label="Password"
							id="password"
							type="password"
							placeholder="Create a strong password"
							{...register("password", {
								required: { value: true, message: "Password is required" },
								pattern: {
									value: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
									message: "Min 8 chars: uppercase, lowercase, number, special char",
								},
							})}
						/>
						{errors.password && (
							<p className="text-red-500 text-xs mt-1">{errors.password.message as string}</p>
						)}
					</div>

					<div>
						<Input
							label="Confirm Password"
							id="c-password"
							type="password"
							placeholder="Confirm your password"
							{...register("password_confirmation", {
								required: { value: true, message: "Please confirm your password" },
							})}
						/>
						{errors.password_confirmation && (
							<p className="text-red-500 text-xs mt-1">{errors.password_confirmation.message as string}</p>
						)}
					</div>
				</div>

				<button
					type="submit"
					disabled={isSubmitting}
					className="w-full bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 disabled:opacity-70 disabled:cursor-not-allowed text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2"
				>
					{isSubmitting ? (
						<>
							<FaSpinner className="animate-spin" />
							Creating Account...
						</>
					) : (
						"Create Account"
					)}
				</button>
			</form>
		</div>
	);
};

export default EarnsphereAccountForm;
