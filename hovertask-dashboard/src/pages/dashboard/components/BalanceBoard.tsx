import { Wallet, ArrowUpRight, ArrowDownRight, Clock } from "lucide-react";
import { Link } from "react-router";
import { useState } from "react";
import WithdrawModal from "./WithdrawModal"; 

interface BalanceBoardProps {
  balance?: number;
  earned?: number;
  pending?: number;
  spent?: number;
}

export default function BalanceBoard({
  balance = 0,
  earned = 0,
  pending = 0,
  spent = 0,
}: BalanceBoardProps) {
  const [showWithdraw, setShowWithdraw] = useState(false);

  const handleOpenWithdraw = (e: React.MouseEvent) => {
    e.preventDefault();
    setShowWithdraw(true);
  };

  const handleCloseWithdraw = () => setShowWithdraw(false);

  return (
    <div className="space-y-4">
      {/* Total Balance */}
      <div className="flex items-center gap-2">
        <span className="text-lg font-medium text-zinc-600">Total Balance</span>
      </div>

      {/* Balance Amount + Fund / Withdraw Buttons */}
      <div className="flex items-center gap-6 flex-wrap">
        <div className="text-4xl font-bold text-zinc-800">
          ₦{balance.toLocaleString()}
        </div>
        <div className="flex gap-3 text-sm font-medium">
          <Link
            to="/fund-wallet"
            className="flex items-center gap-2 px-5 py-2.5 text-white bg-primary rounded-full hover:bg-primary/90 transition-all shadow-md hover:shadow-lg"
          >
            <Wallet size={16} /> Fund
          </Link>
          <Link
            to="/withdraw"
            onClick={handleOpenWithdraw}
            className="flex items-center gap-2 px-4 py-2.5 text-primary border border-primary rounded-full transition-colors hover:bg-primary/10"
          >
            Withdraw
          </Link>
        </div>
      </div>

      {/* Earned / Pending / Spent Section */}
      <div className="grid grid-cols-3 gap-4">
        {/* Earned */}
        <div className="flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-100">
          <div className="p-2 rounded-lg bg-green-100 text-green-600">
            <ArrowUpRight size={16} />
          </div>
          <div>
            <p className="text-xs text-green-700 font-medium">Earned</p>
            <p className="text-lg font-bold text-green-800">₦{earned.toLocaleString()}</p>
          </div>
        </div>

        {/* Pending */}
        <div className="flex items-center gap-3 p-4 rounded-xl bg-amber-50 border border-amber-100">
          <div className="p-2 rounded-lg bg-amber-100 text-amber-600">
            <Clock size={16} />
          </div>
          <div>
            <p className="text-xs text-amber-700 font-medium">Pending</p>
            <p className="text-lg font-bold text-amber-800">₦{pending.toLocaleString()}</p>
          </div>
        </div>

        {/* Spent */}
        <div className="flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-100">
          <div className="p-2 rounded-lg bg-red-100 text-red-600">
            <ArrowDownRight size={16} />
          </div>
          <div>
            <p className="text-xs text-red-700 font-medium">Spent</p>
            <p className="text-lg font-bold text-red-800">₦{spent.toLocaleString()}</p>
          </div>
        </div>
      </div>

      {/* Withdraw Modal */}
      {showWithdraw && (
        <WithdrawModal
          show={showWithdraw}
          onClose={handleCloseWithdraw}
          balance={balance}
        />
      )}
    </div>
  );
}
