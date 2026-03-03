import { Link } from "react-router-dom";
import ProductCard from "./ProductCard";
import { ReactNode } from "react";
import arrow from "../../../assets/arrow down.svg";
import type { NormalizedProduct } from "../../../types/NormalizedProduct";

interface ProductSectionProps {
    heading?: string;
    products: NormalizedProduct[];
    vertical?: boolean;
    grid?: boolean;
    startComponent?: ReactNode;
    link?: string;
    useResponsiveCard?: boolean;
    loadAsyncProducts?: boolean;

    /** ✅ NEW */
    loading?: boolean;
}

const ProductsSection = ({
    heading,
    products,
    vertical,
    startComponent,
    link,
    grid,
    useResponsiveCard,
    loadAsyncProducts,
    loading              // <-- pick up loading
}: ProductSectionProps) => {

    // ✅ SHOW LOADING STATE
    if (loading) {
        return (
            <section className="space-y-4">
                {heading && (
                    <div className="flex items-center justify-between">
                        <h2>{heading}</h2>
                    </div>
                )}
                <div className="p-4 flex gap-4 rounded-2xl bg-[#EBEFFF]">
                    <p>Loading products...</p>
                </div>
            </section>
        );
    }

    return (
        <section className="space-y-4">
            {heading && (
                <div className="flex items-center justify-between">
                    <h2>{heading}</h2>
                    {link && (
                        <Link to={link} className="font-light text-base">
                            View All
                        </Link>
                    )}
                </div>
            )}

            <div
                className={`${vertical || "p-4"} ${
                    grid || "h-[254px]"
                } flex gap-4 bg-[#EBEFFF] rounded-2xl overflow-y-hidden max-w-full no-scrollbar`}
            >
                {startComponent && (
                    <div className="h-full w-fit max-md:hidden">
                        {startComponent}
                    </div>
                )}

                <div
                    className={`${vertical && "flex-col"} ${
                        grid
                            ? "grid grid-cols-2 max-[420px]:grid-cols-1 sm:grid-cols-3 xl:grid-cols-4"
                            : "flex flex-1"
                    } gap-4 overflow-x-auto no-scrollbar min-w-full max-w-full h-full`}
                >
                    {products.map((product) => (
                        <ProductCard
                            horizontal={vertical}
                            key={product.id}
                            {...product}
                            responsive={useResponsiveCard}
                        />
                    ))}
                </div>
            </div>

            {loadAsyncProducts && (
                <div className="flex justify-end">
                    <button className="flex items-center justify-center rounded-full h-[28.92px] border border-base text-base cursor-pointer text-[14.39px] p-[7.2px]">
                        Load more products <img src={arrow} alt="Arrow" />
                    </button>
                </div>
            )}
        </section>
    );
};

export default ProductsSection;
