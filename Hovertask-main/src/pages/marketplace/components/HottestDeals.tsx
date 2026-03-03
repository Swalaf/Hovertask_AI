import { useLocation } from "react-router-dom";
import ProductsSection from "./ProductsSection";
import type { NormalizedProduct } from "../../../types/NormalizedProduct";

const HottestDeals = ({
    products,
    loading
}: {
    products: NormalizedProduct[];
    loading: boolean;
}) => {
    const location = useLocation();

    return (
        <ProductsSection
            startComponent={<ProductsSection vertical products={products} loading={loading} />}
            heading="Hottest Deals"
            products={products}
            loading={loading}
            link={
                location.pathname.includes("dashboard")
                    ? "/dashboard/marketplace/hottest-deals-services"
                    : "/marketplace/hottest-deals-services"
            }
        />
    );
};

export default HottestDeals;
