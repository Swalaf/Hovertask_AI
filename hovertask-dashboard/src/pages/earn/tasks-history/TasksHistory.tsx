import { ArrowLeft, Wallet, CheckCircle, Clock, XCircle, RefreshCw } from "lucide-react";
import { Link } from "react-router";
import { useState } from "react";
import Loading from "../../../shared/components/Loading";
import EmptyMapErr from "../../../shared/components/EmptyMapErr";
import useAuthUserTasks from "../../../hooks/useAuthUserTasks";
import TaskCard from "./components/TaskCard";
import TaskFilter from "./components/TasksFilter";
import cn from "../../../utils/cn";

function PageHeader() {
	return (
		<div className="flex items-center gap-4">
			<Link 
				to="/earn/tasks" 
				className="w-10 h-10 bg-white border border-zinc-200 rounded-lg flex items-center justify-center hover:border-primary/30 transition-colors"
			>
				<ArrowLeft className="w-5 h-5 text-zinc-600" />
			</Link>
			<div>
				<h1 className="text-xl font-bold text-zinc-800">All Social Tasks</h1>
				<p className="text-sm text-zinc-500">
					Track status and earnings from your completed tasks.
				</p>
			</div>
		</div>
	);
}

export default function TasksHistoryPage() {
	const [category, setCategory] = useState("pending");
	const { tasks, stats, reload, loading } = useAuthUserTasks(category);

	// Calculate stats for display
	const pendingCount = stats?.status_counts?.pending || 0;
	const completedCount = stats?.status_counts?.completed || 0;
	const rejectedCount = stats?.status_counts?.rejected || 0;

	return (
		<div className="space-y-6">
			{/* Header */}
			<div className="flex items-center gap-4">
				<Link 
					to="/earn/tasks" 
					className="w-10 h-10 bg-white border border-zinc-200 rounded-lg flex items-center justify-center hover:border-primary/30 transition-colors"
				>
					<ArrowLeft className="w-5 h-5 text-zinc-600" />
				</Link>
				<div>
					<h1 className="text-xl font-bold text-zinc-800">All Social Tasks</h1>
					<p className="text-sm text-zinc-500">
						Track status and earnings from your completed tasks.
					</p>
				</div>
			</div>

			{loading ? (
				<Loading />
			) : (
				<>
					{/* Stats Cards */}
					<div className="grid grid-cols-2 md:grid-cols-4 gap-4">
						{/* Total Earnings */}
						<div className="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-5 text-white">
							<div className="flex items-center gap-3 mb-3">
								<div className="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
									<Wallet className="w-5 h-5" />
								</div>
								<span className="text-green-100 text-sm">Total Earnings</span>
							</div>
							<p className="text-2xl font-bold">
								₦{stats?.total_earnings?.toLocaleString() ?? "0.00"}
							</p>
						</div>

						{/* Pending */}
						<div className="bg-white rounded-xl p-5 border border-zinc-100">
							<div className="flex items-center gap-3 mb-3">
								<div className="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
									<Clock className="w-5 h-5 text-amber-600" />
								</div>
								<span className="text-zinc-500 text-sm">Pending</span>
							</div>
							<p className="text-2xl font-bold text-zinc-800">{pendingCount}</p>
						</div>

						{/* Completed */}
						<div className="bg-white rounded-xl p-5 border border-zinc-100">
							<div className="flex items-center gap-3 mb-3">
								<div className="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
									<CheckCircle className="w-5 h-5 text-green-600" />
								</div>
								<span className="text-zinc-500 text-sm">Completed</span>
							</div>
							<p className="text-2xl font-bold text-zinc-800">{completedCount}</p>
						</div>

						{/* Rejected */}
						<div className="bg-white rounded-xl p-5 border border-zinc-100">
							<div className="flex items-center gap-3 mb-3">
								<div className="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
									<XCircle className="w-5 h-5 text-red-600" />
								</div>
								<span className="text-zinc-500 text-sm">Rejected</span>
							</div>
							<p className="text-2xl font-bold text-zinc-800">{rejectedCount}</p>
						</div>
					</div>

					{/* Filter Section */}
					<div className="bg-white rounded-xl p-5 border border-zinc-100">
						<div className="flex items-center justify-between mb-4">
							<h2 className="font-semibold text-zinc-800">Your Tasks</h2>
							<button 
								onClick={reload}
								className="flex items-center gap-2 text-sm text-primary hover:underline"
							>
								<RefreshCw className="w-4 h-4" />
								Refresh
							</button>
						</div>
						
						{/* Filter Tabs */}
						<div className="flex gap-2 p-1 bg-zinc-100 rounded-lg w-fit">
							{[
								{ key: "pending", label: "Pending" },
								{ key: "completed", label: "Completed" },
								{ key: "rejected", label: "Rejected" },
							].map((filter) => (
								<button
									key={filter.key}
									onClick={() => setCategory(filter.key)}
									className={cn(
										"px-4 py-2 rounded-md text-sm font-medium transition-all",
										category === filter.key
											? "bg-white text-primary shadow-sm"
											: "text-zinc-500 hover:text-zinc-700"
									)}
								>
									{filter.label}
								</button>
							))}
						</div>
					</div>

					{/* Task List */}
					<div className="space-y-3">
						{tasks?.length ? (
							tasks.map((task) => <TaskCard key={task.id} {...task} />)
						) : (
							<div className="bg-white rounded-xl p-8 border border-zinc-100 text-center">
								<div className="w-16 h-16 bg-zinc-100 rounded-full flex items-center justify-center mx-auto mb-4">
									<Clock className="w-8 h-8 text-zinc-400" />
								</div>
								<h3 className="text-lg font-semibold text-zinc-800 mb-2">No Tasks Found</h3>
								<p className="text-zinc-500 text-sm mb-4">
									You don't have any {category} tasks at the moment.
								</p>
								<Link 
									to="/earn/tasks"
									className="inline-flex items-center gap-2 text-primary font-medium hover:underline"
								>
									Browse available tasks
								</Link>
							</div>
						)}
					</div>
				</>
			)}
		</div>
	);
}
