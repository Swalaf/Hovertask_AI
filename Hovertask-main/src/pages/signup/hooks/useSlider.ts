import { useEffect, useState } from "react";

const useSlider = (slidesCount: number) => {
    const [currentSlide, setCurrentSlide] = useState(0);

    useEffect(() => {
        const timer = setInterval(() => {
            setCurrentSlide((prev) => (prev + 1) % slidesCount);
        }, 5000);

        return () => clearInterval(timer);
    }, []);

    return currentSlide;
};

export default useSlider;
