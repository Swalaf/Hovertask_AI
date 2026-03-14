import { HeroUIProvider } from "@heroui/react";
import "material-icons/iconfont/material-icons.css";
import { Provider, useDispatch } from "react-redux";
import { BrowserRouter, Route, Routes, useLocation } from "react-router";
import { Toaster } from "sonner";
import { lazy, Suspense, useEffect, useState } from "react";
import "./App.css";
import RootLayout from "./components/layout";
import Logout from "./components/Logout";
import store from "./redux/store";
import getAuthUser from "./utils/getAuthUser";
import { listenForUserUpdates } from "./utils/realtimeUserListener";
import { setAuthUser } from "./redux/slices/auth";

// Lazy load pages for better performance
const Dashboard = lazy(() => import("./pages/dashboard/Dashboard"));
const AddMeUp = lazy(() => import("./pages/add-me-up/AddMeUp"));
const ListProfile = lazy(() => import("./pages/add-me-up/ListProfile"));
const ListProfileForm = lazy(() => import("./pages/add-me-up/ListProfileForm"));
const PointsPage = lazy(() => import("./pages/add-me-up/Points"));
const Profile = lazy(() => import("./pages/add-me-up/Profile"));
const AdvertisePage = lazy(() => import("./pages/advertise/advertise/Advertise"));
const EngagementTasks = lazy(() => import("./pages/advertise/engagement-tasks/EngagementTasks"));
const PostAdvertPage = lazy(() => import("./pages/advertise/post-advert/PostAdvert"));
const AdvertTaskPerformancePage = lazy(() => import("./pages/advertise/AdvertTaskPerformance"));
const AdvertTasksHistoryPage = lazy(() => import("./pages/advertise/AdvertTasksHistory"));
const EngagementTaskPerformancePage = lazy(() => import("./pages/advertise/EngagementTaskPerformance"));
const EngagementTasksHistoryPage = lazy(() => import("./pages/advertise/EngagementTaskHistory"));
const MembershipPage = lazy(() => import("./pages/become-a-member/BecomeAMember"));
const PaymentCallbackPage = lazy(() => import("./pages/PaymentCallback"));
const VerifyEmailPage = lazy(() => import("./pages/VerifyEmail"));
const ChangePasswordPage = lazy(() => import("./pages/ChangePassword"));
const ChoosePaymentMethodPage = lazy(() => import("./pages/choose-online-payment-method/ChoosePaymentMethod"));
const AdvertsPage = lazy(() => import("./pages/earn/adverts/Adverts"));
const AdvertsInfoPage = lazy(() => import("./pages/earn/adverts/components/AdvertInfo"));
const ConnectAccountsPage = lazy(() => import("./pages/earn/connect-accounts/ConnectAccounts"));
const Earn = lazy(() => import("./pages/earn/earn/Earn"));
const ResellPage = lazy(() => import("./pages/earn/resell/Resell"));
const TasksHistory = lazy(() => import("./pages/earn/tasks-history/TasksHistory"));
const TaskInfoPage = lazy(() => import("./pages/earn/tasks/[id]/TaskInfo"));
const Tasks = lazy(() => import("./pages/earn/tasks/Tasks"));
const EditProfilePage = lazy(() => import("./pages/EditProfile"));
const FundWalletPage = lazy(() => import("./pages/fund-wallet/FundWallet"));
const KycVerification = lazy(() => import("./pages/kyc/KycVerification"));
const KycVerificationForm = lazy(() => import("./pages/kyc/KycVerificationForm"));
const CartPage = lazy(() => import("./pages/marketplace/Cart"));
const CategoryPage = lazy(() => import("./pages/marketplace/Category"));
const SellerChat = lazy(() => import("./pages/marketplace/Chat"));
const ListProductPage = lazy(() => import("./pages/marketplace/ListProduct"));
const MarketplacePage = lazy(() => import("./pages/marketplace/Marketplace"));
const ProductCheckoutPage = lazy(() => import("./pages/marketplace/ProductCheckout"));
const ProductDashboardPage = lazy(() => import("./pages/marketplace/ProductDashboard"));
const ProductPerformancePage = lazy(() => import("./pages/marketplace/ProductPerformance"));
const SellerPage = lazy(() => import("./pages/marketplace/Seller"));
const SingleProductPage = lazy(() => import("./pages/marketplace/SingleProduct"));
const NotificationsPage = lazy(() => import("./pages/Notifications"));
const PrivacyPolicyPage = lazy(() => import("./pages/PrivacyPolicy"));
const ReferAndEarnPage = lazy(() => import("./pages/refer-and-earn/ReferAndEarn"));
const SingleTransactionPage = lazy(() => import("./pages/SingleTransaction"));
const TermsPage = lazy(() => import("./pages/Terms"));
const TransactionsHistoryPage = lazy(() => import("./pages/TransactionsHistory"));
const UpdateBankDetailsPage = lazy(() => import("./pages/UpdateBankDetails"));
const UpdateLocationPage = lazy(() => import("./pages/UpdateLocation"));
const ResellerConversionPage = lazy(() => import("./pages/ResellerConversionsPage"));

// Loading component
const PageLoader = () => (
  <div className="flex items-center justify-center min-h-screen">
    <div className="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
  </div>
);

// 🔒 Wrapper securing all routes
function AppAuthWrapper({ children }: { children: any }) {
  const location = useLocation();
  const dispatch = useDispatch();
  const [loading, setLoading] = useState(false);
  const [user, setUser] = useState<any>(null);

  // Load user once
  useEffect(() => {
    let isMounted = true;
    
    // Timeout fallback - ensure loading completes after 5 seconds
    const timeoutId = setTimeout(() => {
      if (isMounted && loading) {
        console.log("[Auth] Timeout reached, proceeding anyway");
        setLoading(false);
      }
    }, 5000);

    getAuthUser()
      .then((u) => {
        clearTimeout(timeoutId);
        if (isMounted) {
          setUser(u);
          dispatch(setAuthUser(u)); // Dispatch user to Redux
          setLoading(false);
        }
      })
      .catch((error) => {
        clearTimeout(timeoutId);
        console.error("[Auth] Error loading user:", error);
        if (isMounted) {
          setUser(null);
          setLoading(false);
        }
      });

    return () => {
      isMounted = false;
      clearTimeout(timeoutId);
    };
  }, [dispatch]);

  // Real-time updates
  useEffect(() => {
    if (!user?.id) return;
    listenForUserUpdates(user.id);
  }, [user?.id]);

  // While loading show spinner
  if (loading) {
    return (
      <div className="flex items-center justify-center min-h-screen bg-gray-50">
        <div className="text-center">
          <div className="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
          <p className="text-gray-600">Loading...</p>
        </div>
      </div>
    );
  }

  // Paystack callback stays open
  if (location.pathname === "/payment/callback") return children;

  
  // User NOT authenticated
  if (!user) {
    const params = new URLSearchParams(location.search);
    const reseller = params.get("reseller");

    // Match reseller URL: /marketplace/p/:id
    const match = location.pathname.match(/^\/marketplace\/p\/(\d+)/);

    if (match && reseller) {
      const productId = match[1];
      // Redirect externally
      window.location.href = `https://hovertask.com/marketplace/product/${productId}?reseller=${reseller}`;
      return null;
    }

    // Default redirect to Sign In - use main website in dev
    const redirectUrl = import.meta.env.DEV 
      ? "http://localhost:5174/signin"
      : "https://hovertask.com/signin";
    window.location.href = redirectUrl;
    return null;
  }

  return children;
}

export default function App() {
  return (
    <HeroUIProvider>
      <Toaster richColors position="top-center" />
      <Provider store={store}>
        <BrowserRouter>
          <AppAuthWrapper>
            <Suspense fallback={<PageLoader />}>
              <Routes>
                <Route element={<RootLayout />} path="*">
                <Route path="logout" element={<Logout />} />
                <Route index element={<Dashboard />} />

                <Route path="become-a-member" element={<MembershipPage />} />
                <Route path="choose-online-payment-method" element={<ChoosePaymentMethodPage />} />
                <Route path="fund-wallet" element={<FundWalletPage />} />
                <Route path="edit-profile" element={<EditProfilePage />} />
                <Route path="update-bank-details" element={<UpdateBankDetailsPage />} />
                <Route path="transactions-history" element={<TransactionsHistoryPage />} />
                <Route path="transactions-history/:id" element={<SingleTransactionPage />} />
                <Route path="change-password" element={<ChangePasswordPage />} />
                <Route path="update-location" element={<UpdateLocationPage />} />
                <Route path="notifications" element={<NotificationsPage />} />
                <Route path="terms" element={<TermsPage />} />
                <Route path="privacy-policy" element={<PrivacyPolicyPage />} />

                {/* Earn */}
                <Route path="earn" element={<Earn />} />
                <Route path="earn/tasks" element={<Tasks />} />
                <Route path="earn/tasks-history" element={<TasksHistory />} />
                <Route path="earn/tasks/:id" element={<TaskInfoPage />} />
                <Route path="earn/adverts" element={<AdvertsPage />} />
                <Route path="earn/adverts/:id" element={<AdvertsInfoPage />} />
                <Route path="earn/resell" element={<ResellPage />} />
                <Route path="earn/connect-accounts" element={<ConnectAccountsPage />} />

                {/* Marketplace */}
                <Route path="marketplace" element={<MarketplacePage />} />
                <Route path="marketplace/list-product" element={<ListProductPage />} />
                <Route path="marketplace/c/:category" element={<CategoryPage />} />
                <Route path="marketplace/p/:id" element={<SingleProductPage />} />
                <Route path="marketplace/s/:id" element={<SellerPage />} />
                <Route path="marketplace/cart" element={<CartPage />} />
                <Route path="marketplace/chat" element={<SellerChat />} />
                <Route path="marketplace/checkout/:id" element={<ProductCheckoutPage />} />
                <Route path="marketplace/listings" element={<ProductDashboardPage />} />
                <Route path="marketplace/performance" element={<ProductPerformancePage />} />

                {/* Advertise */}
                <Route path="advertise" element={<AdvertisePage />} />
                <Route path="advertise/post-advert" element={<PostAdvertPage />} />
                <Route path="advertise/engagement-tasks" element={<EngagementTasks />} />
                <Route path="advertise/advert-tasks-history" element={<AdvertTasksHistoryPage />} />
                <Route path="advertise/advert-task-performance/:id" element={<AdvertTaskPerformancePage />} />
                <Route path="advertise/engagement-tasks-history" element={<EngagementTasksHistoryPage />} />
                <Route path="advertise/engagement-task-performance/:id" element={<EngagementTaskPerformancePage />} />

                {/* Add Me Up */}
                <Route path="add-me-up" element={<AddMeUp />} />
                <Route path="add-me-up/profile" element={<Profile />} />
                <Route path="add-me-up/list-profile" element={<ListProfile />} />
                <Route path="add-me-up/list-profile-form" element={<ListProfileForm />} />
                <Route path="add-me-up/points" element={<PointsPage />} />

                {/* Refer */}
                <Route path="refer-and-earn" element={<ReferAndEarnPage />} />

                {/* KYC */}
                <Route path="kyc" element={<KycVerification />} />
                <Route path="kyc/start" element={<KycVerificationForm />} />

                {/* Payment callback */}
                <Route path="payment/callback" element={<PaymentCallbackPage />} />

                {/* Verify */}
                <Route path="VerifyEmail" element={<VerifyEmailPage />} />

                {/* Reseller conversions */}
                <Route path="reseller-conversion" element={<ResellerConversionPage />} />
              </Route>
            </Routes>
            </Suspense>
          </AppAuthWrapper>
        </BrowserRouter>
      </Provider>
    </HeroUIProvider>
  );
}
