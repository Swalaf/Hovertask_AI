import { TrendingUp, CheckCircle, Clock, Award } from "lucide-react";

interface StatsOverviewProps {
  advertiseCount?: number;
  taskCount?: number;
  isMember?: boolean;
}

export default function StatsOverview({
  advertiseCount = 0,
  taskCount = 0,
  isMember = false,
}: StatsOverviewProps) {
  const stats = [
    {
      label: "Total Adverts",
      value: advertiseCount,
      icon: <TrendingUp size={18} />,
      color: "bg-blue-50 text-blue-600",
      borderColor: "border-blue-100",
    },
    {
      label: "Tasks Completed",
      value: taskCount,
      icon: <CheckCircle size={18} />,
      color: "bg-green-50 text-green-600",
      borderColor: "border-green-100",
    },
    {
      label: "Membership",
      value: isMember ? "Active" : "Free",
      icon: <Award size={18} />,
      color: isMember ? "bg-amber-50 text-amber-600" : "bg-zinc-100 text-zinc-500",
      borderColor: isMember ? "border-amber-100" : "border-zinc-200",
    },
  ];

  return (
    <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
      {stats.map((stat, index) => (
        <div
          key={index}
          className={`p-4 rounded-2xl border ${stat.borderColor} bg-white shadow-sm hover:shadow-md transition-shadow duration-200`}
        >
          <div className="flex items-start justify-between">
            <div className={`p-2 rounded-xl ${stat.color}`}>
              {stat.icon}
            </div>
          </div>
          <div className="mt-3">
            <p className="text-2xl font-bold text-zinc-800">{stat.value}</p>
            <p className="text-xs font-medium text-zinc-500 mt-0.5">{stat.label}</p>
          </div>
        </div>
      ))}
    </div>
  );
}
