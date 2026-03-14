# 🎯 Hovertask Setup - Visual Guide & Terminal Arrangement

## 📺 Terminal Arrangement (Recommended)

Arrange your screen with 4 terminals:

```
┌─────────────────────────────────────────────┬──────────────────────────────┐
│                                             │                              │
│  Terminal 1: Laravel Backend                │  Terminal 2: React Dashboard │
│  =====================================       │  ════════════════════════════│
│  $ cd laravel-MKpr                          │  $ cd hovertask-dashboard    │
│  $ php artisan serve                        │  $ npm run dev               │
│                                             │                              │
│  ➜ Server running on                        │  ➜ Local: http://localhost:  │
│    http://127.0.0.1:8000                    │    5173                      │
│                                             │                              │
│  [waiting for requests]                     │  [bundling assets]           │
│                                             │                              │
│                                             │                              │
└─────────────────────────────────────────────┴──────────────────────────────┘

┌─────────────────────────────────────────────┬──────────────────────────────┐
│                                             │                              │
│  Terminal 3: Laravel Logs (Optional)        │  Terminal 4: Browser Window  │
│  =====================================       │  ════════════════════════════│
│  $ tail -f laravel-MKpr/storage/logs/       │  http://localhost:5173       │
│    laravel.log                              │                              │
│                                             │  Login Page                  │
│  [real-time log output]                     │  ├─ Email input              │
│                                             │  ├─ Password input           │
│  [INFO] Server started                      │  ├─ Login button             │
│  [DEBUG] User authenticated                 │  └─ Forgot password link     │
│  [INFO] Database query executed             │                              │
│                                             │  [F12 for DevTools]          │
│                                             │                              │
└─────────────────────────────────────────────┴──────────────────────────────┘
```

---

## 🚀 Step-by-Step Visual Guide

### Phase 1: Prerequisites (Check These)

```
┌─────────────────────────────────────┐
│  Prerequisites Checklist             │
├─────────────────────────────────────┤
│ ✓ MAMP installed                    │  /Applications/MAMP/
│ ✓ Node.js v18+                      │  node -v → v18.0+
│ ✓ npm v9+                           │  npm -v → v9.0+
│ ✓ Composer v2+                      │  composer -v → Composer 2.x
│ ✓ Git                               │  git -v → latest
│ ✓ PHP 8.2+                          │  php -v → 8.2+
└─────────────────────────────────────┘
```

### Phase 2: Start MAMP

```
┌─────────────────────────────────┐
│  MAMP Dashboard                  │
├─────────────────────────────────┤
│                                 │
│  [Start Servers] ←─ Click this  │
│                                 │
│  Apache Server:     ✓ Running   │
│  MySQL Server:      ✓ Running   │
│  PostgreSQL Server: ○ Stopped   │
│                                 │
│  Ports:                         │
│  Apache: 8888                   │
│  MySQL:  3306                   │
│                                 │
│  ✓ Ready!                       │
└─────────────────────────────────┘
```

### Phase 3: Run Automated Setup

```
$ cd /Users/user/Desktop/hovertask
$ bash setup.sh

════════════════════════════════════════
  Checking Prerequisites
════════════════════════════════════════

✓ Node.js installed: v18.12.0
✓ npm installed: v9.6.0
✓ Composer installed: Composer 2.5.0
✓ Git installed: git version 2.38.0
✓ MAMP found at /Applications/MAMP

════════════════════════════════════════
  Setting Up Laravel Backend
════════════════════════════════════════

ℹ Installing Composer dependencies...
✓ Composer dependencies installed
ℹ Creating .env file...
✓ .env file created
ℹ Generating Laravel application key...
✓ Application key generated
ℹ Configuring .env for local development...
✓ .env configured
ℹ Creating storage link...
✓ Storage link created
ℹ Running database migrations...
✓ Database migrations completed
ℹ Creating test user...
✓ Test user created

════════════════════════════════════════
  Setting Up React Dashboard
════════════════════════════════════════

ℹ Installing npm dependencies...
✓ Dependencies installed
ℹ Creating .env.local...
✓ .env.local created

════════════════════════════════════════
  ✅ Setup Complete!
════════════════════════════════════════

Terminal 1 - Laravel Backend:
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve

Terminal 2 - React Dashboard:
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev

Test Credentials:
Email: test@hovertask.com
Password: password123

Access URLs:
Dashboard: http://localhost:5173
Laravel API: http://localhost:8000

Happy coding! 🚀
```

### Phase 4: Open Terminals

```
Terminal 1                    Terminal 2                   Terminal 3
├─ Laravel Backend            ├─ React Dashboard           ├─ Logs (Optional)
├─                            ├─                           ├─
├─ $ cd laravel-MKpr          ├─ $ cd hovertask-dashboard  ├─ $ tail -f \
├─ $ php artisan serve        ├─ $ npm run dev             │   laravel-MKpr/\
├─                            ├─                           │   storage/logs/\
├─ Server running at:         ├─ Vite Dev Server:          │   laravel.log
│  http://127.0.0.1:8000      │  http://localhost:5173     ├─
│                             │                           ├─ [Real-time log
│ [ready]                     │ [ready]                    │  output here]
```

### Phase 5: Open Browser

```
URL Bar: http://localhost:5173
         ↓
┌────────────────────────────────┐
│  Hovertask Dashboard           │
├────────────────────────────────┤
│                                │
│  [   Email/Phone   ]           │
│  test@hovertask.com            │
│                                │
│  [   Password   ]              │
│  ••••••••••••••••              │
│                                │
│  [ Sign In ]                   │
│  [ Forgot Password ]           │
│                                │
└────────────────────────────────┘
         ↓
    [Click Sign In]
         ↓
┌────────────────────────────────┐
│  Dashboard Home                │
├────────────────────────────────┤
│  Welcome Back, Test User!      │
│                                │
│  Balance: ₦50,000              │
│                                │
│  ├─ Dashboard                  │
│  ├─ Earn                       │
│  ├─ Advertise                  │
│  ├─ Marketplace                │
│  ├─ Profile                    │
│  └─ Logout                     │
│                                │
│  [Ready to use! ✓]             │
└────────────────────────────────┘
```

---

## 🔍 Debugging Visual Map

```
Problem Encountered
        ↓
    [Is it shown in browser?]
        ├─ YES → Check F12 Console for errors
        │        │
        │        └─→ Red error messages
        │            ├─ CORS error? → Check .env CORS_ALLOWED_ORIGINS
        │            ├─ 404 error? → Check Laravel routes
        │            ├─ API error? → Check Laravel logs
        │            └─ State error? → Check Redux
        │
        └─ NO → Check Terminal for errors
                 │
                 ├─ Laravel Terminal → Check API logs
                 ├─ React Terminal → Check build errors
                 └─ Check laravel.log → See backend errors
```

---

## 📊 API Call Flow Diagram

```
User Action in Browser
    ↓
React Component
    ↓
Redux Dispatch
    ↓
Axios HTTP Request
    │
    ├─ POST /api/login
    ├─ GET /api/v1/dashboard/user
    └─ POST /api/v1/product
    ↓
Laravel Route Handler
    ↓
Controller Action
    ↓
Database Query (MySQL)
    ↓
Response JSON
    ↓
Browser Console (DevTools Network Tab)
    │
    ├─ Status: 200 OK ✓
    ├─ Status: 401 Unauthorized
    ├─ Status: 403 Forbidden
    ├─ Status: 404 Not Found
    └─ Status: 500 Error
    ↓
Redux Store Updated
    ↓
Component Re-renders
    ↓
User Sees Result
```

---

## 🔐 Authentication Flow

```
Login Form
    ↓
Enter: test@hovertask.com
       password123
    ↓
[Sign In Button Click]
    ↓
POST /api/login
    │
    ├─ Backend validates credentials
    ├─ Generates Sanctum token
    └─ Returns token + user data
    ↓
Frontend Storage
    │
    ├─ localStorage.setItem('auth_token', token)
    ├─ Redux: setAuthUser(user)
    └─ Update axios default header
    ↓
Redirect to Dashboard
    ↓
Dashboard loads
    │
    ├─ Checks auth token
    ├─ Fetches user data
    └─ Displays dashboard
    ↓
[Success! You're logged in]
```

---

## 🗂️ Database Schema Overview

```
┌─────────────────────────────────────────────┐
│        hovertask_local Database              │
├─────────────────────────────────────────────┤
│                                             │
│  Users & Auth                               │
│  ├─ users                ← Test user here   │
│  ├─ personal_access_tokens                  │
│  └─ email_verification_codes                │
│                                             │
│  Wallet & Payments                          │
│  ├─ wallets              ← Balance: 50000   │
│  ├─ transactions                            │
│  ├─ funds_records                           │
│  └─ paystack_recipients                     │
│                                             │
│  Tasks & Engagement                         │
│  ├─ tasks                                   │
│  ├─ user_tasks                              │
│  └─ completed_tasks                         │
│                                             │
│  Marketplace                                │
│  ├─ products                                │
│  ├─ product_images                          │
│  ├─ orders                                  │
│  ├─ cart                                    │
│  └─ reviews                                 │
│                                             │
│  Communication                              │
│  ├─ conversations                           │
│  ├─ messages                                │
│  └─ notifications                           │
│                                             │
└─────────────────────────────────────────────┘
```

---

## 🔧 Development Workflow

```
Start of Day
    ↓
[Open Terminal 1]
└─→ cd laravel-MKpr && php artisan serve
    ↓
    Ready at http://localhost:8000
    ↓
[Open Terminal 2]
└─→ cd hovertask-dashboard && npm run dev
    ↓
    Ready at http://localhost:5173
    ↓
[Open Browser]
└─→ http://localhost:5173
    ↓
    Login with test credentials
    ↓
[Open DevTools] (F12)
└─→ Monitor Console & Network tabs
    ↓
[Edit Code]
├─→ React files → Hot reload automatic
├─→ Laravel files → Manual refresh needed
└─→ CSS → Hot reload automatic
    ↓
[Test in Browser]
├─→ Click through features
├─→ Check console for errors
└─→ Check network for API calls
    ↓
[Debug if Needed]
├─→ Read browser console errors
├─→ Check Laravel logs
├─→ Use DevTools Network tab
└─→ Use phpMyAdmin for database
    ↓
[When Done]
└─→ Ctrl+C in terminals to stop servers
```

---

## 🎯 Quick Visual Reference

### Services Status Check

```
✓ = Running    ✗ = Not Running

MAMP
  Apache: ✓ (Green checkmark in app)
  MySQL: ✓ (Green checkmark in app)
  
Laravel
  Terminal: ✓ (Shows "Server running on...")
  API: ✓ (http://localhost:8000 accessible)
  
React
  Terminal: ✓ (Shows "Local: http://localhost:5173")
  Frontend: ✓ (http://localhost:5173 accessible)
  
Database
  Tables: ✓ (phpMyAdmin shows tables)
  User: ✓ (Can see test@hovertask.com)
  
Browser
  Console: ✓ (No red errors)
  Network: ✓ (API calls show 200 status)
```

---

**Use this visual guide to arrange your workspace!** 🎯
