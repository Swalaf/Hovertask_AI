import { ReactNode } from "react";

const GradientBox = ({ children, className = "" }: { children: ReactNode; className?: string }) => (
    <div
        className={`w-[60%] h-[70%] bg-[#EEF0FF] rounded-3xl flex justify-center gap-14 items-center max-md:w-full px-2 ${className}`}
    >
        {children}
    </div>
);

export default GradientBox;
