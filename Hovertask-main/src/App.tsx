import { BrowserRouter, Routes, Route } from "react-router-dom";
import LandingPage from "./pages/index";
import Layout from "./layout";
import SignIn from "./pages/signin";
import Faq from "./pages/index/components/Faq";
import About from "./pages/about";
import ContactUs from "./pages/contact";
import Marketplace from "./pages/marketplace";
import Market from "./pages/marketplace/components/Market";
import Trending from "./pages/marketplace/trending";
import BestDealServices from "./pages/marketplace/best-deal-services";
import TrendingWomensWear from "./pages/marketplace/trending-womens-wear";
import HottestDealsServices from "./pages/marketplace/hottest-deals-services";
import SingleProduct from "./pages/marketplace/product/[id]";
import SellerProfilePage from "./pages/marketplace/seller/[id]";
import Signup from "./pages/signup";

const App = () => {
    return (
        <BrowserRouter>
            <Routes>
                {/* Public routes */}
                <Route path="/" element={<Layout />}>
                    <Route index element={<LandingPage />} />
                    <Route path="about" element={<About />} />
                    <Route path="contact" element={<ContactUs />} />
                    <Route path="signup" element={<Signup />} />
                    <Route path="signin" element={<SignIn />} />
                    <Route path="faq" element={<Faq />} />
                    <Route path="marketplace" element={<Marketplace />}>
                        <Route index element={<Market />} />
                        <Route path="trending" element={<Trending />} />
                        <Route path="best-deal-services" element={<BestDealServices />} />
                        <Route path="trending-womens-wear" element={<TrendingWomensWear />} />
                        <Route path="hottest-deals-services" element={<HottestDealsServices />} />
                    </Route>
                    <Route path="marketplace/product/:id" element={<SingleProduct />} />
                    <Route path="marketplace/seller/:id" element={<SellerProfilePage />} />
                </Route>
                {/* Public routes */}
            </Routes>
        </BrowserRouter>
    );
};

export default App;
