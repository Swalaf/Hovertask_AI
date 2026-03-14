import { useState } from "react";
import { BiSearch } from "react-icons/bi";
import { FaCaretDown } from "react-icons/fa";
import { MdOutlineTune } from "react-icons/md";

const Hero = () => {
    const [searchQuery, setSearchQuery] = useState("");

    return (
        <div className="min-h-[260px] md:min-h-[300px] rounded-xl md:rounded-2xl relative overflow-hidden flex flex-col justify-end gap-4 md:gap-6 z-0 p-4 md:p-6">
            <img 
                src="/assets/images/image 3.png" 
                alt="Shop the latest trends on HoverTask Marketplace" 
                className="absolute inset-0 z-0 h-full w-full object-cover"
                loading="eager"
            />
            <div className="max-w-sm md:max-w-md p-4 md:p-5 bg-gradient-to-r from-black/85 to-transparent z-10 text-lg md:text-xl font-bold text-white rounded-lg">
                Connect, Trade, and Earn on HoverTask Marketplace.
            </div>

            <div className="w-full z-10">
                <div className="px-4 md:px-5 gap-3 md:gap-5 bg-white dark:bg-slate-800 shadow-lg dark:shadow-2xl dark:shadow-indigo-500/10 flex flex-col md:flex-row items-stretch md:items-center w-full max-w-full md:max-w-[460px] h-auto md:h-[52px] rounded-lg md:rounded-xl">
                    {/* Search form */}
                    <form className="p-2 md:p-0 h-auto md:h-[28px] rounded-lg md:rounded-full border border-gray-200 dark:border-slate-600 md:border-none flex items-center gap-2 flex-1 min-w-0">
                        <BiSearch className="text-gray-400 flex-shrink-0 w-5 h-5" />
                        <input 
                            type="text" 
                            placeholder="Search products, services..."
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            className="bg-transparent min-w-0 flex-1 outline-none text-gray-700 dark:text-white placeholder:text-gray-400 text-sm md:text-base"
                        />
                        <button type="button" title="Filters" className="p-1">
                            <MdOutlineTune className="text-gray-400 w-5 h-5" />
                        </button>
                    </form>
                    {/* Search form */}

                    <div className="flex items-center text-xs md:text-sm font-medium gap-2 md:gap-3 border-t md:border-t-0 border-gray-100 dark:border-slate-600 pt-2 md:pt-0">
                        <span className="text-gray-500 dark:text-slate-400">Location:</span>
                        <button className="flex gap-1 items-center whitespace-nowrap text-gray-700 dark:text-white hover:text-[#2C418F] transition-colors">
                            All Nigeria <FaCaretDown className="text-gray-400" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Hero;
