import { CircularProgress } from "@heroui/react";
import { Link } from "react-router";
import { Users, ArrowUpRight } from "lucide-react";

export default function ReferTaskCard() {
  return (
    <div className="border border-zinc-200 rounded-2xl p-5 bg-white shadow-sm hover:shadow-md transition-all duration-200">
      <div className="flex items-start justify-between gap-4">
        <div className="flex items-start gap-3">
          <div className="p-2.5 rounded-xl bg-green-100 text-green-600">
            <Users size={20} />
          </div>
          <div>
            <p className="font-semibold text-zinc-800">Refer & Earn Task</p>
            <p className="text-xs text-zinc-500 mt-1">Invite friends and earn ₦500 per referral</p>
          </div>
        </div>
        <p className="text-xl font-bold text-green-600">₦500</p>
      </div>

      <div className="flex items-center justify-between mt-4 pt-4 border-t border-zinc-100">
        <div className="flex items-center gap-2">
          <span className="px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium">
            Available
          </span>
        </div>

        <CircularProgress
          color="success"
          size="sm"
          value={50}
          className="scale-75"
        />

        <Link
          to={`/refer-and-earn`}
          className="flex items-center gap-1.5 px-4 py-2 rounded-full border border-zinc-800 text-zinc-800 text-sm font-medium transition-colors hover:bg-zinc-800 hover:text-white"
        >
          Start <ArrowUpRight size={14} />
        </Link>
      </div>
    </div>
  );
}
