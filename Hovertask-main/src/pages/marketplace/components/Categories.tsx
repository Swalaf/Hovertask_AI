import { useState } from "react";
import locationIcon from "../../../assets/mynaui_location.svg";
import newProductIcon from "../../../assets/material-symbols-light_box-add-outline.svg";
import { Link } from "react-router-dom";

const Categories = () => {
    const [currentCategories, setCurrentCategories] = useState(["All"]);
    const categories = [
        "All",
        "Health and Beauty",
        "Phones and Tablets",
        "Computing",
        "Home and Office",
        "Fashion",
        "Electronics",
        "Baby Product",
        "Grocery"
    ];
    return (
        <div className="mt-24 space-y-10 max-lg:hidden">
            <div className="border-1 border-[#66666666] rounded-3xl p-6 space-y-6">
                <div>
                    <h3>Explore Our Categories</h3>
                    <p className="text-xs font-light text-[#000000BF]">
                        Find what you need, from gadgets to services, all in one place.
                    </p>
                </div>
                <SearchForm />
                <div className="space-y-4">
                    {categories.map((category) => (
                        <button
                            // TODO: Refactor the functionality of this function
                            onClick={() =>
                                setCurrentCategories((prev) => {
                                    if (prev.includes("All") && category === "All") return prev;
                                    else if (prev.includes("All")) {
                                        if (prev.includes(category)) return prev.filter((c) => c !== category);
                                        else return [category];
                                    } else {
                                        if (prev.includes(category)) return prev.filter((c) => c !== category);
                                        else return [...prev, category];
                                    }
                                })
                            }
                            className={`${
                                currentCategories.includes(category) ? "bg-base text-white" : "bg-[#EBEBEB]"
                            } border-1 border-[#66666666] py-2 px-6 rounded-2xl whitespace-nowrap text-[13.5px]`}
                            key={category}
                        >
                            {category}
                        </button>
                    ))}
                </div>
            </div>
            <div className="bg-[#D6DFF8] p-6 rounded-3xl space-y-4">
                <div>
                    <img
                        src="/assets/images/Why_wait__Shop_the_latest_trends_and_essentials_on_-removebg-preview 2.png"
                        alt="Why wait"
                    />
                    <p className="text-[11.28px]">
                        Add a new product or service to the marketplace. Include details, set your price, and upload
                        images to attract buyers.
                    </p>
                </div>
                <Link
                    className="bg-base text-white p-2 w-full flex items-center gap-2 justify-center rounded-2xl"
                    to="#"
                >
                    <img src={newProductIcon} alt="" /> List a New Product
                </Link>
            </div>
        </div>
    );
};

const SearchForm = () => {
    return (
        <form>
            <label htmlFor="location" className="text-xs">
                Select location
            </label>
            <div className="flex bg-white py-1 px-4 rounded-full border-1 border-[#00000033]">
                <img src={locationIcon} alt="" />
                <input type="text" />
            </div>
        </form>
    );
};

export default Categories;
