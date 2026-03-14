import { useState } from "react";
import locationIcon from "../../../assets/mynaui_location.svg";
import newProductIcon from "../../../assets/material-symbols-light_box-add-outline.svg";
import { Link } from "react-router-dom";

const Categories = () => {
    const [currentCategory, setCurrentCategory] = useState("All");
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
        <div className="mt-20 md:mt-24 space-y-8 max-lg:hidden">
            <div className="border border-gray-200 dark:border-slate-700 rounded-2xl p-5 space-y-5 bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-shadow">
                <div>
                    <h3 className="text-lg font-bold text-gray-800 dark:text-white mb-1">Explore Categories</h3>
                    <p className="text-sm text-gray-500 dark:text-slate-400">
                        Find what you need, from gadgets to services, all in one place.
                    </p>
                </div>
                <SearchForm />
                <div className="space-y-2">
                    {categories.map((category) => (
                        <button
                            onClick={() => setCurrentCategory(category)}
                            className={`w-full text-left py-2 px-4 rounded-xl text-sm font-medium transition-all ${
                                currentCategory === category 
                                    ? "bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-600 dark:to-purple-600 text-white shadow-md" 
                                    : "bg-gray-50 dark:bg-slate-700 text-gray-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-600"
                            }`}
                            key={category}
                        >
                            {category}
                        </button>
                    ))}
                </div>
            </div>
            
            <div className="bg-gradient-to-br from-[#2C418F]/10 to-blue-50 dark:from-indigo-900/20 dark:to-slate-800 p-5 rounded-2xl space-y-4">
                <div>
                    <img
                        src="/assets/images/Why_wait__Shop_the_latest_trends_and_essentials_on_-removebg-preview 2.png"
                        alt="List your products on HoverTask Marketplace"
                        className="w-full rounded-lg mb-3"
                        loading="lazy"
                    />
                    <p className="text-sm text-gray-600 dark:text-slate-300 leading-relaxed">
                        Add a new product or service to the marketplace. Include details, set your price, and upload images to attract buyers.
                    </p>
                </div>
                <Link
                    className="flex items-center justify-center gap-2 bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 dark:from-indigo-600 dark:to-purple-600 dark:hover:from-indigo-500 dark:hover:to-purple-500 text-white py-3 px-4 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg"
                    to="/signup"
                >
                    <img src={newProductIcon} alt="" className="w-5 h-5" /> 
                    List a New Product
                </Link>
            </div>
        </div>
    );
};

const SearchForm = () => {
    return (
        <form className="space-y-2">
            <label htmlFor="location" className="text-sm font-medium text-gray-700 dark:text-slate-300">
                Select location
            </label>
            <div className="flex items-center bg-gray-50 dark:bg-slate-700 py-2 px-4 rounded-xl border border-gray-200 dark:border-slate-600 focus-within:border-[#2C418F] dark:focus-within:border-indigo-400 focus-within:ring-2 focus-within:ring-[#2C418F]/20 dark:focus-within:ring-indigo-500/20 transition-all">
                <img src={locationIcon} alt="" className="w-4 h-4 text-gray-400" />
                <input 
                    type="text" 
                    placeholder="Enter location"
                    className="bg-transparent flex-1 ml-2 outline-none text-sm text-gray-700 dark:text-white placeholder:text-gray-400"
                />
            </div>
        </form>
    );
};

export default Categories;
