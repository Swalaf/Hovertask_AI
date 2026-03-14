import { RefreshCw, Inbox } from "lucide-react";

export default function EmptyMapErr({
	description,
	onButtonClick,
	buttonInnerText,
}: {
	description: React.ReactNode;
	buttonInnerText: string;
	onButtonClick?(): unknown;
}) {
	return (
		<div className="flex flex-col items-center justify-center text-center py-8 px-4">
			<div className="p-4 bg-zinc-100 rounded-full mb-4">
				<Inbox size={32} className="text-zinc-400" />
			</div>
			<p className="text-zinc-600 mb-6 max-w-sm">{description}</p>
			<button
				type="button"
				onClick={onButtonClick || (() => window.location.reload())}
				className="flex items-center gap-2 bg-primary text-white px-6 py-2.5 text-sm font-medium rounded-full transition-all hover:bg-primary/90 hover:shadow-lg active:scale-95"
			>
				<RefreshCw size={16} />
				{buttonInnerText}
			</button>
		</div>
	);
}
