import { useLocation } from "react-router";
import { ArrowLeft, ArrowRight, CheckCircle, Zap, Globe, Users } from "lucide-react";
import { Link } from "react-router";
import AdvertRequestForm from "./components/AdvertRequestForm";

export default function PostAdvertPage() {
  const query = new URLSearchParams(useLocation().search);
  const platform = query.get("platform") || "";
  const engagementType = query.get("engagementType");
  const type = query.get("type") || "advert";

  const isEngagement = type === "engagement";

  // Engagement campaign data
  const engagementCampaigns: Record<string, { title: string; description: string; payment: number }> = {
    "Get Real People to Like your Social Media Post": {
      title: "Social Media Likes Campaign",
      description: "Engage real users to like your post and boost its visibility organically.",
      payment: 5,
    },
    "Get Real People to Follow you": {
      title: "Follower Growth Campaign",
      description: "Increase your social following with genuine and verified users.",
      payment: 10,
    },
    "Get Real People to Comment to your Social Media Post": {
      title: "Post Comments Campaign",
      description: "Encourage authentic comments to increase engagement and trust.",
      payment: 10,
    },
    "Get Real People to Subscribe to your Channel": {
      title: "Channel Subscription Campaign",
      description: "Get more subscribers who are interested in your content.",
      payment: 15,
    },
  };

  const selected = engagementType ? engagementCampaigns[engagementType] : null;

  // Steps for the wizard
  const steps = [
    { number: 1, label: "Select Type", icon: <Zap className="w-5 h-5" /> },
    { number: 2, label: "Configure", icon: <Globe className="w-5 h-5" /> },
    { number: 3, label: "Targeting", icon: <Users className="w-5 h-5" /> },
    { number: 4, label: "Review & Pay", icon: <CheckCircle className="w-5 h-5" /> },
  ];

  return (
    <div className="space-y-6">
      {/* Header with Back Button */}
      <div className="flex items-center gap-4">
        <Link
          to="/advertise"
          className="w-10 h-10 bg-white border border-zinc-200 rounded-lg flex items-center justify-center hover:border-primary/30 transition-colors"
        >
          <ArrowLeft className="w-5 h-5 text-zinc-600" />
        </Link>
        <div>
          <h1 className="text-xl font-bold text-zinc-800">
            {isEngagement 
              ? (selected ? `Create ${selected.title}` : "Create Engagement Campaign")
              : (platform ? `Create ${platform} Advert` : "Create New Campaign")
            }
          </h1>
          <p className="text-sm text-zinc-500">
            {isEngagement
              ? selected
                ? selected.description
                : "Boost engagement on your social media posts"
              : `Promote your business on ${platform || "social media"}`
            }
          </p>
        </div>
      </div>

      {/* Progress Steps */}
      <div className="bg-white rounded-xl p-4 border border-zinc-100">
        <div className="flex items-center justify-between">
          {steps.map((step, index) => (
            <div key={step.number} className="flex items-center">
              <div className="flex items-center gap-2">
                <div className={`
                  w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium
                  ${index === 0 ? "bg-primary text-white" : "bg-zinc-100 text-zinc-500"}
                `}>
                  {step.number}
                </div>
                <span className={`text-sm hidden sm:block ${index === 0 ? "text-primary font-medium" : "text-zinc-500"}`}>
                  {step.label}
                </span>
              </div>
              {index < steps.length - 1 && (
                <div className="w-8 sm:w-16 h-0.5 bg-zinc-200 mx-2 hidden sm:block" />
              )}
            </div>
          ))}
        </div>
      </div>

      {/* Campaign Type Info Banner */}
      {isEngagement && engagementType && (
        <div className="bg-gradient-to-r from-primary/10 to-blue-50 border border-primary/20 rounded-xl p-4">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center">
              <Zap className="w-5 h-5 text-primary" />
            </div>
            <div>
              <h3 className="font-semibold text-zinc-800">{engagementType}</h3>
              <p className="text-sm text-zinc-600">
                Starting from ₦{engagementCampaigns[engagementType]?.payment || 0} per engagement
              </p>
            </div>
            <Link
              to="/advertise/engagement-tasks"
              className="ml-auto text-sm text-primary hover:underline"
            >
              View Options
            </Link>
          </div>
        </div>
      )}

      {/* Platform Selection (if not already selected) */}
      {!platform && !isEngagement && (
        <div className="bg-white rounded-xl p-6 border border-zinc-100">
          <h2 className="text-lg font-semibold text-zinc-800 mb-4">Choose Your Platform</h2>
          <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
            {[
              { name: "WhatsApp", icon: "📱", key: "whatsapp" },
              { name: "Instagram", icon: "📸", key: "instagram" },
              { name: "Facebook", icon: "👥", key: "facebook" },
              { name: "X/Twitter", icon: "🐦", key: "x" },
              { name: "TikTok", icon: "🎵", key: "tiktok" },
            ].map((p) => (
              <Link
                key={p.key}
                to={`/advertise/post-advert?platform=${p.key}`}
                className="flex flex-col items-center gap-2 p-4 rounded-xl border border-zinc-200 hover:border-primary/50 hover:bg-primary/5 transition-all group"
              >
                <span className="text-3xl">{p.icon}</span>
                <span className="text-sm font-medium text-zinc-700 group-hover:text-primary">{p.name}</span>
              </Link>
            ))}
          </div>
        </div>
      )}

      {/* Advert Request Form */}
      {(platform || isEngagement) && (
        <div className="bg-white rounded-xl border border-zinc-100 overflow-hidden">
          <AdvertRequestForm platform={platform || "engagement"} />
        </div>
      )}

      {/* Help Section */}
      <div className="bg-zinc-50 rounded-xl p-4 border border-zinc-100">
        <h4 className="font-medium text-zinc-800 mb-2">Need Help?</h4>
        <p className="text-sm text-zinc-600 mb-3">
          Creating your first campaign? Here's a quick guide:
        </p>
        <ul className="text-sm text-zinc-600 space-y-1">
          <li className="flex items-center gap-2">
            <ArrowRight className="w-4 h-4 text-primary" />
            Choose a platform where your target audience is most active
          </li>
          <li className="flex items-center gap-2">
            <ArrowRight className="w-4 h-4 text-primary" />
            Set your budget based on how many engagements you want
          </li>
          <li className="flex items-center gap-2">
            <ArrowRight className="w-4 h-4 text-primary" />
            Define your target audience by location, gender, and interests
          </li>
        </ul>
      </div>
    </div>
  );
}
