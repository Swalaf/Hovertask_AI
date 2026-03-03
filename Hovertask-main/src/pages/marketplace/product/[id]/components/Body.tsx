import { ReactNode, useEffect, useRef, useState } from "react";
import { BsArrowLeft } from "react-icons/bs";
import { CiShare2 } from "react-icons/ci";
import { GiRoundStar } from "react-icons/gi";
import { GoEye, GoLocation } from "react-icons/go";
import { IoHeartOutline } from "react-icons/io5";
import { TfiAngleLeft, TfiAngleRight } from "react-icons/tfi";
import { Link, useLocation, useParams } from "react-router-dom";
import { toast } from "sonner";

/** ---------------------------------------------------------
 * PRODUCT CACHE (Lightweight + Stale-While-Revalidate)
 * --------------------------------------------------------*/
const productCache = new Map<string, { ts: number; data: ProductApiResponse }>();
const STALE_MS = 1000 * 60 * 2; // 2 minutes cache validity

/** ---------------------------------------------------------
 * TYPES
 * --------------------------------------------------------*/
export interface ProductImage {
  id: number;
  product_id: number;
  file_path: string | null;
  video_path: string | null;
  media_type: string | null;
  public_id: string | null;
  created_at?: string;
  updated_at?: string;
}

export interface ProductApiResponse {
  id?: number;
  user_id: number;
  category_id: number;
  name: string;
  description: string;
  price: string;
  stock: number;
  images: string | null;
  status: string;
  location: string | null;
  currency: string;
  discount: string;
  payment_method: string;
  meet_up_preference: string | null;
  delivery_fee: string;
  estimated_delivery_date: string;
  phone_number: string;
  email: string;
  social_media_link: string;
  video_path: string | null;
  resell_budget: string | null;
  product_images: ProductImage[];
  created_at?: string;
  updated_at?: string;
  views?: number;
}

/** ---------------------------------------------------------
 * EXTRACT VALID FILE PATH IMAGES FROM API
 * --------------------------------------------------------*/
const productImagesFromAPI = (p: ProductApiResponse) =>
  (p.product_images || [])
    .map((img) => img.file_path)
    .filter(Boolean) as string[];

// READ reseller CODE FROM URL
const resellerCodeFromURL = new URLSearchParams(window.location.search).get("reseller");

/** ---------------------------------------------------------
 * MAIN COMPONENT
 * --------------------------------------------------------*/
const SingleProductBody = () => {
  const { id } = useParams<{ id: string }>();
  const location = useLocation();

  const [product, setProduct] = useState<ProductApiResponse | null>(null);
  const [loading, setLoading] = useState<boolean>(true);
  const [loadingContact, setLoadingContact] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  const abortContactRef = useRef<AbortController | null>(null);

  /** ---------------------------------------------------------
   * CONTACT SELLER — FULLY OPTIMIZED
   * --------------------------------------------------------*/
 const handleContactSeller = async () => {
  try {
    if (!product?.id) {
      toast.error("Product not found.");
      return;
    }

    if (abortContactRef.current) abortContactRef.current.abort();

    const controller = new AbortController();
    abortContactRef.current = controller;
    setLoadingContact(true);

    const reseller = resellerCodeFromURL?.trim() || "";

    const res = await fetch(
      `https://backend.hovertask.com/api/landing-page-track-conversion/${product.id}?reseller=${encodeURIComponent(reseller)}`,
      {
        method: "GET",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json"
        },
        signal: controller.signal,
      }
    );

    const data = await res.json().catch(() => ({}));

    if (!res.ok) {
      // Avoid showing backend error text → secure
      toast.error("Unable to contact seller. Please try again.");

      console.error("Contact seller backend error:", data);
      return;
    }

    // SUCCESS
    if (data?.whatsapp_url) {
      toast.success("Opening chat with seller...");
      window.location.href = data.whatsapp_url;
      return;
    }

    // UNKNOWN SUCCESS RESPONSE
    toast.error("Unexpected response. Try again later.");
    console.warn("Unexpected backend response:", data);

  } catch (err: any) {
    if (err.name === "AbortError") return;

    toast.error("Network error. Please try again.");
    console.error("Contact seller fetch error:", err);
  } finally {
    setLoadingContact(false);
  }
};


  /** ---------------------------------------------------------
   * PRODUCT FETCH + SWR CACHING
   * --------------------------------------------------------*/
  useEffect(() => {
    if (!id) return;

    let aborted = false;
    const controller = new AbortController();
    const sig = controller.signal;

    const cached = productCache.get(id);

    // fresh cache → no loading
    if (cached && Date.now() - cached.ts < STALE_MS) {
      setProduct(cached.data);
      setLoading(false);
      fetchProduct(false);
      return;
    }

    // stale cache → show stale + revalidate
    if (cached) {
      setProduct(cached.data);
      setLoading(false);
      fetchProduct(false);
    } else {
      fetchProduct(true);
    }

    async function fetchProduct(showLoading: boolean) {
      try {
        if (showLoading) {
          setLoading(true);
          setError(null);
        }

        const res = await fetch(
          `https://backend.hovertask.com/api/show-product-landing-page/${id}`,
          {
            method: "GET",
            headers: { Accept: "application/json", "Content-Type": "application/json" },
            signal: sig,
          }
        );

        if (!res.ok) {
          if (res.status === 404) throw new Error("Product not found");
          throw new Error("Failed to load product");
        }

        const raw = await res.json();

        // ✅ extract actual product object
        if (!raw.product) {
          throw new Error("Invalid API response: missing product");
        }

        const extractedProduct: ProductApiResponse = raw.product;

        productCache.set(id ?? "", { ts: Date.now(), data: extractedProduct });

        if (!aborted) {
          setProduct(extractedProduct);
          setError(null);
        }
      } catch (err: any) {
        if (err.name !== "AbortError") {
          console.error(err);
          if (!aborted) setError(err.message || "Failed to fetch product");
        }
      } finally {
        if (!aborted) setLoading(false);
      }
    }

    return () => {
      aborted = true;
      controller.abort();
    };
  }, [id]);

  /** ---------------------------------------------------------
   * IMAGE CAROUSEL
   * --------------------------------------------------------*/
  const [activeImageIndex, setActiveImageIndex] = useState(0);
  const imageCarouselRef = useRef<HTMLDivElement | null>(null);
  const scrollTimeoutRef = useRef<number | null>(null);

  // sync button changes
  useEffect(() => {
    const el = imageCarouselRef.current;
    if (!el) return;

    const singleWidth = el.clientWidth;
    el.scrollTo({ left: activeImageIndex * singleWidth, behavior: "smooth" });
  }, [activeImageIndex]);

  // detect scroll position
  useEffect(() => {
    const el = imageCarouselRef.current;
    if (!el) return;

    const onScroll = () => {
      if (scrollTimeoutRef.current) window.clearTimeout(scrollTimeoutRef.current);
      scrollTimeoutRef.current = window.setTimeout(() => {
        const idx = Math.round(el.scrollLeft / (el.clientWidth || 1));
        setActiveImageIndex(idx);
      }, 80);
    };

    el.addEventListener("scroll", onScroll);
    return () => {
      el.removeEventListener("scroll", onScroll);
      if (scrollTimeoutRef.current) window.clearTimeout(scrollTimeoutRef.current);
    };
  }, []);

  /** ---------------------------------------------------------
   * LOADING STATES
   * --------------------------------------------------------*/
  if (loading && !product) {
    return (
      <div className="p-8">
        <div className="animate-pulse space-y-4">
          <div className="h-64 bg-gray-200 rounded" />
          <div className="h-6 bg-gray-200 rounded w-1/2" />
          <div className="h-4 bg-gray-200 rounded w-3/4" />
        </div>
      </div>
    );
  }

  if (error && !product) {
    return (
      <div className="p-8">
        <p className="text-red-500">Error: {error}</p>
        <Link to="/marketplace" className="text-blue-600">Back to marketplace</Link>
      </div>
    );
  }

  if (!product) return <p className="p-8">Product not available.</p>;

  /** ---------------------------------------------------------
   * UI RENDERING
   * --------------------------------------------------------*/
  const images = productImagesFromAPI(product).length
    ? productImagesFromAPI(product)
    : [product.images || "/placeholder.png"];

  const price = Number(product.price || 0);
  const discount = Number(product.discount || 0);

  return (
    <div className="bg-white shadow px-4 py-8 space-y-8 overflow-hidden">
      {/* HEADER */}
      <header className="flex gap-4">
        <Link to={location.pathname.includes("dashboard") ? "/dashboard/marketplace" : "/marketplace"}>
          <BsArrowLeft size={25} />
        </Link>

        <div className="flex items-center gap-4">
          <img src="/assets/images/demo-avatar.png" width={52} alt="Seller avatar" className="rounded-full" />
          <div>
            <h1 className="text-2xl">Seller</h1>
            <Link className="text-base" to={`/marketplace/seller/${product.user_id}`}>View Profile</Link>
          </div>
        </div>
      </header>

      {/* IMAGE CAROUSEL */}
      <div className="relative overflow-hidden space-y-3">
        {images.length > 1 && (
          <>
            {activeImageIndex > 0 && (
              <button
                onClick={() => setActiveImageIndex((i) => Math.max(0, i - 1))}
                className="p-2 absolute top-1/2 left-4 -translate-y-1/2 z-10"
              >
                <TfiAngleLeft size={30} />
              </button>
            )}

            {activeImageIndex < images.length - 1 && (
              <button
                onClick={() => setActiveImageIndex((i) => Math.min(images.length - 1, i + 1))}
                className="p-2 absolute top-1/2 right-4 -translate-y-1/2 z-10"
              >
                <TfiAngleRight size={30} />
              </button>
            )}
          </>
        )}

        <div ref={imageCarouselRef} className="max-w-full overflow-auto snap-mandatory snap-x flex no-scrollbar">
          {images.map((img, i) => (
            <div key={i} className="snap-center w-full min-w-full">
              <img src={img} alt="" className="max-w-[90%] mx-auto block" />
            </div>
          ))}
        </div>

        <div className="flex overflow-auto justify-end gap-4">
          {images.map((img, i) => (
            <button key={i} onClick={() => setActiveImageIndex(i)} className="cursor-pointer">
              <img src={img} className="h-[52px] rounded object-cover" />
            </button>
          ))}
        </div>
      </div>

      {/* PRODUCT INFO */}
      <div className="bg-gradient-to-b from-white to-[#DAE2FF] py-8 px-1 space-y-8">
        <div className="grid md:grid-cols-12 gap-10">
          <div className="col-span-9 space-y-1">
            <h2 className="text-xl">{product.name}</h2>
            <p className="text-sm text-[#000000BF]">{product.description}</p>

            <Info heading="Brand" value={product.category_id} />
            <Info heading="Stock" value={product.stock} />
            <Info heading="Location" value={product.location ?? "N/A"} />
          </div>

          {/* PRICE */}
          <div className="col-span-2 flex flex-col justify-between space-y-3">
            <div className="relative before:absolute before:w-full before:h-full before:bg-gradient-to-b before:from-[#4B70F5] before:to-[#2C418F00] before:rounded-lg before:-rotate-6 before:z-0 before:opacity-20">
              {discount > 0 && (
                <p className="line-through text-[#77777A] text-xs">₦{price.toFixed(2)}</p>
              )}
              <p className="text-[22.77px]">
                ₦{(price - discount).toFixed(2)}
              </p>
            </div>

            <div className="flex gap-3 justify-center p-2 rounded-md bg-gradient-to-b from-[#DAE2FF] to-transparent">
              <button><IoHeartOutline /></button>
              <button><CiShare2 /></button>
            </div>
          </div>
        </div>

        {/* META */}
        <div className="h-1 border-t border-dashed border-[#66666666] w-[80%] mx-auto"></div>

        <div className="flex justify-between text-sm text-[#77777A]">
          <div className="flex gap-6 items-center">
            <span className="flex items-center gap-2">
              <GoLocation /> {product.location ?? "Unknown location"}
            </span>
            <span>|</span>
            <span className="flex items-center gap-2">
              <GoEye /> {product.views ?? "—"} views
            </span>
          </div>
        </div>

        {/* ACTION BUTTON */}
        <div className="flex gap-6 flex-wrap">
          <button
            onClick={handleContactSeller}
            disabled={loadingContact}
            className="px-6 py-4 bg-base text-white rounded-[20.01px] active:scale-90 transition"
          >
            {loadingContact ? "Connecting..." : "Contact Seller"}
          </button>
        </div>
      </div>

      {/* FEEDBACK */}
      <div className="space-y-4">
        <h2>Customer Feedback</h2>

        <div className="space-y-6">
          <Feedback
            name="Onah Victor"
            rating={5}
            comment="Amazing sound quality and super comfortable!"
            date="Dec.29,2024"
          />
          <Feedback
            name="Onah Victor"
            rating={5}
            comment="Amazing sound quality and super comfortable!"
            date="Dec.29,2024"
          />
        </div>
      </div>
    </div>
  );
};

/** ---------------------------------------------------------
 * SUB COMPONENTS
 * --------------------------------------------------------*/
const Feedback = ({
  name,
  rating,
  comment,
  date,
}: {
  name: string;
  rating: number;
  comment: string;
  date: string;
}) => {
  return (
    <div className="max-w-[294px] space-y-1">
      <div className="flex gap-2 items-center">
        <img width={28} src="/assets/images/demo-avatar.png" alt={name} />
        <p className="flex items-center gap-2">
          <span className="text-[14px]">{name}</span>
          <img width={14} src="/assets/images/twemoji_flag-nigeria.png" alt="Flag" /> |
          <span className="text-[#77777A] text-[10px]">{date}</span>
        </p>
      </div>

      <div className="flex gap-1">
        {Array(rating)
          .fill(1)
          .map((_, i) => (
            <GiRoundStar key={i} color="#F5B300" />
          ))}
      </div>

      <p className="text-[10px] text-[#77777A]">{comment}</p>
    </div>
  );
};

const Info = ({ heading, value }: { heading: string; value: ReactNode }) => (
  <p className="text-sm">
    <b>{heading}:</b> <span className="text-[#000000BF]">{value}</span>
  </p>
);

export default SingleProductBody;
