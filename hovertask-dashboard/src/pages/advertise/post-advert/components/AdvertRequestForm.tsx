import { useDisclosure } from "@heroui/react";
import { useEffect, useRef, useState, useMemo } from "react";
import { useForm } from "react-hook-form";
import Input from "../../../../shared/components/Input";
import {
  Church,
  Globe,
  Hash,
  LinkIcon,
  Speaker,
  User,
  DollarSign,
  Users,
  X,
  CheckCircle,
  ArrowRight,
  Target,
  Wallet,
  FileText,
  Image as ImageIcon,
  Video
} from "lucide-react";
import CustomSelect from "../../../../shared/components/Select";
import {
  genders,
  religions,
  socialMedia,
  states,
} from "../../../../utils/selectAndAutocompletOptions";
import ImageInput from "../../../../shared/components/ImageInput";
import AdvertSummaryModal from "./AdvertSummaryModal";
import AdvertUploadSuccessModal from "./AdvertUploadSuccessModal";
import Loading from "../../../../shared/components/Loading";
import {
  descriptionValidation,
  urlValidation,
} from "../../../../utils/inputValidationPatterns";
import Label from "./Label";
import SetPaymentMethod from "./SetPaymentMethod";
import { Modal, ModalContent, ModalHeader, ModalBody } from "@heroui/react";
import { Button } from "@heroui/react";
import cn from "../../../../utils/cn";


const platformConfig: Record<
  string,
  {
    illustrativeTitle: string;
    inputLabel: string;
    inputDescription: string;
    registerKey: string;
    paymentPerAdvert: number;
  }
> = {
  whatsapp: {
    illustrativeTitle: "Promote Brands on Your WhatsApp ",
    inputLabel: "Select Number of WhatsApp  Post",
    inputDescription:
      "Earn by posting sponsored content on your WhatsApp status. Choose how many posts you want to share.",
    registerKey: "no_of_status_post",
    paymentPerAdvert: 100,
  },
  instagram: {
    illustrativeTitle: "Earn by Posting Brand Stories on Instagram",
    inputLabel: "Select Number of Instagram Story Posts",
    inputDescription:
      "Share brand adverts on your Instagram story and get paid per post.",
    registerKey: "no_of_status_post",
    paymentPerAdvert: 150,
  },
  facebook: {
    illustrativeTitle: "Help Businesses Grow on Facebook",
    inputLabel: "Select Number of Facebook Timeline Posts",
    inputDescription:
      "Promote business adverts on your Facebook timeline and earn rewards for each post.",
    registerKey: "no_of_status_post",
    paymentPerAdvert: 150,
  },
  x: {
    illustrativeTitle: "Post Sponsored Tweets and Get Paid",
    inputLabel: "Select Number of X (Twitter) Posts",
    inputDescription:
      "Support brands by tweeting their adverts on your X (Twitter) profile. Earn per post.",
    registerKey: "no_of_status_post",
    paymentPerAdvert: 150,
  },
  tiktok: {
    illustrativeTitle: "Create TikTok Videos for Brand Promotions",
    inputLabel: "Select Number of TikTok Videos",
    inputDescription:
      "Promote products or brands with short TikTok videos and earn money for each video you post.",
    registerKey: "no_of_status_post",
    paymentPerAdvert: 150,
  },
};

type AdvertRequestFormProps = {
  platform?: string;
};

export default function AdvertRequestForm({ platform }: AdvertRequestFormProps) {
  const formRef = useRef<HTMLFormElement>(null);
  const successModalProps = useDisclosure();
  const modalProps = useDisclosure();
  const [pendingAdvert, setPendingAdvert] = useState<{
    id: number;
    user_id: number;
    type: string;
  } | null>(null);

  // 💰 Payment Summary Feature State
  const [showSummary, setShowSummary] = useState(false);
  const [currentStep, setCurrentStep] = useState(1);

  const isEngagementTask =
    new URLSearchParams(window.location.search).get("type") === "engagement";

  const engagementType = new URLSearchParams(window.location.search).get(
    "engagementType"
  );

  const [selectedPlatform, setSelectedPlatform] = useState<string>(
    platform || ""
  );

  const {
    register,
    getValues,
    trigger,
    clearErrors,
    formState: { errors, isValid, isSubmitting },
    setValue,
    watch,
    setError,
  } = useForm();

  useEffect(() => {
    if (isValid) clearErrors();
  }, [isValid, clearErrors]);

  useEffect(() => {
    if (platform) {
      setValue("platforms", platform, { shouldValidate: true });
      setSelectedPlatform(platform);

      const config = platformConfig[platform.toLowerCase()];
      if (config) {
        setValue("payment_per_task", config.paymentPerAdvert);
        setValue("title", config.illustrativeTitle);
      }
    }
  }, [platform, setValue]);

  const config = selectedPlatform
    ? platformConfig[selectedPlatform.toLowerCase()]
    : null;

  const participants = watch("number_of_participants") || 0;
  const paymentPerTask = watch("payment_per_task") || 0;
  const noOfPosts = config ? watch(config.registerKey) || 0 : 0;

  useEffect(() => {
    let cost = 0;
    if (isEngagementTask) cost = Number(participants) * Number(paymentPerTask);
    else cost = Number(noOfPosts) * Number(paymentPerTask);

    setValue("estimated_cost", cost, { shouldValidate: true });
  }, [participants, paymentPerTask, noOfPosts, isEngagementTask, setValue]);



  // ✅ Auto-fill engagement templates (title, description, payment)
  useEffect(() => {
    if (isEngagementTask && engagementType) {
      const templates: Record<
        string,
        { title: string; description: string; payment: number }
      > = {
        "Get Real People to Like your Social Media Post": {
          title: "Like peoples Social Media Post",
          description:
            "Engage real users to like your post and boost its visibility organically.",
          payment: 5,
        },
        "Get Real People to Follow you": {
          title: "Follow peoples Social Media Account",
          description:
            "Increase your social following with genuine and verified users.",
          payment: 10,
        },
        "Get Real People to Comment to your Social Media Post": {
          title: "Post Comments on peoples Social Media Post",
          description:
            "Encourage authentic comments to increase engagement and trust.",
          payment: 10,
        },
        "Get Real People to Subscribe to your Channel": {
          title: "Subscribe to peoples Channel",
          description:
            "Get more subscribers who are interested in your content.",
          payment: 15,
        },
      };

      const selected = templates[engagementType];
      if (selected) {
        setValue("title", selected.title);
        setValue("description", selected.description);
        setValue("payment_per_task", selected.payment);
      }
    }
  }, [isEngagementTask, engagementType, setValue]);

  // ✅ Auto-set deadline for engagement tasks (30 days ahead)
  useEffect(() => {
    if (isEngagementTask) {
      const today = new Date();
      const futureDate = new Date(today);
      futureDate.setDate(today.getDate() + 30);
      const formattedDate = futureDate.toISOString().split("T")[0];
      setValue("deadline", formattedDate);
    }
  }, [isEngagementTask, setValue]);


  /* ------------------------------- 👇 FIXED NEW LOGIC ------------------------------- */

  // ✅ Mapping of engagement types → allowed social platforms
  const engagementPlatformMap: Record<string, string[]> = {
    "Get Real People to Like your Social Media Post": [
      "Instagram",
      "Facebook",
      "X",
      "TikTok",
    ],
    "Get Real People to Follow you": ["Instagram", "X", "TikTok"],
    "Get Real People to Comment to your Social Media Post": [
      "Instagram",
      "Facebook",
      "X",
    ],
    "Get Real People to Subscribe to your Channel": ["YouTube"],
  };

  // ✅ Normalize helper for consistent string comparison
  const normalize = (s: unknown): string =>
    String(s ?? "")
      .trim()
      .toLowerCase()
      .replace(/[^a-z0-9]/gi, "");


  // ✅ Force all socialMedia items to match { key, label, value } shape
  type Option = { key: string; label: string; value: string };

  // ✅ Ensure the base list has uniform Option type
  const normalizedSocialMedia: Option[] = (socialMedia as any[]).map((opt) => {
    if (typeof opt === "string") {
      return { key: opt.toLowerCase(), label: opt, value: opt };
    }
    return {
      key: opt.key || opt.value || opt.label,
      label: opt.label || opt.value || opt.key,
      value: opt.value || opt.label || opt.key,
    };
  });

  // ✅ Filter social media options based on engagement type
  const filteredSocialMedia: Option[] = useMemo(() => {
    if (!isEngagementTask || !engagementType) return normalizedSocialMedia;

    const allowed = engagementPlatformMap[engagementType] ?? [];
    if (!allowed.length) return normalizedSocialMedia;

    const allowedNorm = allowed.map(normalize);

    return normalizedSocialMedia.filter((opt) =>
      allowedNorm.includes(normalize(opt.value))
    );
  }, [isEngagementTask, engagementType]); // ✅ cleaned dependency list

  // ✅ Auto-select platform if only one option remains
  useEffect(() => {
    if (!isEngagementTask) return;
    if (!filteredSocialMedia || filteredSocialMedia.length !== 1) return;

    const first = filteredSocialMedia[0];
    setValue("platforms", first.value, { shouldValidate: true });
    setSelectedPlatform(first.value);
  }, [filteredSocialMedia, isEngagementTask, setValue]);

  // ✅ Clear platform if current selection no longer allowed
  useEffect(() => {
    if (!isEngagementTask) return;

    const current = getValues("platforms");
    const allowed = engagementPlatformMap[engagementType ?? ""] ?? [];

    if (
      current &&
      allowed.length &&
      !allowed.map(normalize).includes(normalize(current))
    ) {
      setValue("platforms", "", { shouldValidate: true });
      setSelectedPlatform("");
    }
  }, [engagementType, isEngagementTask, getValues, setValue]);

  /* --------------------------------------------------------------------------- */


  const totalCost =
    (isEngagementTask ? participants : noOfPosts) * (paymentPerTask || 0);

  // Form sections
  const formSteps = [
    { number: 1, label: "Campaign Details", icon: FileText },
    { number: 2, label: "Budget & Pricing", icon: DollarSign },
    { number: 3, label: "Target Audience", icon: Target },
    { number: 4, label: "Media & Content", icon: ImageIcon },
  ];

  return (
    <>
      {/* Step Indicator */}
      <div className="bg-white rounded-xl p-4 border border-zinc-100 mb-6">
        <div className="flex items-center justify-between">
          {formSteps.map((step, index) => {
            const Icon = step.icon;
            const isActive = currentStep === step.number;
            const isCompleted = currentStep > step.number;
            
            return (
              <div key={step.number} className="flex items-center">
                <button
                  type="button"
                  onClick={() => setCurrentStep(step.number)}
                  className={cn(
                    "flex items-center gap-2 px-3 py-2 rounded-lg transition-all",
                    isActive && "bg-primary text-white",
                    isCompleted && "bg-green-100 text-green-700",
                    !isActive && !isCompleted && "text-zinc-500 hover:bg-zinc-100"
                  )}
                >
                  {isCompleted ? (
                    <CheckCircle className="w-4 h-4" />
                  ) : (
                    <Icon className="w-4 h-4" />
                  )}
                  <span className="text-sm font-medium hidden sm:block">{step.label}</span>
                </button>
                {index < formSteps.length - 1 && (
                  <div className={cn(
                    "w-8 sm:w-16 h-0.5 mx-1",
                    isCompleted ? "bg-green-500" : "bg-zinc-200"
                  )} />
                )}
              </div>
            );
          })}
        </div>
      </div>

      <form id="advert-form" className="space-y-6" ref={formRef}>
        
        {/* STEP 1: Campaign Details */}
        {currentStep === 1 && (
          <div className="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-300">
            {/* Engagement Header */}
            {isEngagementTask && engagementType && (
              <div className="bg-gradient-to-r from-primary/10 to-blue-50 border border-primary/20 rounded-xl p-4">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center">
                    <Users className="w-5 h-5 text-primary" />
                  </div>
                  <div>
                    <p className="text-sm text-zinc-500">Creating</p>
                    <h3 className="font-semibold text-zinc-800">{engagementType}</h3>
                  </div>
                </div>
              </div>
            )}

            {/* Platform Selection */}
            <div className="bg-white rounded-xl p-6 border border-zinc-100">
              <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                <Globe className="w-5 h-5 text-primary" />
                Select Platform
              </h3>
              
              {!isEngagementTask ? (
                <CustomSelect
                  options={
                    platform
                      ? [{ key: platform.toLowerCase(), label: platform }]
                      : socialMedia
                  }
                  aria-label="Selected Platform"
                  label={
                    <Label
                      title={platform ? "Selected Platform" : "Choose Platform"}
                      description="Choose the platform where you'd like to advertise."
                    />
                  }
                  placeholder="Select platform"
                  className="max-w-md"
                  startContent={<Globe />}
                  defaultSelectedKeys={platform ? [platform.toLowerCase()] : []}
                  onChange={(value) => {
                    const platformValue = Array.isArray(value) ? value[0] : value;
                    setSelectedPlatform(platformValue);
                    setValue("platforms", platformValue, { shouldValidate: true });
                  }}
                  errorMessage={errors.platforms?.message as string}
                />
              ) : (
                <div>
                  <CustomSelect
                    options={filteredSocialMedia}
                    aria-label="Select Platform"
                    label={
                      <Label
                        title="Select Platform"
                        description="Choose the platform where you'd like to create engagement."
                      />
                    }
                    placeholder="Select platform"
                    className="max-w-md"
                    startContent={<Globe />}
                    onChange={(value) =>
                      setValue("platforms", value, { shouldValidate: true })
                    }
                    errorMessage={errors.platforms?.message as string}
                  />
                  {engagementType && (
                    <p className="mt-2 text-xs text-zinc-500">
                      Available: {(engagementPlatformMap[engagementType] ?? []).join(", ")}
                    </p>
                  )}
                </div>
              )}
              <input
                type="hidden"
                {...register("platforms", { required: "Platform is required" })}
              />
            </div>

            {/* Number of Posts/Participants */}
            <div className="bg-white rounded-xl p-6 border border-zinc-100">
              <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                {isEngagementTask ? <Users className="w-5 h-5 text-primary" /> : <Hash className="w-5 h-5 text-primary" />}
                {isEngagementTask ? "Number of Participants" : "Number of Posts"}
              </h3>
              
              {!isEngagementTask && config ? (
                <Input
                  className="max-w-xs"
                  label={
                    <Label
                      title={config.inputLabel}
                      description={config.inputDescription}
                    />
                  }
                  icon={<Hash size={16} />}
                  placeholder="0"
                  {...register(config.registerKey, {
                    required: `Enter the number of ${selectedPlatform} posts`,
                    pattern: { value: /^\d+$/, message: "Enter a valid number" },
                  })}
                  errorMessage={errors[config.registerKey]?.message as string}
                />
              ) : (
                <Input
                  className="max-w-xs"
                  label={
                    <Label
                      title="Number of Participants"
                      description="How many people should engage with this task?"
                    />
                  }
                  icon={<Users size={16} />}
                  placeholder="0"
                  {...register("number_of_participants", {
                    required: "Enter number of participants",
                    pattern: { value: /^\d+$/, message: "Enter a valid number" },
                  })}
                  errorMessage={errors.number_of_participants?.message as string}
                />
              )}
            </div>

            {/* Social Media URL for Engagement */}
            {isEngagementTask && (
              <div className="bg-white rounded-xl p-6 border border-zinc-100">
                <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                  <LinkIcon className="w-5 h-5 text-primary" />
                  Your Content Link
                </h3>
                <Input
                  label={
                    <Label
                      title="Your Social Media Post Link"
                      description="Provide the link to your post for tracking and verification."
                    />
                  }
                  icon={<LinkIcon size={16} />}
                  placeholder="https://..."
                  type="url"
                  {...register("social_media_url", {
                    required: "Enter your post link",
                    pattern: urlValidation,
                  })}
                  errorMessage={errors.social_media_url?.message as string}
                />
              </div>
            )}

            {/* Description */}
            {config && (
              <div className="bg-white rounded-xl p-6 border border-zinc-100">
                <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                  <FileText className="w-5 h-5 text-primary" />
                  Advert Content
                </h3>
                <div className="space-y-2">
                  <Label
                    title={
                      isEngagementTask &&
                      engagementType === "Get Real People to Comment to your Social Media Post"
                        ? "Comment Instructions"
                        : "Advert Caption"
                    }
                    description={
                      isEngagementTask &&
                      engagementType === "Get Real People to Comment to your Social Media Post"
                        ? "Provide clear instructions for comments"
                        : "Write the text or caption for your advert"
                    }
                  />
                  <textarea
                    {...register("description", {
                      required: "Enter task description.",
                      pattern: descriptionValidation,
                      minLength: { value: 20, message: "Description is too short." },
                    })}
                    className="w-full h-32 bg-white border border-zinc-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all resize-none"
                    placeholder="Enter your advert description..."
                  />
                  {errors.description && (
                    <small className="text-danger">{errors.description.message as string}</small>
                  )}
                </div>
              </div>
            )}

            <input type="hidden" {...register("title", { required: "title is required" })} />
          </div>
        )}

        {/* STEP 2: Budget & Pricing */}
        {currentStep === 2 && (
          <div className="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-300">
            {/* Hidden inputs for form */}
            <Input className="hidden" icon={<DollarSign size={16} />} placeholder="0" {...register("payment_per_task", { required: true })} />
            <Input className="hidden" value={totalCost} readOnly {...register("estimated_cost", { required: true })} />
            {isEngagementTask && <input type="hidden" {...register("deadline", { required: true })} />}
            <input type="hidden" value={isEngagementTask ? "engagement" : "advert"} {...register("type")} />
            <input type="hidden" value="social_media" {...register("category")} />

            {/* Payment Summary Card */}
            <div className="bg-gradient-to-br from-primary/5 to-blue-50 rounded-xl p-6 border border-primary/20">
              <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                <Wallet className="w-5 h-5 text-primary" />
                Budget Summary
              </h3>
              
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div className="bg-white rounded-xl p-4 border border-zinc-100">
                  <p className="text-sm text-zinc-500 mb-1">
                    {isEngagementTask ? "Participants" : "Number of Posts"}
                  </p>
                  <p className="text-2xl font-bold text-zinc-800">
                    {isEngagementTask ? (participants || 0) : (noOfPosts || 0)}
                  </p>
                </div>
                
                <div className="bg-white rounded-xl p-4 border border-zinc-100">
                  <p className="text-sm text-zinc-500 mb-1">Pay Per Task</p>
                  <p className="text-2xl font-bold text-zinc-800">
                    ₦{Number(paymentPerTask || 0).toLocaleString()}
                  </p>
                </div>
                
                <div className="bg-primary rounded-xl p-4 text-white">
                  <p className="text-sm text-blue-100 mb-1">Total Budget</p>
                  <p className="text-2xl font-bold">
                    ₦{totalCost.toLocaleString()}
                  </p>
                </div>
              </div>

              <p className="text-xs text-zinc-500 mt-4 text-center">
                {isEngagementTask 
                  ? "Participants × Pay per Task = Total Budget"
                  : "Number of Posts × Pay per Post = Total Budget"
                }
              </p>
            </div>

            {/* Pricing Info */}
            <div className="bg-white rounded-xl p-6 border border-zinc-100">
              <h4 className="font-medium text-zinc-800 mb-3">Pricing Tiers</h4>
              <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                {[
                  { platform: "WhatsApp", price: "₦100" },
                  { platform: "Instagram", price: "₦150" },
                  { platform: "Facebook", price: "₦150" },
                  { platform: "Twitter/X", price: "₦150" },
                  { platform: "TikTok", price: "₦150" },
                ].map((tier) => (
                  <div key={tier.platform} className="bg-zinc-50 rounded-lg p-3 text-center">
                    <p className="text-xs text-zinc-500">{tier.platform}</p>
                    <p className="font-semibold text-zinc-800">{tier.price}</p>
                    <p className="text-[10px] text-zinc-400">per post</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        {/* STEP 3: Target Audience */}
        {currentStep === 3 && (
          <div className="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-300">
            <div className="bg-white rounded-xl p-6 border border-zinc-100">
              <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                <Target className="w-5 h-5 text-primary" />
                Target Your Audience
              </h3>
              
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                {/* Gender */}
                <div>
                  <CustomSelect
                    options={genders}
                    label={
                      <Label
                        title="Gender"
                        description="Target gender preference"
                      />
                    }
                    placeholder="Any gender"
                    startContent={<User />}
                    onChange={(value) =>
                      setValue("gender", value, { shouldValidate: true })
                    }
                    errorMessage={errors.gender?.message as string}
                  />
                  <input
                    type="hidden"
                    {...register("gender", { required: "Gender is required" })}
                  />
                </div>

                {/* Location */}
                <div>
                  <CustomSelect
                    options={states}
                    label={
                      <Label
                        title="Location"
                        description="Target locations"
                      />
                    }
                    placeholder="All locations"
                    selectionMode="multiple"
                    onChange={(value) =>
                      setValue("location", value, { shouldValidate: true })
                    }
                    errorMessage={errors.location?.message as string}
                  />
                  <input
                    type="hidden"
                    {...register("location", { required: "Location is required" })}
                  />
                </div>

                {/* Religion */}
                <div>
                  <CustomSelect
                    options={religions}
                    label={
                      <Label
                        title="Religion"
                        description="Target religion (optional)"
                      />
                    }
                    placeholder="Any religion"
                    startContent={<Church />}
                    selectionMode="multiple"
                    onChange={(value) =>
                      setValue("religion", value, { shouldValidate: true })
                    }
                    errorMessage={errors.religion?.message as string}
                  />
                  <input
                    type="hidden"
                    {...register("religion")}
                  />
                </div>
              </div>
            </div>

            {/* Audience Tips */}
            <div className="bg-blue-50 border border-blue-100 rounded-xl p-4">
              <h4 className="font-medium text-blue-800 mb-2">💡 Tips for Better Results</h4>
              <ul className="text-sm text-blue-700 space-y-1">
                <li>• Target specific locations for local businesses</li>
                <li>• Consider gender for products targeted to specific audiences</li>
                <li>• Leave religion unselected to reach everyone</li>
              </ul>
            </div>
          </div>
        )}

        {/* STEP 4: Media & Content */}
        {currentStep === 4 && (
          <div className="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-300">
            {!isEngagementTask && config && (
              <div className="bg-white rounded-xl p-6 border border-zinc-100">
                <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                  <ImageIcon className="w-5 h-5 text-primary" />
                  Upload Media
                </h3>
                
                <div className="flex flex-col sm:flex-row gap-4 items-start">
                  <div className="flex flex-col gap-2">
                    <label className="flex items-center gap-2 px-4 py-2 rounded-lg bg-primary/10 border border-primary text-primary cursor-pointer hover:bg-primary/20 transition">
                      <Video className="w-4 h-4" />
                      Upload Video
                      <input type="file" accept="video/*" className="hidden" />
                    </label>
                    <label className="flex items-center gap-2 px-4 py-2 rounded-lg bg-primary/10 border border-primary text-primary cursor-pointer hover:bg-primary/20 transition">
                      <ImageIcon className="w-4 h-4" />
                      Upload Images
                      <input type="file" accept="image/*" multiple className="hidden" />
                    </label>
                    <p className="text-xs text-zinc-500">Max 20MB per file</p>
                  </div>
                  
                  <div className="flex-1 max-w-xs">
                    <ImageInput id="media" maxLength={3} />
                  </div>
                </div>
              </div>
            )}

            {/* Review & Submit */}
            <div className="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
              <h3 className="text-lg font-semibold text-zinc-800 mb-4 flex items-center gap-2">
                <CheckCircle className="w-5 h-5 text-green-600" />
                Review Your Campaign
              </h3>
              
              <div className="bg-white rounded-xl p-4 border border-zinc-100 space-y-2">
                <div className="flex justify-between text-sm">
                  <span className="text-zinc-500">Platform:</span>
                  <span className="font-medium capitalize">{selectedPlatform || "Not selected"}</span>
                </div>
                <div className="flex justify-between text-sm">
                  <span className="text-zinc-500">{isEngagementTask ? "Participants" : "Posts"}:</span>
                  <span className="font-medium">{isEngagementTask ? (participants || 0) : (noOfPosts || 0)}</span>
                </div>
                <div className="flex justify-between text-sm">
                  <span className="text-zinc-500">Pay per Task:</span>
                  <span className="font-medium">₦{Number(paymentPerTask || 0).toLocaleString()}</span>
                </div>
                <hr className="border-dashed my-2" />
                <div className="flex justify-between">
                  <span className="text-zinc-800 font-medium">Total Budget:</span>
                  <span className="text-primary font-bold text-lg">₦{totalCost.toLocaleString()}</span>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* Navigation Buttons */}
        <div className="flex justify-between pt-4">
          {currentStep > 1 ? (
            <Button
              type="button"
              variant="bordered"
              onPress={() => setCurrentStep(currentStep - 1)}
              className="border-zinc-300"
            >
              Back
            </Button>
          ) : (
            <div />
          )}
          
          {currentStep < 4 ? (
            <Button
              type="button"
              onPress={() => setCurrentStep(currentStep + 1)}
              className="bg-primary text-white"
            >
              Continue <ArrowRight className="w-4 h-4 ml-2" />
            </Button>
          ) : (
            <div className="pb-12">
              <SetPaymentMethod
                onAdvertPreviewOpen={modalProps.onOpen}
                isFormValid={isValid}
                triggerValidationFn={trigger}
                estimatedCost={watch("estimated_cost") || 0}
              />
            </div>
          )}
        </div>

        {/* Modals */}
        {isValid && (
          <AdvertSummaryModal
            modalProps={modalProps}
            getFormValue={getValues}
            successModalProps={successModalProps}
            setError={setError}
            setPendingAdvert={setPendingAdvert}
          />
        )}
        <AdvertUploadSuccessModal
          {...successModalProps}
          pendingAdvert={pendingAdvert}
        />
      </form>

      {isSubmitting && <Loading fixed />}
    </>
  );
}
