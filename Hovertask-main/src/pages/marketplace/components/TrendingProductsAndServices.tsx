import ProductsSection from "./ProductsSection";
import type { NormalizedProduct } from "../../../types/NormalizedProduct";

const TrendingProductsAndServices = ({
    products,
    loading
}: {
    products: NormalizedProduct[];
    loading: boolean;
}) => {
    return (
        <ProductsSection
            heading="Trending Products & Services"
            products={products}
            loading={loading}
            link="trending"
        />
    );
};

export default TrendingProductsAndServices;
