import { ArrowLeft, Copy, Users, DollarSign, Clock, CheckCircle, Share2, Gift } from "lucide-react";
import { useSelector } from "react-redux";
import { Link } from "react-router";
import { toast } from "sonner";
import { useEffect, useState } from "react";
import type { AuthUserDTO } from "../../../types";
import apiEndpointBaseURL from "../../utils/apiEndpointBaseURL";
import getAuthorization from "../../utils/getAuthorization";

function cn(...classes: (string | undefined | null | false)[]): string {
	return classes.filter(Boolean).join(" ");
}

type ReferredItem = {
  id: number;
  amount: number;
  status: string;
  created_at: string | null;
  referee: {
    id: number;
    fname: string;
    lname: string;
    avatar?: string | null;
    created_at?: string | null;
  } | null;
};

export default function ReferAndEarnPage() {
  const referralCode = useSelector<{ auth: { value: AuthUserDTO } }, string>(
    (state) => state.auth.value.referral_code,
  );
  const refLink = `https://hovertask.com/signup/?ref=${referralCode}`;

  const [loading, setLoading] = useState<boolean>(true);
  const [count, setCount] = useState<number>(0);
  const [pending, setPending] = useState<number>(0);
  const [completed, setCompleted] = useState<number>(0);
  const [total, setTotal] = useState<number>(0);
  const [referred, setReferred] = useState<ReferredItem[]>([]);

  async function copyRefLink() {
    try {
      await window.navigator.clipboard.writeText(refLink);
      toast.success("Copied to clipboard!");
    } catch {
      toast.error("Failed to copy!");
    }
  }

  useEffect(() => {
    let mounted = true;
    async function fetchReferrals() {
      setLoading(true);
      try {
        const res = await fetch(`${apiEndpointBaseURL}/referrals`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: getAuthorization(),
          },
        });

        const json = await res.json();
        if (!res.ok) {
          throw new Error(json.message || "Failed to load referrals");
        }

        const d = json.data || {};
        if (!mounted) return;

        setCount(d.count ?? 0);
        setPending(Number(d.pending ?? 0));
        setCompleted(Number(d.completed ?? 0));
        setTotal(Number(d.total ?? (Number(d.pending ?? 0) + Number(d.completed ?? 0))));
        setReferred(Array.isArray(d.referrals) ? d.referrals : []);
      } catch (err: any) {
        console.error("referrals fetch error", err);
        toast.error(err?.message || "Failed to fetch referrals");
      } finally {
        if (mounted) setLoading(false);
      }
    }

    fetchReferrals();
    return () => {
      mounted = false;
    };
  }, [referralCode]);

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center gap-4">
        <Link 
          to="/" 
          className="w-10 h-10 bg-white border border-zinc-200 rounded-lg flex items-center justify-center hover:border-primary/30 transition-colors"
        >
          <ArrowLeft className="w-5 h-5 text-zinc-600" />
        </Link>
        <div>
          <h1 className="text-xl font-bold text-zinc-800">Refer & Earn</h1>
          <p className="text-sm text-zinc-500">
            Invite friends and earn ₦500 for each successful referral
          </p>
        </div>
      </div>

      {/* Hero Banner */}
      <div className="bg-gradient-to-r from-primary to-blue-700 rounded-2xl p-8 text-white">
        <div className="flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="text-center md:text-left">
            <div className="inline-flex items-center gap-2 bg-white/20 px-4 py-2 rounded-full mb-4">
              <Gift className="w-5 h-5" />
              <span className="text-sm font-medium">Earn ₦500 per referral</span>
            </div>
            <h2 className="text-2xl font-bold mb-2">Share the Love, Earn Rewards</h2>
            <p className="text-blue-100 max-w-md">
              Invite your friends, family, or colleagues to join our platform using your unique referral link.
              Each successful referral puts money into your referral balance.
            </p>
          </div>
          <img
            src="/images/Free_Photo___Happy_mixed_race_friendly_people_embrace_each_other-removebg-preview 1.png"
            alt="Refer & Earn"
            className="w-40"
          />
        </div>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div className="bg-white rounded-xl p-5 border border-zinc-100">
          <div className="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
            <Users className="w-6 h-6 text-blue-600" />
          </div>
          <p className="text-2xl font-bold text-zinc-800">{loading ? "..." : count}</p>
          <p className="text-sm text-zinc-500">Total Referrals</p>
        </div>
        <div className="bg-white rounded-xl p-5 border border-zinc-100">
          <div className="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-3">
            <DollarSign className="w-6 h-6 text-green-600" />
          </div>
          <p className="text-2xl font-bold text-zinc-800">₦{loading ? "..." : Number(total).toLocaleString()}</p>
          <p className="text-sm text-zinc-500">Total Earnings</p>
        </div>
        <div className="bg-white rounded-xl p-5 border border-zinc-100">
          <div className="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
            <Clock className="w-6 h-6 text-amber-600" />
          </div>
          <p className="text-2xl font-bold text-amber-600">₦{loading ? "..." : Number(pending).toLocaleString()}</p>
          <p className="text-sm text-zinc-500">Pending</p>
        </div>
        <div className="bg-white rounded-xl p-5 border border-zinc-100">
          <div className="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-3">
            <CheckCircle className="w-6 h-6 text-emerald-600" />
          </div>
          <p className="text-2xl font-bold text-emerald-600">₦{loading ? "..." : Number(completed).toLocaleString()}</p>
          <p className="text-sm text-zinc-500">Completed</p>
        </div>
      </div>

      {/* Referral Link Card */}
      <div className="bg-white rounded-xl p-6 border border-zinc-100">
        <h3 className="font-semibold text-zinc-800 mb-4">Your Referral Link</h3>
        <div className="flex flex-col md:flex-row gap-4 items-center">
          <div className="flex-1 bg-zinc-50 rounded-lg px-4 py-3 border border-zinc-200 w-full overflow-hidden">
            <p className="text-sm text-zinc-600 truncate font-mono">{refLink}</p>
          </div>
          <button
            onClick={copyRefLink}
            className="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition-colors whitespace-nowrap"
          >
            <Copy className="w-4 h-4" />
            Copy Link
          </button>
          <button className="flex items-center gap-2 px-6 py-3 bg-zinc-800 text-white rounded-lg font-medium hover:bg-zinc-700 transition-colors whitespace-nowrap">
            <Share2 className="w-4 h-4" />
            Share
          </button>
        </div>
      </div>

      {/* How It Works */}
      <div className="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
        <h3 className="font-semibold text-zinc-800 mb-6 text-center">How It Works</h3>
        <div className="grid md:grid-cols-3 gap-6">
          {[
            { step: "1", title: "Copy Link", desc: "Copy your unique referral link above" },
            { step: "2", title: "Share", desc: "Share via social media, email, or messaging apps" },
            { step: "3", title: "Earn ₦500", desc: "Get rewarded when they sign up and complete action" },
          ].map((item) => (
            <div key={item.step} className="text-center">
              <div className="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                {item.step}
              </div>
              <h4 className="font-semibold text-zinc-800 mb-2">{item.title}</h4>
              <p className="text-sm text-zinc-500">{item.desc}</p>
            </div>
          ))}
        </div>
      </div>

      {/* Referred Users */}
      <div className="bg-white rounded-xl p-6 border border-zinc-100">
        <h3 className="font-semibold text-zinc-800 mb-4">Referred Users</h3>
        
        {loading ? (
          <div className="text-center py-8 text-zinc-500">Loading...</div>
        ) : referred.length > 0 ? (
          <div className="space-y-3">
            {referred.map((item) => (
              <div key={item.id} className="flex items-center justify-between p-4 bg-zinc-50 rounded-xl">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                    <Users className="w-5 h-5 text-primary" />
                  </div>
                  <div>
                    <p className="font-medium text-zinc-800">
                      {item.referee?.fname} {item.referee?.lname}
                    </p>
                    <p className="text-xs text-zinc-500">
                      {item.created_at ? new Date(item.created_at).toLocaleDateString() : "N/A"}
                    </p>
                  </div>
                </div>
                <div className="text-right">
                  <p className={cn(
                    "font-semibold",
                    item.status === "completed" ? "text-green-600" : "text-amber-600"
                  )}>
                    ₦{Number(item.amount).toLocaleString()}
                  </p>
                  <p className="text-xs text-zinc-500 capitalize">{item.status}</p>
                </div>
              </div>
            ))}
          </div>
        ) : (
          <div className="text-center py-8">
            <div className="w-16 h-16 bg-zinc-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <Users className="w-8 h-8 text-zinc-400" />
            </div>
            <h4 className="font-medium text-zinc-800 mb-2">No Referrals Yet</h4>
            <p className="text-sm text-zinc-500">Start sharing your referral link to earn rewards!</p>
          </div>
        )}
      </div>
    </div>
  );
}
