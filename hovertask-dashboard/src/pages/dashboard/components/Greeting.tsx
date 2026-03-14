import { Sparkles } from "lucide-react";

export default function Greeting({
	lname,
	how_you_want_to_use,
}: {
	lname?: string;
	how_you_want_to_use?: string;
}) {
	return (
		<div className="flex justify-between items-start">
			<div>
				<h1 className="text-2xl font-semibold text-zinc-800">
					Welcome back, <span className="capitalize text-primary">{lname}</span>
				</h1>
				<p className="text-sm text-zinc-500 mt-1">
					Here's what's happening with your account today.
				</p>
			</div>
			<div className="bg-gradient-to-r from-amber-500 to-orange-500 text-white py-2 px-4 rounded-xl inline-flex items-center gap-2 text-sm font-medium shadow-md">
				<Sparkles size={16} />{" "}
				<span className="capitalize">{how_you_want_to_use ?? "Earner"}</span>
			</div>
		</div>
	);
}
