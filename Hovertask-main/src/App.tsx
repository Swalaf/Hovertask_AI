import { BrowserRouter, Routes, Route } from "react-router-dom";
import { lazy, Suspense } from "react";
import Layout from "./layout";
import { DarkModeProvider } from "./hooks/useDarkMode";

// Lazy load pages for better performance
const LandingPage = lazy(() => import("./pages/index"));
const SignIn = lazy(() => import("./pages/signin"));
const Signup = lazy(() => import("./pages/signup"));
const Faq = lazy(() => import("./pages/index/components/Faq"));
const About = lazy(() => import("./pages/about"));
const ContactUs = lazy(() => import("./pages/contact"));
const Marketplace = lazy(() => import("./pages/marketplace"));
const Market = lazy(() => import("./pages/marketplace/components/Market"));
const Trending = lazy(() => import("./pages/marketplace/trending"));
const BestDealServices = lazy(() => import("./pages/marketplace/best-deal-services"));
const TrendingWomensWear = lazy(() => import("./pages/marketplace/trending-womens-wear"));
const HottestDealsServices = lazy(() => import("./pages/marketplace/hottest-deals-services"));
const SingleProduct = lazy(() => import("./pages/marketplace/product/[id]"));
const SellerProfilePage = lazy(() => import("./pages/marketplace/seller/[id]"));

// Loading component
const PageLoader = () => (
    <div className="flex items-center justify-center min-h-[50vh]">
        <div className="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
    </div>
);

const App = () => {
    return (
        <DarkModeProvider>
            <BrowserRouter>
                <Suspense fallback={<PageLoader />}>
                    <Routes>
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
                    </Routes>
                </Suspense>
            </BrowserRouter>
        </DarkModeProvider>
    );
};

export default App;
