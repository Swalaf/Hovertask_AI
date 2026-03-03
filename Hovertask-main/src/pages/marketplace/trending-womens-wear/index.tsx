import { BsArrowLeft } from "react-icons/bs";
import { Link, useLocation } from "react-router-dom";
import BestDealServices from "../BestDealServices";
import ProductsSection from "../components/ProductsSection";
import useFetchProducts from "../../../hooks/useFetchProducts";
import BannersCarousel from "../components/BannersCarousel";

const TrendingWomensWear = () => {
    const location = useLocation();
    const { products, loading } = useFetchProducts(); // already normalized

    return (
        <>
            <section className="flex items-center gap-4">
                <Link to={location.pathname.includes("dashboard") ? "/dashboard/marketplace" : "/marketplace"}>
                    <BsArrowLeft size={30} />
                </Link>
                <div>
                    <h2 className="text-2xl">Explore Our Categories</h2>
                    <p className="text-xs text-[#000000BF]">
                        Find what you need, from gadgets to services, all in one place.
                    </p>
                </div>
            </section>
            <ProductsSection
                products={products.concat(products).concat(products).concat(products)}
                grid
                heading="Trending Women's Wear"
                useResponsiveCard
                loadAsyncProducts
            />
            <section>
                <img src="/assets/images/banner.png" alt="Banner" />
            </section>
            <BestDealServices products={products} loading={loading} />
            <BannersCarousel />
        </>
    );
};

export default TrendingWomensWear;
