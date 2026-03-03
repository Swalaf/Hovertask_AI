import SideNav from "../../../dashboard/components/SideNav";
import SingleProductBody from "./components/Body";
import SellersInfo from "./components/SellersInfo";

const SingleProduct = () => {
    return (
        <main className="hero overflow-hidden lg:px-4">
            <div className="grid max-lg:grid-cols-1 gap-4 max-xl:grid-cols-[1fr_232px] xl:grid-cols-[243px_1fr_232px] max-w-screen-xl mx-auto">
                <SideNav />
                <SingleProductBody />
                <SellersInfo />
            </div>
        </main>
    );
};

export default SingleProduct;
