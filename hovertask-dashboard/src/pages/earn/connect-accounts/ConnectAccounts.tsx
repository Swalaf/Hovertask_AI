import { ArrowLeft, Link2, Check, Facebook, Twitter, Instagram, Youtube } from "lucide-react";
import { type ChangeEvent, useState } from "react";
import { Link } from "react-router";
import { toast } from "sonner";
import type { ActivationState } from "../../../../types";
import useDebounced from "../../../hooks/useDebounced";
import ConnectAccountInputGroup from "./components/ConnectAccountInputGroup";
import validateConnectAccountFormGroup from "./utils/validateConnectAccountFormGroup";
import connectAccountFormInitialState from "./utils/connectAccountFormInitialState";
import connectAccount from "./utils/connectAccount";

function cn(...classes: (string | undefined | null | false)[]): string {
	return classes.filter(Boolean).join(" ");
}

export default function ConnectAccountsPage() {
	const resetGroupActivationState = useDebounced(
		(groupName: keyof ActivationState) =>
			setActivationState({ ...activationState, [groupName]: false }),
		600,
	);

	const [form, setForm] = useState(connectAccountFormInitialState);
	const [activationState, setActivationState] = useState<ActivationState>({
		facebook: false,
		twitter: false,
		instagram: false,
		tikTok: false,
	});
	const [isSubmitting, setIsSubmitting] = useState(false);

	// Handlers for form fields
	const handleFacebookUsernameChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, facebook: { ...form.facebook, username: e.target.value } });
	};
	const handleFacebookProfileLinkChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, facebook: { ...form.facebook, profileLink: e.target.value } });
	};
	const handleTwitterUsernameChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, twitter: { ...form.twitter, username: e.target.value } });
	};
	const handleTwitterProfileLinkChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, twitter: { ...form.twitter, profileLink: e.target.value } });
	};
	const handleInstagramUsernameChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, instagram: { ...form.instagram, username: e.target.value } });
	};
	const handleInstagramProfileLinkChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, instagram: { ...form.instagram, profileLink: e.target.value } });
	};
	const handleTikTokUsernameChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, tikTok: { ...form.tikTok, username: e.target.value } });
	};
	const handleTikTokProfileLinkChange = (e: ChangeEvent<HTMLInputElement>) => {
		setForm({ ...form, tikTok: { ...form.tikTok, profileLink: e.target.value } });
	};

	// ✅ Handle full form submission
	const handleSubmit = async (e: React.FormEvent) => {
		e.preventDefault();

		const validGroups = Object.entries(activationState).filter(
			([, state]) => state === true
		);

		if (validGroups.length === 0) {
			toast.error("Please validate at least one social account before submitting.");
			return;
		}

		try {
			setIsSubmitting(true);

			// ✅ Submit only validated accounts
			const activeAccounts = Object.entries(form)
				.filter(([key]) => activationState[key as keyof ActivationState] === true)
				.reduce((acc, [key, value]) => ({ ...acc, [key]: value }), {});

			await connectAccount(activeAccounts);
			toast.success("Accounts submitted successfully!");
		} catch (error) {
			console.error(error);
			toast.error("Failed to submit accounts. Please try again.");
		} finally {
			setIsSubmitting(false);
		}
	};

	const socialPlatforms = [
		{ 
			key: "facebook", 
			label: "Facebook", 
			icon: Facebook, 
			color: "bg-blue-600",
			username: form.facebook.username,
			profileLink: form.facebook.profileLink,
			validationState: activationState.facebook,
			usernameChange: handleFacebookUsernameChange,
			profileLinkChange: handleFacebookProfileLinkChange,
		},
		{ 
			key: "twitter", 
			label: "Twitter", 
			icon: Twitter, 
			color: "bg-black",
			username: form.twitter.username,
			profileLink: form.twitter.profileLink,
			validationState: activationState.twitter,
			usernameChange: handleTwitterUsernameChange,
			profileLinkChange: handleTwitterProfileLinkChange,
		},
		{ 
			key: "instagram", 
			label: "Instagram", 
			icon: Instagram, 
			color: "bg-gradient-to-br from-purple-600 to-pink-500",
			username: form.instagram.username,
			profileLink: form.instagram.profileLink,
			validationState: activationState.instagram,
			usernameChange: handleInstagramUsernameChange,
			profileLinkChange: handleInstagramProfileLinkChange,
		},
		{ 
			key: "tikTok", 
			label: "TikTok", 
			icon: Youtube, 
			color: "bg-black",
			username: form.tikTok.username,
			profileLink: form.tikTok.profileLink,
			validationState: activationState.tikTok,
			usernameChange: handleTikTokUsernameChange,
			profileLinkChange: handleTikTokProfileLinkChange,
		},
	];

	return (
		<div className="space-y-6">
			{/* Header */}
			<div className="flex items-center gap-4">
				<Link 
					to="/earn" 
					className="w-10 h-10 bg-white border border-zinc-200 rounded-lg flex items-center justify-center hover:border-primary/30 transition-colors"
				>
					<ArrowLeft className="w-5 h-5 text-zinc-600" />
				</Link>
				<div>
					<h1 className="text-xl font-bold text-zinc-800">Connect Your Social Media Accounts</h1>
					<p className="text-sm text-zinc-500">
						Provide your social media usernames and profile links to verify your eligibility to post adverts.
					</p>
				</div>
			</div>

			{/* Info Banner */}
			<div className="bg-blue-50 border border-blue-100 rounded-xl p-4">
				<div className="flex items-start gap-3">
					<div className="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
						<Link2 className="w-5 h-5 text-blue-600" />
					</div>
					<div>
						<h3 className="font-semibold text-blue-800 mb-1">Why Connect Your Accounts?</h3>
						<p className="text-sm text-blue-700">
							Connecting your social media accounts allows you to post adverts and earn money. 
							We verify your account authenticity to ensure quality engagements.
						</p>
					</div>
				</div>
			</div>

			{/* Requirements */}
			<div className="bg-white rounded-xl p-6 border border-zinc-100">
				<h2 className="font-semibold text-zinc-800 mb-4">Eligibility Requirements</h2>
				<div className="grid md:grid-cols-2 gap-4">
					{[
						"Minimum 1,000 followers",
						"Active account with regular posts",
						"Public profile (not private)",
						"Account must be at least 6 months old",
					].map((req, index) => (
						<div key={index} className="flex items-center gap-3">
							<div className="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center">
								<Check className="w-3 h-3 text-green-600" />
							</div>
							<span className="text-sm text-zinc-600">{req}</span>
						</div>
					))}
				</div>
			</div>

			{/* Social Accounts Form */}
			<div className="bg-white rounded-xl p-6 border border-zinc-100">
				<h2 className="font-semibold text-zinc-800 mb-6">Connect Your Accounts</h2>
				<form onSubmit={handleSubmit} className="space-y-6">
					{socialPlatforms.map((platform, index) => (
						<div key={platform.key} className="p-4 bg-zinc-50 rounded-xl">
							<div className="flex items-center gap-3 mb-4">
								<div className={cn("w-10 h-10 rounded-lg flex items-center justify-center", platform.color)}>
									<platform.icon className="w-5 h-5 text-white" />
								</div>
								<div className="flex-1">
									<h3 className="font-medium text-zinc-800">{platform.label}</h3>
									<p className="text-xs text-zinc-500">
										{platform.validationState 
											? "✓ Connected" 
											: "Enter username to validate"}
									</p>
								</div>
								{platform.validationState && (
									<div className="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
										<Check className="w-4 h-4 text-green-600" />
									</div>
								)}
							</div>
							<ConnectAccountInputGroup
								index={index}
								platform={platform.label}
								changeHandlers={[platform.usernameChange, platform.profileLinkChange]}
								placeholders={[`Enter ${platform.label} username`, `Enter ${platform.label} profile link`]}
								values={[platform.username, platform.profileLink]}
								validationState={platform.validationState}
								validateFn={() => validateConnectAccountFormGroup(
									platform.key,
									{ username: platform.username, profileLink: platform.profileLink },
									setActivationState,
								)}
							/>
						</div>
					))}

					<button
						type="submit"
						disabled={isSubmitting}
						className="w-full py-3 bg-primary text-white rounded-xl font-medium hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
					>
						{isSubmitting ? "Submitting..." : "Submit Connected Accounts"}
					</button>
				</form>
			</div>

			{/* Help Section */}
			<div className="bg-zinc-50 rounded-xl p-6 text-center">
				<p className="text-sm text-zinc-500">
					Having trouble connecting your accounts?{" "}
					<Link to="/contact" className="text-primary font-medium hover:underline">
						Contact Support
					</Link>
				</p>
			</div>
		</div>
	);
}
