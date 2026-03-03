import { useState } from "react";
import { useForm } from "react-hook-form";
import { BsArrowLeft } from "react-icons/bs";
import spinner from "../../../assets/spinner.gif";
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
		<div className="w-full min-w-full max-w-ful">
			<div className="mb-8">
				<div className="flex items-center gap-2">
					<button
						type="button"
						onClick={onBackBtnPress}
						className="cursor-pointer"
						title="Back"
						aria-label="Back"
					>
						<BsArrowLeft size={24} />
					</button>
					<h2 className="text-2xl font-semibold text-gray-800">
						Create Hovertask Account
					</h2>
				</div>
				<p className="text-gray-600 mt-2">
					Discover endless opportunities, advertise and resell properties
				</p>
			</div>

			<form
				onSubmit={handleSubmit(async (form) => {
					setIsSubmitting(true);

					try {
						if (passwordConfirmation !== form.password)
							return setError("password_confirmation", {
								message: "Passwords do not match",
							});
						await onSubmit(form);
					} finally {
						setIsSubmitting(false);
					}
				})}
				className="space-y-6"
			>
				<div className="grid grid-cols-2 gap-4">
					<div>
						<div className="space-y-1">
							<label
								htmlFor="country"
								className="block text-sm font-medium text-gray-700"
							>
								Country
							</label>
							<select
								id="country"
								className="w-full p-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none bg-gray-50"
								{...register("country", {
									required: { value: true, message: "Please select an option" },
								})}
							>
								<option value="">Select your country</option>
								<option value="nigeria">Nigeria</option>
							</select>
						</div>
						<small className="text-red-500">
							{errors.country && (errors.country.message as string)}
						</small>
					</div>

					<div>
						<div className="space-y-1">
							<label
								htmlFor="currency"
								className="block text-sm font-medium text-gray-700"
							>
								Currency
							</label>
							<select
								id="currency"
								className="w-full p-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none bg-gray-50"
								{...register("currency", {
									required: { value: true, message: "Please select an option" },
								})}
							>
								<option value="">Select your currency</option>
								<option value="ngn">NGN</option>
							</select>
						</div>
						<small className="text-red-500">
							{errors.currency && (errors.currency.message as string)}
						</small>
					</div>
				</div>

				<div>
					<Input
						label="Phone Number"
						id="phone-number"
						type="tel"
						{...register("phone", {
							required: {
								value: true,
								message: "Please enter your phone number",
							},
						})}
					/>
					<small className="text-red-500">
						{errors.phone && (errors.phone.message as string)}
					</small>
				</div>

				<div className="grid grid-cols-2 gap-4">
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
									value:
										/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
									message:
										"Password must contain at least 8 characters, one uppercase letter, one lowercase letter, one number and one special character",
								},
							})}
						/>
						<small className="text-red-500">
							{errors.password && (errors.password.message as string)}
						</small>
					</div>

					<div>
						<Input
							label="Confirm password"
							id="c-password"
							type="password"
							{...register("password_confirmation", {
								required: {
									value: true,
									message: "Please confirm your password",
								},
							})}
						/>
						<small className="text-red-500">
							{errors.password_confirmation &&
								(errors.password_confirmation.message as string)}
						</small>
					</div>
				</div>

				<button
					type="submit"
					className="w-fit bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-full cursor-pointer font-medium transition-colors duration-200 shadow-lg shadow-blue-600/20"
				>
					Submit
				</button>
			</form>

			{isSubmitting && (
				<div className="fixed inset-0 bg-white/30 backdrop-blur-sm z-999 flex flex-col items-center justify-center">
					<img src={spinner} alt="Spinner" />
					<p className="text-2xl">Creating Your Account</p>
				</div>
			)}
		</div>
	);
};

export default EarnsphereAccountForm;
