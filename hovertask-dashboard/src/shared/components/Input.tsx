import { useState } from "react";
import cn from "../../utils/cn";

export default function Input(
	props: React.InputHTMLAttributes<HTMLInputElement> & {
		label?: React.ReactNode;
		icon?: React.ReactNode;
		errorMessage?: string;
		helperText?: string;
	},
) {
	const { errorMessage, helperText, label, icon, ...rest } = props;
	const [isFocused, setIsFocused] = useState(false);
	const hasError = !!errorMessage;

	return (
		<div className="flex flex-col gap-1.5">
			{label && (
				<label 
					htmlFor={rest.id} 
					className="text-sm font-semibold text-zinc-700 transition-colors"
				>
					{label}
				</label>
			)}
			{icon ? (
				<div className="relative">
					<div
						className={cn(
							"flex items-center gap-3 border-2 rounded-xl px-4 py-3.5 text-sm transition-all duration-300",
							isFocused 
								? "border-primary bg-primary/5 shadow-lg shadow-primary/10" 
								: "border-zinc-200 bg-white hover:border-zinc-300 hover:shadow-md",
							hasError && "border-red-400 bg-red-50 shadow-red-500/10",
						)}
					>
						<span className={cn(
							"text-zinc-400 transition-all duration-300", 
							isFocused && "text-primary scale-110",
							hasError && "text-red-400"
						)}>
							{icon}
						</span>
						<input
							onFocus={() => setIsFocused(true)}
							onBlur={() => setIsFocused(false)}
							{...rest}
							className={cn(
								"flex-1 min-w-0 outline-none bg-transparent text-zinc-800 placeholder:text-zinc-400 transition-all",
								rest.className,
							)}
						/>
					</div>
					{/* Animated focus ring */}
					<div 
						className={cn(
							"absolute inset-0 rounded-xl pointer-events-none transition-all duration-300",
							isFocused && !hasError && "ring-4 ring-primary/20 scale-105",
							hasError && "ring-4 ring-red-500/20"
						)}
					/>
				</div>
			) : (
				<div className="relative">
					<input
						{...rest}
						onFocus={() => setIsFocused(true)}
						onBlur={() => setIsFocused(false)}
						className={cn(
							"w-full border-2 rounded-xl px-4 py-3.5 text-sm transition-all duration-300 outline-none",
							"bg-white text-zinc-800 placeholder:text-zinc-400",
							isFocused 
								? "border-primary bg-white shadow-lg shadow-primary/10" 
								: "border-zinc-200 hover:border-zinc-300 hover:shadow-md",
							hasError && "border-red-400 bg-red-50 shadow-red-500/10",
							rest.className,
						)}
					/>
					{/* Animated focus ring */}
					<div 
						className={cn(
							"absolute inset-0 rounded-xl pointer-events-none transition-all duration-300",
							isFocused && !hasError && "ring-4 ring-primary/20 scale-[1.02]",
							hasError && "ring-4 ring-red-500/20"
						)}
					/>
				</div>
			)}
			{(errorMessage || helperText) && (
				<p className={cn(
					"text-sm font-medium transition-all duration-300",
					hasError ? "text-red-500" : "text-zinc-500"
				)}>
					{errorMessage || helperText}
				</p>
			)}
		</div>
	);
}
