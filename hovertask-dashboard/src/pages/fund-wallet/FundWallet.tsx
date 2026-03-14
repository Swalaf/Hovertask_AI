import { ArrowLeft, Wallet, ArrowUpRight, ArrowDownRight, CreditCard, Banknote, Smartphone } from "lucide-react";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { useSelector } from "react-redux";
import { Link } from "react-router";
import type { AuthUserDTO } from "../../../types";
import WithdrawModal from "../dashboard/components/WithdrawModal";

function cn(...classes: (string | undefined | null | false)[]): string {
	return classes.filter(Boolean).join(" ");
}

export default function FundWalletPage() {
	const authUser = useSelector<{ auth: { value: AuthUserDTO } }, AuthUserDTO>(
		(state) => state.auth.value,
	);

	const [amount, setAmount] = useState("");
	const [selectedMethod, setSelectedMethod] = useState<number | null>(null);
	const [showWithdrawModal, setShowWithdrawModal] = useState(false);

	const {
		handleSubmit,
		formState: { isSubmitting },
	} = useForm({ mode: "all" });

	const quickAmounts = [1000, 2000, 5000, 10000, 20000, 50000];

	const paymentMethods = [
		{ icon: CreditCard, label: "Card", desc: "Pay with debit card" },
		{ icon: Banknote, label: "Bank Transfer", desc: "Direct bank transfer" },
		{ icon: Smartphone, label: "USSD", desc: "Quick USSD payment" },
	];

	const onSubmit = async (data: any) => {
		if (!amount || parseFloat(amount) <= 0) return;
		if (selectedMethod === null) return;
		
		console.log("Processing payment for amount:", amount, "method:", selectedMethod);
	};

	return (
		<div className="space-y-6">
			{/* Header */}
			<div className="flex items-center gap-4">
				<Link 
					to="/" 
					className="w-10 h-10 bg-white border border-zinc-200 rounded-xl flex items-center justify-center hover:border-primary/30 hover:shadow-md transition-all"
				>
					<ArrowLeft className="w-5 h-5 text-zinc-600" />
				</Link>
				<div>
					<h1 className="text-xl font-bold text-zinc-800">Fund Your Wallet</h1>
					<p className="text-sm text-zinc-500">
						Easily add funds to your wallet to shop, pay, or resell effortlessly
					</p>
				</div>
			</div>

			{/* Main Content Grid */}
			<div className="grid lg:grid-cols-3 gap-6">
				{/* Left Column - Balance & Fund */}
				<div className="lg:col-span-2 space-y-6">
					{/* Balance Card */}
					<div className="bg-gradient-to-r from-primary to-blue-700 rounded-2xl p-6 text-white shadow-lg shadow-primary/25">
						<div className="flex items-center justify-between mb-4">
							<div className="flex items-center gap-3">
								<div className="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
									<Wallet className="w-6 h-6" />
								</div>
								<div>
									<p className="text-blue-100 text-sm">Available Balance</p>
									<h2 className="text-3xl font-bold">₦{authUser.balance.toLocaleString()}</h2>
								</div>
							</div>
							<button
								onClick={() => setShowWithdrawModal(true)}
								className="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg text-sm font-medium transition-all hover:scale-105"
							>
								Withdraw
							</button>
						</div>
						<div className="grid grid-cols-3 gap-4 pt-4 border-t border-white/20">
							<div className="text-center">
								<p className="text-blue-100 text-xs">Total Spent</p>
								<p className="font-semibold">₦12,450</p>
							</div>
							<div className="text-center">
								<p className="text-blue-100 text-xs">Total Earned</p>
								<p className="font-semibold">₦45,200</p>
							</div>
							<div className="text-center">
								<p className="text-blue-100 text-xs">Pending</p>
								<p className="font-semibold">₦2,500</p>
							</div>
						</div>
					</div>

					{/* Amount Input */}
					<div className="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
						<h3 className="font-semibold text-zinc-800 mb-4">Enter Amount</h3>
						<div className="relative">
							<div className="absolute left-4 top-1/2 -translate-y-1/2 z-10">
								<span className="text-zinc-400 font-bold text-xl">₦</span>
							</div>
							<input
								type="number"
								value={amount}
								onChange={(e) => setAmount(e.target.value)}
								placeholder="0.00"
								className="w-full pl-12 pr-4 py-4 text-2xl font-bold text-zinc-800 bg-zinc-50 border-2 border-zinc-200 rounded-xl focus:border-primary focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all outline-none"
							/>
						</div>
					</div>

					{/* Quick Amounts */}
					<div className="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
						<h3 className="font-semibold text-zinc-800 mb-4">Quick Amount</h3>
						<div className="grid grid-cols-3 md:grid-cols-6 gap-3">
							{quickAmounts.map((amt) => (
								<button
									key={amt}
									onClick={() => setAmount(amt.toString())}
									className={cn(
										"py-2.5 px-3 rounded-xl text-sm font-semibold transition-all hover:scale-105",
										amount === amt.toString()
											? "bg-gradient-to-r from-primary to-blue-600 text-white shadow-lg shadow-primary/25"
											: "bg-zinc-100 text-zinc-600 hover:bg-zinc-200"
									)}
								>
									₦{amt.toLocaleString()}
								</button>
							))}
						</div>
					</div>

					{/* Payment Methods */}
					<div className="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
						<h3 className="font-semibold text-zinc-800 mb-4">Select Payment Method</h3>
						<div className="grid md:grid-cols-3 gap-4">
							{paymentMethods.map((method, index) => (
								<button
									key={index}
									onClick={() => setSelectedMethod(index)}
									className={cn(
										"p-5 rounded-xl border-2 transition-all text-left hover:shadow-md",
										selectedMethod === index
											? "border-primary bg-primary/5 shadow-lg shadow-primary/10"
											: "border-zinc-200 hover:border-primary/50"
									)}
								>
									<div className={cn(
										"w-12 h-12 rounded-xl flex items-center justify-center mb-3 transition-colors",
										selectedMethod === index ? "bg-primary text-white" : "bg-zinc-100 text-zinc-600"
									)}>
										<method.icon className="w-6 h-6" />
									</div>
									<p className="font-semibold text-zinc-800">{method.label}</p>
									<p className="text-xs text-zinc-500 mt-1">{method.desc}</p>
								</button>
							))}
						</div>
					</div>

					{/* Fund Button */}
					<button
						onClick={handleSubmit(onSubmit)}
						disabled={!amount || parseFloat(amount) <= 0 || selectedMethod === null || isSubmitting}
						className={cn(
							"w-full py-4 rounded-xl font-bold text-lg transition-all",
							amount && selectedMethod !== null
								? "bg-gradient-to-r from-primary to-blue-600 text-white shadow-lg shadow-primary/25 hover:shadow-xl hover:scale-[1.02]"
								: "bg-zinc-200 text-zinc-400 cursor-not-allowed"
						)}
					>
						{isSubmitting ? (
							<span className="flex items-center justify-center gap-2">
								<svg className="animate-spin h-5 w-5" viewBox="0 0 24 24">
									<circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
									<path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
								</svg>
								Processing...
							</span>
						) : (
							`Fund ₦${amount ? parseFloat(amount).toLocaleString() : '0'}`
						)}
					</button>
				</div>

				{/* Right Column - Info */}
				<div className="space-y-6">
					{/* How to Fund */}
					<div className="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
						<h3 className="font-semibold text-zinc-800 mb-4">How to Fund Your Wallet</h3>
						<div className="space-y-4">
							{[
								{ step: "1", title: "Enter Amount", desc: "Type the amount you want to add" },
								{ step: "2", title: "Choose Method", desc: "Select your preferred payment option" },
								{ step: "3", title: "Complete Payment", desc: "Follow the prompts to complete payment" },
								{ step: "4", title: "Instant Credit", desc: "Your wallet is credited instantly" },
							].map((item) => (
								<div key={item.step} className="flex gap-3">
									<div className="w-8 h-8 bg-gradient-to-r from-primary to-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 shadow-md">
										{item.step}
									</div>
									<div>
										<p className="font-medium text-zinc-800 text-sm">{item.title}</p>
										<p className="text-xs text-zinc-500">{item.desc}</p>
									</div>
								</div>
							))}
						</div>
					</div>

					{/* Recent Transactions */}
					<div className="bg-white rounded-xl p-6 border border-zinc-100 shadow-sm">
						<div className="flex items-center justify-between mb-4">
							<h3 className="font-semibold text-zinc-800">Recent Activity</h3>
							<Link to="/transactions" className="text-primary text-sm hover:underline font-medium">
								View All
							</Link>
						</div>
						<div className="space-y-3">
							{[
								{ type: "credit", amount: 5000, desc: "Wallet Funding", date: "Today" },
								{ type: "debit", amount: 2500, desc: "Product Purchase", date: "Yesterday" },
								{ type: "credit", amount: 1000, desc: "Task Completion", date: "2 days ago" },
							].map((txn, index) => (
								<div key={index} className="flex items-center justify-between py-2 hover:bg-zinc-50 rounded-lg px-2 -mx-2 transition-colors">
									<div className="flex items-center gap-3">
										<div className={cn(
											"w-9 h-9 rounded-full flex items-center justify-center",
											txn.type === "credit" ? "bg-green-100" : "bg-red-100"
										)}>
											{txn.type === "credit" 
												? <ArrowDownRight className="w-4 h-4 text-green-600" />
												: <ArrowUpRight className="w-4 h-4 text-red-600" />
											}
										</div>
										<div>
											<p className="text-sm font-medium text-zinc-800">{txn.desc}</p>
											<p className="text-xs text-zinc-500">{txn.date}</p>
										</div>
									</div>
									<span className={cn(
										"font-bold text-sm",
										txn.type === "credit" ? "text-green-600" : "text-red-600"
									)}>
										{txn.type === "credit" ? "+" : "-"}₦{txn.amount.toLocaleString()}
									</span>
								</div>
							))}
						</div>
					</div>
				</div>
			</div>

			{/* Withdraw Modal */}
			<WithdrawModal 
				show={showWithdrawModal} 
				onClose={() => setShowWithdrawModal(false)} 
			/>
		</div>
	);
}
