import { useLocation } from "react-router-dom";
import ProductsSection from "./components/ProductsSection";
import type { NormalizedProduct } from "../../types/NormalizedProduct";

const BestDealServices = ({
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
            heading="Best Deal Services"
            products={products}
            loading={loading}
            link={
                location.pathname.includes("dashboard")
                    ? "/dashboard/marketplace/best-deal-services"
                    : "/marketplace/best-deal-services"
            }
        />
    );
};

export default BestDealServices;
