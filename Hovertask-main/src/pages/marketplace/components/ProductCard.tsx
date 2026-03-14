import { BiStar } from "react-icons/bi";
import { FaHeart } from "react-icons/fa";
import { Link, useNavigate } from "react-router-dom";
import storeIcon from "../../../assets/store-button.svg";
import arrow from "../../../assets/arrow.svg";

export interface NormalizedProduct {
    id: number;
    name: string;
    price: number;
    featured_image_url: string;
    rating?: number;
    reviews_count?: number;
    available_units?: number;
}

interface ProductProps extends NormalizedProduct {
    horizontal?: boolean;
    responsive?: boolean;
}

const ProductCard = ({
    horizontal,
    responsive,
    id,
    name,
    price,
    featured_image_url,
    rating = 0,
    reviews_count = 0,
    available_units = 0
}: ProductProps) => {
    const navigate = useNavigate();
    const discountedPrice = price;

    const goToProduct = () => {
        navigate(`/marketplace/product/${id}`);
    };

    return (
        <div
            className={`${horizontal ? "flex gap-2 items-center" : ""} ${
                horizontal ? "w-[320px]" : responsive ? "" : "w-[180px]"
            } bg-white dark:bg-slate-800 rounded-2xl p-4 space-y-2 dark:shadow-lg dark:shadow-indigo-500/10`}
        >
            <div
                className="bg-zinc-200 dark:bg-slate-700 rounded-2xl overflow-hidden cursor-pointer"
                onClick={goToProduct}
            >
                <img
                    className={`${horizontal ? "min-w-[131px]" : responsive ? "" : "h-[97.7px]"} aspect-square block`}
                    src={featured_image_url || "/placeholder.png"}
                    alt={name}
                />
            </div>

            <div className="space-y-2">
                <div>
                    <div className="flex justify-between">
                        <h3 className="text-[11.28px] capitalize dark:text-white">{name}</h3>
                        <button className="text-[#FF00FB]">
                            <FaHeart />
                        </button>
                    </div>

                    <div className="flex gap-6">
                        <p className="text-[9.4px] text-[#77777A] dark:text-slate-400 line-through">₦{price}</p>
                        <p className="text-[11.28px] dark:text-white">₦{discountedPrice}</p>
                    </div>

                    <div className="flex gap-4 items-center">
                        <p className="text-[9.4px] flex items-center dark:text-slate-300">
                            <BiStar /> {rating.toFixed(1)}
                        </p>
                        <p className="text-[9.4px] text-base dark:text-slate-300">({reviews_count} Reviews)</p>
                        <p className="text-[#77777A] dark:text-slate-400 text-[9.11px]">{available_units} Units</p>
                    </div>
                </div>

                <div className="flex items-center justify-between gap-2">
                    {/* BUY PRODUCT BUTTON */}
                    <button
                        onClick={goToProduct}
                        className="flex gap-1 justify-center items-center bg-base text-white rounded-full h-[27.75px] text-[9.64px] flex-1"
                    >
                        <img src={storeIcon} alt="store icon" />
                        Buy Product
                    </button>

                    {/* LINK WITH REAL PRODUCT ID */}
                    <Link
                        to={`/marketplace/product/${id}`}
                        className="flex items-center justify-center rounded-full min-h-[28.92px] min-w-[28.92px] border border-base"
                    >
                        <img src={arrow} alt="Arrow north east" />
                    </Link>
                </div>
            </div>
        </div>
    );
};

export default ProductCard;
