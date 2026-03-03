import { BiSolidDownArrow } from "react-icons/bi"
import earner from "../../assets/earner.png"


const Dashboard = () => {
  return (
    <div className="flex justify-between  w-full lg:w-[70%]" >
       <div>
         <p>Welcome Back,</p>
         <h1 className="font-bold text-[16px]">Alayande</h1>
       </div>
       <div className="flex items-center  gap-4 w-[100px] h-[40px] px-3 py-2 rounded-xl bg-[#10af88] text-white">
        <div className="flex items-center gap-2">
          <img src={earner} alt="icon" width={16} />
          <span>Earner</span>
        </div>
        <BiSolidDownArrow size={12} />
       </div>
          
    </div>
  )
}

export default Dashboard