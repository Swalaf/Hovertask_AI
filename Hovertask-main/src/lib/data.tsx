import { LuLayoutDashboard } from "react-icons/lu";
import { CiWallet } from "react-icons/ci";
import { IoBagHandleOutline } from "react-icons/io5";
import { BiUserCheck } from "react-icons/bi";
import { MdAddTask } from "react-icons/md";
import { MdOutlineAddLink } from "react-icons/md";
import { BiLogOutCircle } from "react-icons/bi";
// import market from "./assets/market.svg";
import refer from "./assets/refer.svg";
import support from "./assets/support.svg";
// import wallet from "./assets/wallet.svg";


export const navList = [
    {
      label: "Dashboard",
      icon: <LuLayoutDashboard size={18} />,
      link: "",
    },
    {
      label: "Earn",
      icon: <CiWallet size={18} />,
      link: "earn",
    },
    {
      label: "Advertise",
      icon: <MdAddTask size={18} />,
      link: "advertise",
    },
    {
      label: "Market place",
      icon: <IoBagHandleOutline size={18} />,
      link: "market-place",
      options: [
        {
          label: "Buy Followers",
          icon: <BiUserCheck size={18} />,
          link: "#",
        },
        {
          label: "Add me up",
          icon: <MdOutlineAddLink size={18} />,
          link: "#",
        },
      ],
    },
    {
      label: "Refer & Earn",
      imgSrc: refer,

      link: "refer",
    },
    {
      label: "Support /  FAQ Page",
      imgSrc: support,

      link: "support",
    },
    {
      label: "Logout",
      icon: <BiLogOutCircle size={18} />,
      link: "#",
    },
  ];