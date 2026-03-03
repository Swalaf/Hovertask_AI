import { useEffect, useRef, useState } from "react";

const BannersCarousel = () => {
    const carouselRef = useRef<HTMLDivElement>(null);
    const [currentSlide, setCurrentSlide] = useState(1);

    useEffect(() => {
        const width = carouselRef.current?.clientWidth;
        carouselRef.current?.scroll({ left: width! * (currentSlide - 1) });
    }, [currentSlide, carouselRef.current]);

    useEffect(() => {
        const interval = setInterval(() => setCurrentSlide((prev) => (prev === 3 ? 1 : prev + 1)), 3000);

        return () => clearInterval(interval);
    }, []);

    return (
        <div className="space-y-2">
            <div ref={carouselRef} className="flex overflow-auto no-scrollbar items-center">
                <img className="w-full h-auto" src="/assets/images/Group 1000004390.png" alt="Banner" />
                <img className="w-full h-auto" src="/assets/images/Group 1000004393.png" alt="Banner" />
                <img className="w-full h-auto" src="/assets/images/Group 1000004395.png" alt="Banner" />
            </div>
            <div className="grid grid-cols-4 gap-1 w-[108px] mx-auto">
                <span
                    className={`${
                        currentSlide === 1 ? "col-span-2 bg-base" : "bg-[#B3B3B3]"
                    } h-[3.47px] w-full rounded-full inline-block`}
                ></span>
                <span
                    className={`${
                        currentSlide === 2 ? "col-span-2 bg-base" : "bg-[#B3B3B3]"
                    }  h-[3.47px] w-full rounded-full inline-block"`}
                ></span>
                <span
                    className={`${
                        currentSlide === 3 ? "col-span-2 bg-base" : "bg-[#B3B3B3]"
                    }  h-[3.47px] w-full rounded-full inline-block"`}
                ></span>
            </div>
        </div>
    );
};

export default BannersCarousel;
