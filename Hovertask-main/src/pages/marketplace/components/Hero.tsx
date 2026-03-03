import { BiSearch } from "react-icons/bi";
import { FaCaretDown } from "react-icons/fa";
import { MdOutlineTune } from "react-icons/md";

const Hero = () => (
    <div className="min-h-[348px] rounded-3xl relative overflow-hidden flex flex-col justify-end gap-8 z-0 p-8">
        <img src="/assets/images/image 3.png" alt="Hero image" className="absolute inset-0 z-0 h-full w-full" />
        <div className="max-w-sm p-4 bg-gradient-to-r from-black to-transparent z-10 text-2xl font-extrabold text-white">
            Connect, Trade, and Earn on Hovertask Market Place.
        </div>

        <div className="w-full z-10 flex justify-end">
            <div className="px-6 gap-8 bg-white shadow-lg flex items-center w-full max-w-[488px] h-[58px] rounded-2xl">
                {/* Search form */}
                <form className="p-4 h-[30px] rounded-full border border-[#00000066] flex items-center gap-2 flex-1 min-w-0">
                    <input type="text" className="bg-transparent min-w-0 flex-1 outline-none" />
                    <button title="Search">
                        <BiSearch />
                    </button>
                    <button className="text-base" title="Search">
                        <MdOutlineTune />
                    </button>
                </form>
                {/* Search form */}

                <div className="flex items-center text-[9.4px] font-light gap-4">
                    <div>Location:</div>
                    <button className="flex gap-1 items-center whitespace-nowrap">
                        All Nigeria <FaCaretDown />
                    </button>
                </div>
            </div>
        </div>
    </div>
);

export default Hero;
