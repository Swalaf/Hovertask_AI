import { BsArrowLeft } from "react-icons/bs";
import { Link, useLocation } from "react-router-dom";
import ProductsSection from "../components/ProductsSection";
import useFetchProducts from "../../../hooks/useFetchProducts";
import BannersCarousel from "../components/BannersCarousel";
import TrendingProductsAndServices from "../components/TrendingProductsAndServices";

const BestDealServices = () => {
    const location = useLocation();
     const { products, loading } = useFetchProducts(); // already normalized

    return (
        <>
            <section className="flex items-center gap-4">
                <Link to={location.pathname.includes("dashboard") ? "/dashboard/marketplce" : "/marketplace"}>
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
                heading="Best Deals Services"
                useResponsiveCard
                loadAsyncProducts
            />
            <section>
                <img src="/assets/images/banner.png" alt="Banner" />
            </section>
            <TrendingProductsAndServices products={products} loading={loading} />
            <BannersCarousel />
        </>
    );
};

export default BestDealServices;
