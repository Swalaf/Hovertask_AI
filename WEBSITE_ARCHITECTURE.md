# Hovertask - Complete Website Architecture & Understanding

## 🎯 Project Overview

**Hovertask** is a comprehensive digital platform that enables users to earn money through multiple income streams including task completion, advertising, product reselling, social media engagement, and marketplace commerce. The platform combines features similar to freelance marketplaces, social media engagement platforms, e-commerce, and affiliate programs.

### Key Statistics
- **500k+ Members**
- **120k+ Downloads**
- **123k+ Advertisers**
- **15m+ Advert Views**

---

## 📋 Technology Stack

### Frontend - Dashboard (React + TypeScript)
- **Framework**: React 19 with TypeScript
- **Build Tool**: Vite 6
- **UI Component Library**: HeroUI (Hero UI v2.7.5)
- **State Management**: Redux Toolkit + React Redux
- **Routing**: React Router v7
- **Form Handling**: React Hook Form v7
- **HTTP Client**: Axios
- **Styling**: Tailwind CSS 3.4.17
- **Notifications**: Sonner (toast notifications)
- **Toast Library**: React Hot Toast v2.6.0
- **Icons**: 
  - Material Icons
  - Lucide React (v0.487.0)
  - React Icons
- **Animations**: Framer Motion v12.6.3
- **Charts**: Recharts v3.5.1
- **Real-time**: Pusher JS + Laravel Echo
- **Utilities**: 
  - Clsx (class name utilities)
  - Tailwind Merge

### Backend - Laravel API
- **Framework**: Laravel 11.9
- **PHP Version**: ^8.2
- **Database**: PostgreSQL
- **Authentication**: Laravel Sanctum (token-based API authentication)
- **Real-time**: Laravel Reverb (WebSocket support)
- **Broadcasting**: Pusher integration + Laravel Echo
- **File Storage**: Cloudinary (cloud image management)
- **Social Integration**: 
  - Facebook SDK
  - Laravel Socialite
  - TikTok provider
- **FFmpeg**: PHP FFmpeg v1.3 (video processing)
- **Authorization**: Laratrust (role-based access control)
- **Email**: Resend Laravel v0.19.0
- **Testing**: Pest (PHPUnit alternative)
- **Development**: Laravel Sail (Docker), Laravel Tinker

### Frontend - Marketing Website (React + TypeScript)
- Similar tech stack to Dashboard
- Marketing/landing page focused
- Additional pages for information

---

## 📂 Project Structure

### Three Main Applications:
1. **hovertask-dashboard/** - User dashboard & main app
2. **Hovertask-main/** - Marketing website & landing pages
3. **laravel-MKpr/** - Backend API server

---

## 🎨 Dashboard Application Structure

### `/src/pages/` - Main Feature Pages

#### **Dashboard** (`dashboard/`)
- **Dashboard.tsx**: Main dashboard landing page
  - Welcome message & user greeting
  - Balance display (wallet)
  - Available tasks preview
  - Available jobs/adverts preview
  - Refer and earn task card
  - Reseller task card
  - Ad banners and carousels
  - Popular products section

#### **Earn** (`earn/`)
Multiple earning opportunities:
- **earn/Earn.tsx**: Main earn hub with earning options
- **earn/tasks/Tasks.tsx**: Browse and complete tasks
- **earn/tasks/:id/TaskInfo.tsx**: Individual task details and completion
- **earn/tasks-history/TasksHistory.tsx**: History of completed tasks
- **earn/adverts/Adverts.tsx**: Post adverts to earn
- **earn/adverts/:id/AdvertInfo.tsx**: Individual advert details
- **earn/resell/Resell.tsx**: Resell products for commission
- **earn/connect-accounts/ConnectAccounts.tsx**: Link social media accounts

#### **Advertise** (`advertise/`)
Advertising & engagement platform:
- **advertise/advertise/Advertise.tsx**: Main advertise hub
  - Advert tasks (direct promotion)
  - Engagement tasks (boost interactions: likes, shares, comments)
- **advertise/post-advert/PostAdvert.tsx**: Create new advert
- **advertise/engagement-tasks/EngagementTasks.tsx**: Engagement task options
- **advertise/AdvertTaskPerformance.tsx**: Track advert task performance
- **advertise/AdvertTasksHistory.tsx**: History of posted adverts
- **advertise/EngagementTaskPerformance.tsx**: Track engagement performance
- **advertise/EngagementTaskHistory.tsx**: Engagement task history

#### **Marketplace** (`marketplace/`)
Buy and sell products:
- **marketplace/Marketplace.tsx**: Main marketplace hub
- **marketplace/SingleProduct.tsx**: Individual product details
- **marketplace/Category.tsx**: Products by category
- **marketplace/ListProduct.tsx**: Seller's product listing form
- **marketplace/ProductDashboard.tsx**: Seller's product dashboard
- **marketplace/ProductPerformance.tsx**: Track product sales & performance
- **marketplace/Cart.tsx**: Shopping cart
- **marketplace/ProductCheckout.tsx**: Checkout page
- **marketplace/Chat.tsx**: Seller chat with buyers
- **marketplace/Seller.tsx**: View seller profile

#### **Add Me Up** (`add-me-up/`)
Social media promotion service:
- **add-me-up/AddMeUp.tsx**: Main add me up hub
- **add-me-up/Profile.tsx**: User's social profiles
- **add-me-up/ListProfile.tsx**: List available profiles
- **add-me-up/ListProfileForm.tsx**: Add new profile
- **add-me-up/Points.tsx**: Points tracking and rewards

#### **Membership** (`become-a-member/`)
- **become-a-member/BecomeAMember.tsx**: Membership plans and pricing
  - ₦1,000 one-time membership fee
  - Benefits: daily income, referral bonuses, discounted airtime/data, marketplace access

#### **Other Pages**
- **EditProfile.tsx**: Edit user profile information
- **FundWallet.tsx**: Add funds to wallet (Paystack integration)
- **TransactionsHistory.tsx**: View all transactions
- **SingleTransaction.tsx**: Transaction details
- **ChangePassword.tsx**: Change account password
- **UpdateBankDetails.tsx**: Update bank account info
- **UpdateLocation.tsx**: Update user location
- **Notifications.tsx**: Notification center
- **KycVerification.tsx**: KYC verification status
- **KycVerificationForm.tsx**: Submit KYC documents
- **ReferAndEarn.tsx**: Referral program
- **VerifyEmail.tsx**: Email verification
- **PaymentCallback.tsx**: Payment gateway callback handler
- **ChoosePaymentMethod.tsx**: Select payment method
- **TermsPage.tsx**: Terms and conditions
- **PrivacyPolicy.tsx**: Privacy policy
- **ResellerConversionsPage.tsx**: Track reseller conversions

### `/src/components/` - Shared Components
- **layout.tsx**: Main root layout with auth wrapper, header, sidebar
- **Header.tsx**: Top navigation bar with menu, notifications, profile
- **SideNav.tsx**: Left sidebar navigation menu
- **Logout.tsx**: Logout handler
- **RequirementModal.tsx**: Modal for onboarding requirements
- **DarkModeToggle.tsx**: Dark/light theme toggle

### `/src/hooks/` - Custom React Hooks
- **useTask**: Hook for task operations
- **useProducts**: Hook for marketplace products
- **useTransactions**: Hook for transaction data
- **useActiveLink**: Track active navigation link
- **useRequirementPoll**: Poll user requirements status
- **useAuth**: Authentication related hooks

### `/src/utils/` - Utility Functions
- **getAuthUser()**: Fetch current authenticated user
- **realtimeUserListener.ts**: Real-time user updates via Pusher/Echo
- **getAuthorization()**: Get auth token from local storage
- **apiEndpointBaseURL**: API base URL config
- **menu.tsx**: Navigation menu configuration
- **cn.ts**: Tailwind class name utilities (clsx wrapper)
- **copy.ts**: Text copy to clipboard utilities

### `/src/shared/` - Shared Components & Resources
- **components/**:
  - ComingSoonModal: Feature not yet available modal
  - Input: Custom input component
  - Select: Custom select dropdown
  - Button: Custom button component
  - Loading: Loading spinner component
  - EmptyMapErr: Empty state/error display
  - UserProfileCard: User profile card
  - CarouselAdBanner: Advertisement banner carousel
  - MarketplaceSearchForm: Product search
  - AddMeUpAside: Sidebar for add me up
  - ReferTaskCard: Refer and earn task card
  - ResellerTaskCard: Reseller promotion card
  - AvailableTasks: Available tasks list
  - EditPassword: Password change form
  - ProductsSection: Display products

### `/src/redux/` - State Management
- **store.ts**: Redux store configuration
- **slices/**:
  - auth.ts: User authentication state
  - cart.ts: Shopping cart state
  - Other feature slices

---

## 🔑 Key Features & Modules

### 1. **Earn Money**
- **Tasks**: Complete simple tasks (likes, follows, comments, shares, retweets)
- **Adverts**: View and interact with advertisements
- **Reselling**: Sell products to network, earn commission
- **Social Media**: Connect accounts for engagement rewards

### 2. **Advertise Products/Services**
- **Advert Tasks**: Direct product/service promotion
- **Engagement Tasks**: Boost social media interactions
- **Performance Tracking**: Analytics dashboard
- **Reach**: 500k+ potential viewers

### 3. **Marketplace**
- **Buy & Sell**: E-commerce platform
- **Product Listings**: Detailed product pages
- **Seller Dashboard**: Product management
- **Performance Metrics**: Track views, clicks, sales
- **Chat**: Communicate with buyers/sellers
- **Reviews & Ratings**: Product feedback

### 4. **Membership System**
- **One-time Fee**: ₦1,000
- **Lifetime Benefits**:
  - Daily income from tasks
  - Referral bonuses (₦500 per referral)
  - Commission on likes, followers, shares (20%)
  - Discounted airtime/data (10-15% off)
  - Marketplace Pro access

### 5. **Referral & Affiliate**
- **Refer Friends**: ₦500 commission per referral
- **Reseller Links**: Earn commissions on product sales
- **Track Conversions**: Real-time analytics

### 6. **Social Media Integration**
- **Connect Accounts**: Link Facebook, Instagram, TikTok, Twitter
- **Earn from Engagement**: Get paid for interactions
- **Multi-Platform**: Reach across multiple networks

### 7. **Wallet & Payments**
- **Fund Wallet**: Deposit via Paystack
- **Transactions History**: Complete financial record
- **Withdrawals**: Withdraw to bank account
- **Balance Tracking**: Real-time wallet balance
- **KYC Verification**: Identity verification for withdrawals

### 8. **Add Me Up**
- **Social Profiles**: List your social media profiles
- **Points System**: Earn points for interactions
- **Social Promotion**: Get followers/likes for your accounts

---

## 🔐 Authentication Flow

```
1. Register → Verify Email → Email Verification Code
2. Login → Token (Sanctum) → Stored in localStorage
3. Auth Wrapper → Protected Routes
4. Real-time User Updates → Pusher/Echo
5. Auto-logout on invalid token
6. Forgot Password → Reset Email → New Password
```

### Authentication Guards
- **AppAuthWrapper**: Wraps entire app, checks user auth status
- **Protected Routes**: All routes require authentication
- **Special Cases**:
  - Payment callback route accessible without auth
  - Reseller product links accessible without auth
  - Redirects to main website or sign-in page if not authenticated

---

## 📊 Database Models (Laravel)

### User-Related
- **User**: Core user account
- **Wallet**: User's balance
- **FundsRecord**: Fund transfer history
- **PaystackRecipient**: Bank account for withdrawals
- **Transaction**: All financial transactions
- **Referral**: Referral program tracking
- **ResellerConversion**: Track reseller sales
- **ResellerLink**: Generated reseller links
- **SocialAccount**: Connected social media accounts
- **ManualSocialAccountLinking**: Manual account linking

### Task & Engagement
- **Task**: Tasks to complete
- **UserTask**: User task completion record
- **CompletedTask**: Verified completed tasks
- **Advertise**: Advertisement campaigns
- **AdvertiseImages**: Advert media files

### Marketplace
- **Product**: Products for sale
- **ProductImages**: Product photos
- **ProductFeedback**: User reviews
- **Cart**: Shopping cart items
- **Order**: Purchase orders
- **OrderItem**: Individual order items
- **Review**: Product reviews
- **Wishlist**: Saved products

### Communication
- **Conversation**: Chat threads
- **Message**: Individual chat messages
- **Participant**: Chat participants
- **ContactList**: Saved contacts

### KYC & Verification
- **KYC**: Know Your Customer data
- **EmailVerificationCode**: Email verification tokens
- **PasswordResetCode**: Password reset tokens

### System
- **Category**: Product categories
- **Contact**: Contact/support messages
- **Notification**: User notifications
- **Role**: User roles (admin, seller, buyer)
- **Permission**: Access permissions
- **TrendingProduct**: Featured products

---

## 🔌 API Endpoints (Laravel Routes)

### Authentication
```
POST /register                      - User registration
POST /login                         - User login
POST /logout                        - User logout
POST /resend-otp                    - Resend OTP
POST /verify-email-code             - Verify email
POST /resend-email-code             - Resend email verification
GET  /email/verify                  - Email verification status
POST /email/resend                  - Resend verification email
GET  /email/verify/{id}/{hash}      - Click email verification link
GET  /email/check                   - Check if email verified
POST /reset-password                - Reset password
GET  /reset-password/{token}        - Show reset form
POST /password/reset                - Complete password reset
```

### Dashboard
```
GET  /v1/dashboard/dashboard        - Dashboard data
GET  /v1/dashboard/user             - User data
POST /v1/dashboard/change-password  - Change password
POST /v1/dashboard/bank             - Update bank details
POST /v1/dashboard/update-profile   - Update profile
PUT  /v1/dashboard/update-password  - Update password
```

### Wallet & Payments
```
POST /v1/wallet/initialize-deposit  - Initialize payment
GET  /v1/wallet/verify-payment/{ref} - Verify payment
POST /webhook/paystack              - Paystack webhook
GET  /payment/verify-payment/{ref}  - Verify order payment
```

### Products (Marketplace)
```
GET  /show-product-landing-page/{id} - Product landing page
GET  /landing-page-products/all     - All products
GET  /landing-page-track-conversion/{productId} - Track reseller conversion
POST /v1/product                    - Create product
GET  /v1/product                    - List products
GET  /v1/product/{id}               - Get product details
PUT  /v1/product/{id}               - Update product
DELETE /v1/product/{id}             - Delete product
```

### Tasks
```
GET  /v1/task                       - List available tasks
GET  /v1/task/{id}                  - Task details
POST /v1/task                       - Create task (advertiser)
POST /v1/task/{id}/complete         - Submit task completion proof
GET  /v1/task/history               - User's task history
```

### Advertise
```
POST /v1/advertise                  - Create advert
GET  /v1/advertise                  - List adverts
GET  /v1/advertise/{id}             - Advert details
POST /v1/advertise/{id}/update      - Update advert
GET  /v1/advertise/performance/{id} - Performance analytics
```

### Chat
```
GET  /v1/chat/conversations         - Get all chats
POST /v1/chat/send                  - Send message
GET  /v1/chat/messages/{conversationId} - Get conversation
```

### Other
```
GET  /v1/category                   - Product categories
GET  /roles                         - User roles
GET  /banks                         - Bank list (Paystack)
POST /v1/kyc                        - Submit KYC
POST /v1/referral                   - Generate referral link
GET  /v1/notification               - Get notifications
POST /v1/withdrawal                 - Request withdrawal
```

---

## 🔄 State Management (Redux)

### Auth Slice
```typescript
{
  value: {
    id: string
    email: string
    name: string
    lname: string
    balance: number
    is_member: boolean
    email_verified_at: timestamp | null
    avatar?: string
    how_you_want_to_use?: string
    // ... other user data
  }
}
```

### Cart Slice
```typescript
{
  value: CartProduct[]
}
```

---

## 🎯 User Flows

### New User Journey
1. Register on main website → Email verification
2. Login to dashboard
3. Complete profile → Verify email
4. Choose how to use platform (earn/advertise/sell)
5. Upgrade to member (optional, ₦1,000)
6. Start earning through tasks/adverts/marketplace/reselling

### Task Completion Flow
1. User browses available tasks
2. Selects task with specific requirements
3. Completes task on external platform
4. Submits proof of completion
5. Admin verifies
6. Payment credited to wallet

### Product Selling Flow
1. Seller lists product on marketplace
2. Sets price and commission for resellers
3. Buyers browse and purchase
4. Seller ships product
5. Seller receives payment (minus platform fee)
6. Resellers can share link for commission

### Advertising Flow
1. Advertiser chooses advert or engagement task
2. Pays setup fee + task rewards budget
3. Tasks displayed to users
4. Users complete tasks
5. Advertiser sees performance metrics
6. Payment withdrawn after completion

---

## 🔐 Security Features

1. **Token-based Auth**: Laravel Sanctum (Bearer tokens)
2. **Email Verification**: Required for account access
3. **KYC Verification**: Required for withdrawals
4. **Bank Account Verification**: For withdrawal payments
5. **Rate Limiting**: API protection
6. **Password Hashing**: Bcrypt hashing
7. **CORS**: Cross-origin requests controlled
8. **Sanctum Tokens**: Token expiration and refresh

---

## 📱 Responsive Design

- **Mobile-first approach**: Tailwind CSS responsive classes
- **Breakpoints**: XS, SM, MD, LG, XL
- **Mobile Components**: Optimized mobile navigation
- **Adaptive Layouts**: Different layouts for different screen sizes

---

## 🔌 Real-time Features

### Pusher Integration
- Real-time notifications
- Live chat messaging
- Live task/order updates
- Real-time balance updates

### Broadcasting Channels
- User-specific channels
- Global notification channels
- Chat channels

---

## 📊 Performance Optimizations

1. **Lazy Loading**: Pages loaded on-demand with `React.lazy()`
2. **Code Splitting**: Routes split for faster initial load
3. **Asset Optimization**: Images, fonts served from CDN
4. **Cloudinary**: Image optimization and hosting
5. **SuspenseFallback**: Page loader while routes load

---

## 🚀 Deployment

### Frontend (Vercel)
- Automatic deployments on git push
- Environment variables configured
- API endpoints configurable per environment

### Backend (Railway/Render)
- PostgreSQL database
- Laravel application
- Scheduled tasks for notifications
- Webhook receivers (Paystack)

---

## 📝 Key Workflows

### Complete App Workflow:
```
User Registration
    ↓
Email Verification
    ↓
Login to Dashboard
    ↓
Choose Usage Method
    ↓
Optional: Upgrade to Member
    ↓
Connect Social Accounts (optional)
    ↓
Verify KYC (for withdrawals)
    ↓
Update Bank Details (for withdrawals)
    ↓
↓
├─ Earn Tasks
│   ├─ Browse Available Tasks
│   ├─ Complete Task Requirements
│   ├─ Submit Proof
│   └─ Get Payment
│
├─ Post Adverts
│   ├─ Create Advert Campaign
│   ├─ Set Budget & Duration
│   ├─ Users Complete Tasks
│   └─ Track Performance
│
├─ Sell Products
│   ├─ List Products
│   ├─ Buyers Purchase
│   ├─ Track Performance
│   └─ Get Commission
│
├─ Resell
│   ├─ Generate Reseller Link
│   ├─ Share Link
│   ├─ Track Conversions
│   └─ Earn Commission
│
└─ Refer Friends
    ├─ Share Referral Link
    ├─ Friend Signs Up
    └─ Earn ₦500 + Commission
    
↓
Withdraw Earnings to Bank Account
```

---

## 🎨 UI/UX Highlights

1. **Dark Mode Support**: Toggle between light/dark themes
2. **Toast Notifications**: User feedback via Sonner
3. **Modal Dialogs**: HeroUI modals for important actions
4. **Loading States**: Spinner animations during async operations
5. **Empty States**: Clear messaging when no data
6. **Error Handling**: User-friendly error messages
7. **Form Validation**: React Hook Form with error displays
8. **Animations**: Smooth transitions with Framer Motion

---

## 🔗 Navigation Structure

### Main Menu Items
1. **Dashboard** - Home page
2. **Earn** - Task completion, adverts, reselling
3. **Advertise** - Create advert campaigns
4. **Marketplace** - Buy/sell products
5. **Add Me Up** - Social promotion
6. **Refer & Earn** - Referral program
7. **Account Settings** - Profile, password, bank details, KYC

### Header Menu
- Notifications bell
- Cart (if enabled)
- User profile dropdown
- Logout

---

## 💡 Key Insights

### Revenue Streams (for Hovertask)
1. **Membership**: ₦1,000 one-time fee per member
2. **Task Commissions**: % of task budget
3. **Advert Fees**: Setup + budget from advertisers
4. **Platform Fees**: % on marketplace transactions
5. **Reseller Commission**: % on reseller sales

### Revenue Streams (for Users)
1. **Task Completion**: Get paid for completing tasks
2. **Advertising Budget**: If posting adverts for users
3. **Product Sales**: Marketplace commissions
4. **Reselling**: Commission on each sale
5. **Referrals**: ₦500 per referral + % on referred user purchases
6. **Social Promotion**: Get followers/likes for accounts

---

## 🎯 Development Notes

### Configuration Files
- `vite.config.ts` - Vite build configuration
- `tailwind.config.js` - Tailwind CSS theme
- `tsconfig.json` - TypeScript configuration
- `eslint.config.js` - ESLint rules
- `.env` - Environment variables (not in repo)

### Development Commands
```bash
# Frontend
npm run dev          # Start dev server
npm run build        # Production build
npm run lint         # Run ESLint
npm run preview      # Preview production build

# Backend
php artisan migrate  # Run migrations
php artisan tinker   # Interactive shell
php artisan queue:work # Process background jobs
```

---

## 🔮 Potential Features/Expansions

1. **Mobile App**: Native iOS/Android apps
2. **Advanced Analytics**: More detailed performance metrics
3. **AI Recommendations**: Suggest tasks/products to users
4. **Live Streaming**: Live shopping/marketplace
5. **Premium Tiers**: Different membership levels
6. **Gamification**: Points, badges, leaderboards
7. **Video Tasks**: Video submission requirements
8. **API for Partners**: Third-party integrations
9. **Cryptocurrency**: Crypto payments/withdrawals
10. **Multilingual**: Support multiple languages

---

## 📞 Support & Documentation

- **Email**: For technical issues and support
- **In-app Chat**: Direct seller/support communication
- **FAQ**: Available in support section
- **Terms & Privacy**: Legal information pages

---

## Summary

**Hovertask** is a sophisticated multi-sided platform that connects task providers, advertisers, product sellers, and users looking to earn money. The architecture supports complex user roles, real-time updates, financial transactions, and social integrations. The frontend provides a seamless user experience with multiple earning opportunities, while the Laravel backend handles authentication, payments, marketplace operations, and real-time communication.

The platform's key differentiator is its multi-revenue model allowing users to earn through various methods simultaneously, making it a comprehensive "gig economy" platform for the African market.
