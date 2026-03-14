import { CircularProgress } from "@heroui/react";
import { Link } from "react-router";
import { ShoppingBag, ArrowUpRight } from "lucide-react";

export default function ResellerTaskCard() {
  return (
    <div className="border border-zinc-200 rounded-2xl p-5 bg-white shadow-sm hover:shadow-md transition-all duration-200">
      <div className="flex items-start justify-between gap-4">
        <div className="flex items-start gap-3">
          <div className="p-2.5 rounded-xl bg-primary/10 text-primary">
            <ShoppingBag size={20} />
          </div>
          <div>
            <p className="font-semibold text-zinc-800">Reseller Growth Task</p>
            <p className="text-xs text-zinc-500 mt-1 leading-relaxed">
              Boost your earnings by completing simple reseller milestones.
            </p>
          </div>
        </div>
        <p className="text-xl font-bold text-primary">₦500 <span className="text-xs font-normal text-zinc-500">Bonus</span></p>
      </div>

      <div className="flex items-center justify-between mt-4 pt-4 border-t border-zinc-100">
        <div className="flex items-center gap-2">
          <span className="px-2.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-medium">
            Active for Resellers
          </span>
        </div>

        <CircularProgress
          color="primary"
          size="sm"
          value={15}
          className="scale-75"
        />

        <Link
          to={`/earn/resell`} 
          className="flex items-center gap-1.5 px-4 py-2 rounded-full border border-primary text-primary text-sm font-medium transition-colors hover:bg-primary hover:text-white"
        >
          Start <ArrowUpRight size={14} />
        </Link>
      </div>
    </div>
  );
}
