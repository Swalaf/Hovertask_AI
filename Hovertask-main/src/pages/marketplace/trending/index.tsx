import { BsArrowLeft } from "react-icons/bs";
import { Link, useLocation } from "react-router-dom";
import { Helmet } from "react-helmet-async";
import BestDealServices from "../BestDealServices";
import ProductsSection from "../components/ProductsSection";
import useFetchProducts from "../../../hooks/useFetchProducts";
import BannersCarousel from "../components/BannersCarousel";

const Trending = () => {
    const location = useLocation();
    const { products, loading } = useFetchProducts(); // already normalized
   

    return (
        <>
            <Helmet>
                <title>Marketplace - HoverTask | Buy & Sell Products & Services</title>
                <meta name="description" content="Discover trending products and services on HoverTask marketplace. Shop electronics, fashion, beauty products, and more from verified sellers in Nigeria." />
                <meta name="keywords" content="marketplace, online shopping, buy and sell, Nigeria, electronics, fashion, beauty, trending products" />
                <meta property="og:title" content="Marketplace - HoverTask | Buy & Sell Products & Services" />
                <meta property="og:description" content="Discover trending products and services on Nigeria's leading marketplace. Shop from verified sellers." />
                <meta property="og:url" content="https://hovertask.com/marketplace" />
                <link rel="canonical" href="https://hovertask.com/marketplace" />
            </Helmet>
            <section className="flex items-center gap-4">
                <Link to={location.pathname.includes("dashboard") ? "/dashboard/marketplce" : "/marketplace"}>
                    <BsArrowLeft size={30} className="dark:text-white" />
                </Link>
                <div>
                    <h2 className="text-2xl dark:text-white">Explore Our Categories</h2>
                    <p className="text-xs text-[#000000BF] dark:text-slate-400">
                        Find what you need, from gadgets to services, all in one place.
                    </p>
                </div>
            </section>
            <ProductsSection
                products={products.concat(products).concat(products).concat(products)}
                grid
                heading="Trending Products and Services"
                useResponsiveCard
                loadAsyncProducts
            />
            <section>
                <img src="/assets/images/banner.png" alt="Banner" />
            </section>
            <BestDealServices products={products} loading={loading}/>
            <BannersCarousel />
        </>
    );
};

export default Trending;
