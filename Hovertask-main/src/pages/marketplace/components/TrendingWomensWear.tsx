import { useLocation } from "react-router-dom";
import ProductsSection from "./ProductsSection";
import type { NormalizedProduct } from "../../../types/NormalizedProduct";

const TrendingWomensWear = ({
    products,
    loading
}: {
    products: NormalizedProduct[];
    loading: boolean;
}) => {
    const location = useLocation();

    return (
        <ProductsSection
            heading="Trending Women's Wear"
            products={products}
            loading={loading}
            link={
                location.pathname.includes("dashboard")
                    ? "/dashboard/marketplace/trending-womens-wear"
                    : "/marketplace/trending-womens-wear"
            }
        />
    );
};

export default TrendingWomensWear;
