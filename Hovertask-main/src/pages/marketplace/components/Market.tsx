import { BsArrowLeft } from "react-icons/bs";
import { useLocation } from "react-router-dom";
import Hero from "./Hero";
import ProductsSection from "./ProductsSection";
import BannersCarousel from "./BannersCarousel";
import BestDealServices from "../BestDealServices";
import TrendingProductsAndServices from "./TrendingProductsAndServices";
import TrendingWomensWear from "./TrendingWomensWear";
import HottestDeals from "./HottestDeals";

import useFetchProducts from "../../../hooks/useFetchProducts";
import type { NormalizedProduct } from "../../../types/NormalizedProduct";

const Market = () => {
    const location = useLocation();
    const { products, loading } = useFetchProducts(); // already normalized

    return (
        <>
            {location.pathname.includes("dashboard") && (
                <section className="flex items-center gap-4">
                    <div>
                        <BsArrowLeft size={30} className="dark:text-white" />
                    </div>
                    <div>
                        <h2 className="text-2xl dark:text-white">Welcome to Hovertask Marketplace</h2>
                        <p className="text-xs text-[#000000BF] dark:text-slate-400">
                            Your one-stop platform to buy, sell, and earn effortlessly.
                        </p>
                    </div>
                </section>
            )}

            <Hero />

            <div className="my-6">
                <p className="font-light text-[#000000BF] dark:text-slate-400">
                    Discover trending products and services or showcase yours to thousands of buyers daily.
                </p>
            </div>

            <TrendingProductsAndServices products={products} loading={loading}/>

            <BannersCarousel />

            <BestDealServices products={products} loading={loading}/>

            <TrendingWomensWear products={products} loading={loading} />

            <HottestDeals products={products} loading={loading}/>
        </>
    );
};

export default Market;
