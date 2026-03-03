import { GiRoundStar } from "react-icons/gi";
import { TiBookmark, TiHeartOutline } from "react-icons/ti";

export const SellerProfile = () => {
    return (
        <div className="bg-white shadow-md px-4 py-8 space-y-8 overflow-hidden">
            <div className="bg-[#EEF0FF]">
                <div className="bg-gradient-to-b from-[#F4F4FA] to-white rounded-b-lg p-4 rounded-[15.2px] space-y-4">
                    <div className="flex gap-2 items-center">
                        <img width={42} height={42} src="/assets/images/demo-avatar.png" alt="Avatar" />
                        <div className="flex gap-12 flex-wrap">
                            <div className="text-[#000000BF]">
                                <p className="text-xl">Alayande Bamidele</p>
                                <p className="text-[#000000BF]">@Datalite Gadgets</p>
                            </div>
                            <div className="flex gap-2 h-fit text-[#77777A]">
                                <button className="p-1 rounded-full border border--[#77777A]">
                                    <TiHeartOutline />
                                </button>
                                <button className="p-1 rounded-full border border--[#77777A]">
                                    <TiBookmark />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div className="flex justify-between items-end">
                        <div className="space-y-3">
                            <div className="flex gap-4 items-center">
                                <img src="/assets/images/twemoji_flag-nigeria.png" width={20} alt="Flag" /> |{" "}
                                <span className="relative text-[#77777A] text-[9.82px]">
                                    Online{" "}
                                    <span className="absolute -left-1.5 top-1 h-1 w-1 bg-green-400 rounded-full"></span>
                                </span>
                            </div>
                            <div className="flex justify-between gap-4">
                                <div className="text-[#00B306] bg-[#00B3061A] text-[10.66px] px-[12.8px] py-[3.2px] rounded-full text-center">
                                    Verified ID
                                </div>
                                <div className="text-[8.24px] flex items-center gap-1">
                                    <GiRoundStar size={14} color="#F5B300" /> 4.8
                                </div>
                                <button className="text-white bg-base text-[10.66px] px-[12.8px] py-[3.2px] rounded-full text-center">
                                    Follow
                                </button>
                            </div>
                        </div>
                        <div className="flex gap-4">
                            <div className="bg-[#EEF0FF] w-[60.61px] h-[37.04px] px-2 py-0.5 rounded-lg flex flex-col gap-0.5 border-1 border-[#66666666] flex-1">
                                <span className="text-[10.58px]">3</span>
                                <span className="text-[8.98px]">Referrals</span>
                            </div>
                            <div className="bg-[#EEF0FF] w-[60.61px] h-[37.04px] px-2 py-0.5 rounded-lg flex flex-col gap-0.5 border-1 border-[#66666666] flex-1">
                                <span className="text-[10.58px]">6</span>
                                <span className="text-[8.98px]">Followers</span>
                            </div>
                            <div className="bg-[#EEF0FF] w-[60.61px] h-[37.04px] px-2 py-0.5 rounded-lg flex flex-col gap-0.5 border-1 border-[#66666666] flex-1">
                                <span className="text-[10.58px]">1</span>
                                <span className="text-[8.98px]">Following</span>
                            </div>
                        </div>
                        <div className="flex gap-2 flex-wrap justify-center items-center">
                            <button className="cursor-pointer active:scale-90 transition-transform text-[8.89px] px-[17.06px] py-[10.67px] w-fit bg-base rounded-[20.01px] text-white">
                                Contact Seller
                            </button>
                            <button className="cursor-pointer active:scale-90 transition-transform text-[8.89px] px-[17.06px] py-[10.67px] w-fit border-base border-1 rounded-[20.01px] text-base">
                                Start Chat
                            </button>
                        </div>
                    </div>
                </div>
                <p className="text-xs text-center p-4">Municipal Area Council, Federal Capital Territory, Nigeria</p>
            </div>
        </div>
    );
};

export default SellerProfile;
