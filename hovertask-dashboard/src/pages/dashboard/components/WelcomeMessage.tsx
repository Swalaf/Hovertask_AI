import { useEffect } from "react";
import { useDispatch } from "react-redux";
import { ShieldCheck, AlertCircle, Crown } from "lucide-react";
import type { AuthUserDTO } from "../../../../types";
import autoVerifyAccountActivation from "../utils/autoVerifyAccountActivation";
import requestVerificationEmail from "../utils/requestVerificationEmail";

export default function WelcomeMessage(props: AuthUserDTO) {
	const dispatch = useDispatch();

	useEffect(() => {
		const interval = setInterval(() => {
			if (!props.email_verified_at) autoVerifyAccountActivation(dispatch);
			else clearInterval(interval);
		}, 3000);

		return () => clearInterval(interval);
	}, [dispatch, props]);

	// Member - Active Status
	if (props.email_verified_at && props.is_member) {
		return (
			<div className="text-center p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-100">
				<div className="inline-flex items-center justify-center p-3 bg-green-100 rounded-full mb-4">
					<Crown size={24} className="text-green-600" />
				</div>
				<h2 className="text-xl font-semibold text-green-800">You're a Premium Member!</h2>
				<p className="text-sm text-green-700 mt-2 max-w-md mx-auto">
					Your membership is active. Start earning daily by posting adverts and completing tasks on your social media accounts.
				</p>
			</div>
		);
	}

	// Verified but not a member
	if (props.email_verified_at && !props.is_member) {
		return (
			<div className="text-center p-6 bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl border border-amber-100">
				<div className="inline-flex items-center justify-center p-3 bg-amber-100 rounded-full mb-4">
					<ShieldCheck size={24} className="text-amber-600" />
				</div>
				<h2 className="text-lg font-semibold text-amber-800">Upgrade to Premium</h2>
				<p className="text-sm text-amber-700 mt-2">
					Get access to all services with just ₦500 <span className="font-medium">ONLY</span>!
				</p>
				<a
					href="/become-a-member"
					className="inline-block mt-4 px-6 py-2.5 bg-primary text-white rounded-full text-sm font-medium hover:bg-primary/90 transition-colors"
				>
					Become a Member
				</a>
			</div>
		);
	}

	// Unverified email
	return (
		<div className="text-center p-6 bg-red-50 rounded-2xl border border-red-100">
			<div className="inline-flex items-center justify-center p-3 bg-red-100 rounded-full mb-4">
				<AlertCircle size={24} className="text-red-600" />
			</div>
			<h2 className="text-lg font-semibold text-red-800">Verify Your Account</h2>
			<p className="text-sm text-red-700 mt-2">
				Please verify your email to access all features.
			</p>
			<button
				type="button"
				onClick={async () => requestVerificationEmail(props.email)}
				className="mt-4 px-6 py-2.5 bg-red-600 text-white rounded-full text-sm font-medium hover:bg-red-700 transition-colors"
			>
				Send Verification Email
			</button>
			<p className="mt-4 text-xs text-red-600">
				Get access to all services with just ₦500 <span className="font-medium">ONLY</span> verify your account now!
			</p>
		</div>
	);
}
