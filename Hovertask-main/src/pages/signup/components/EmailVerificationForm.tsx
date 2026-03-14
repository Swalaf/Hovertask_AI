import { useForm } from "react-hook-form";
import { useState } from "react";
import { FaSpinner, FaCheck } from "react-icons/fa";
import Input from "../../../components/Input";

interface VerificationFormData {
	code: string;
}

interface EmailVerificationFormProps {
	onSubmit: (code: string) => void;
	email?: string;
}

const EmailVerificationForm = ({ onSubmit, email }: EmailVerificationFormProps) => {
	const { register, handleSubmit, formState: { errors } } = useForm<VerificationFormData>();
	const [loading, setLoading] = useState(false);
	const [error, setError] = useState<string | null>(null);

	const handleVerify: (data: VerificationFormData) => Promise<void> = async (data) => {
		setLoading(true);
		setError(null);
		try {
			const response = await fetch("https://backend.hovertask.com/api/verify-email-code", {
				method: "POST",
				headers: { "Content-Type": "application/json" },
				body: JSON.stringify({ code: data.code, email }),
			});
			if (response.ok) {
				onSubmit(data.code);
			} else {
				const res = await response.json();
				setError(res.message || "Verification failed. Please try again.");
			}
		} catch {
			setError("Network error. Please try again.");
		}
		setLoading(false);
	};

	const [resendLoading, setResendLoading] = useState(false);
	const [resendMessage, setResendMessage] = useState<string | null>(null);

	const handleResend = async () => {
		setResendLoading(true);
		setResendMessage(null);
		try {
			const response = await fetch("https://backend.hovertask.com/api/resend-email-code", {
				method: "POST",
				headers: { "Content-Type": "application/json" },
				body: JSON.stringify({ email }),
			});
			if (response.ok) {
				setResendMessage("A new code has been sent to your email.");
			} else {
				const res = await response.json();
				setResendMessage(res.message || "Failed to resend code. Try again.");
			}
		} catch {
			setResendMessage("Network error. Please try again.");
		}
		setResendLoading(false);
	};

	return (
		<div className="w-full">
			<div className="mb-6">
				<div className="w-16 h-16 bg-gradient-to-br from-[#2C418F]/20 to-blue-50 rounded-full flex items-center justify-center mb-4">
					<svg className="w-8 h-8 text-[#2C418F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
					</svg>
				</div>
				<h2 className="text-xl md:text-2xl font-bold text-gray-800 dark:text-white">Verify Your Email</h2>
				<p className="text-gray-600 dark:text-slate-400 mt-1 text-sm">
					We've sent a verification code to<br />
					<span className="font-semibold text-[#2C418F]">{email}</span>
				</p>
			</div>
			
			<form onSubmit={handleSubmit(handleVerify)} className="space-y-5">
				<Input
					label="Verification Code"
					id="code"
					type="text"
					placeholder="Enter 6-digit code"
					{...register("code", { required: "Please enter the verification code" })}
				/>
				{errors.code && (
					<p className="text-red-500 text-xs -mt-3">{errors.code.message as string}</p>
				)}
				{error && (
					<div className="bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-sm p-3 rounded-lg">{error}</div>
				)}
				
				<button
					type="submit"
					disabled={loading}
					className="w-full bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 disabled:opacity-70 text-white py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2"
				>
					{loading ? (
						<>
							<FaSpinner className="animate-spin" />
							Verifying...
						</>
					) : (
						<>
							<FaCheck />
							Verify Email
						</>
					)}
				</button>
			</form>
			
			<div className="mt-6 text-center">
				<p className="text-gray-500 dark:text-slate-400 text-sm mb-2">Didn't receive the code?</p>
				<button
					type="button"
					className="text-[#2C418F] hover:text-blue-700 font-semibold text-sm transition-colors"
					onClick={handleResend}
					disabled={resendLoading}
				>
					{resendLoading ? "Sending..." : "Resend Code"}
				</button>
				{resendMessage && (
					<p className={`text-sm mt-2 ${resendMessage.includes("sent") ? "text-green-600 dark:text-green-400" : "text-red-500"}`}>
						{resendMessage}
					</p>
				)}
			</div>
		</div>
	);
};

export default EmailVerificationForm;
