# 🏗️ COMPLETE BACKEND REBUILD - ARCHITECTURE DIAGRAM

## System Architecture

```
╔════════════════════════════════════════════════════════════════════════╗
║                         HOVERTASK PLATFORM                            ║
╚════════════════════════════════════════════════════════════════════════╝

┌─────────────────────────────────────────────────────────────────────────┐
│                          FRONTEND LAYER                                 │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                          │
│  ┌──────────────────────────┐    ┌──────────────────────────┐          │
│  │   React Dashboard        │    │   React Main Site        │          │
│  │   (Port 5173)            │    │   (Port 5174)            │          │
│  │                          │    │                          │          │
│  │  • Login/Register        │    │  • Landing Page          │          │
│  │  • User Profile          │    │  • Product Browsing      │          │
│  │  • Dashboard             │    │  • Marketplace           │          │
│  │  • Tasks/Adverts         │    │  • User Registration     │          │
│  │  • Wallet                │    │  • Public Info           │          │
│  └──────────────────┬───────┘    └──────────────┬───────────┘          │
│                     │                            │                      │
│                     └────────────┬────────────────┘                      │
│                                  │                                       │
│                     HTTP + Bearer Token (Sanctum)                       │
│                                  │                                       │
└──────────────────────────────────┼───────────────────────────────────────┘
                                   │
                    ┌──────────────▼───────────────┐
                    │     CORS Middleware         │
                    │  (localhost:5173, 5174)     │
                    └──────────────┬───────────────┘
                                   │
┌──────────────────────────────────▼───────────────────────────────────────┐
│                          API LAYER (Laravel)                             │
│                         (Port 8000)                                      │
├──────────────────────────────────────────────────────────────────────────┤
│                                                                           │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                      PUBLIC ROUTES                              │   │
│  ├─────────────────────────────────────────────────────────────────┤   │
│  │                                                                   │   │
│  │  POST   /api/auth/register                                      │   │
│  │         ├─ Validate input (fname, lname, email, password)      │   │
│  │         ├─ Hash password (bcrypt)                               │   │
│  │         ├─ Create user                                          │   │
│  │         └─ Return token + user data                             │   │
│  │                                                                   │   │
│  │  POST   /api/auth/login                                         │   │
│  │         ├─ Validate email/password                              │   │
│  │         ├─ Create Sanctum token                                │   │
│  │         └─ Return token + user data                             │   │
│  │                                                                   │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                                                           │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                  PROTECTED ROUTES (auth:sanctum)                │   │
│  ├─────────────────────────────────────────────────────────────────┤   │
│  │                                                                   │   │
│  │  POST   /api/auth/logout                                        │   │
│  │         ├─ Verify token                                         │   │
│  │         └─ Invalidate token                                     │   │
│  │                                                                   │   │
│  │  GET    /api/auth/user                                          │   │
│  │         ├─ Verify token (middleware)                            │   │
│  │         └─ Return current user profile                          │   │
│  │                                                                   │   │
│  │  PUT    /api/auth/update-profile                                │   │
│  │         ├─ Verify token                                         │   │
│  │         ├─ Validate update data                                 │   │
│  │         ├─ Update user record                                   │   │
│  │         └─ Return updated user                                  │   │
│  │                                                                   │   │
│  │  POST   /api/auth/change-password                               │   │
│  │         ├─ Verify token                                         │   │
│  │         ├─ Check current password                               │   │
│  │         ├─ Validate new password                                │   │
│  │         ├─ Update password (bcrypt hash)                        │   │
│  │         └─ Return success message                               │   │
│  │                                                                   │   │
│  │  GET    /api/dashboard                                          │   │
│  │         ├─ Verify token                                         │   │
│  │         ├─ Get user data                                        │   │
│  │         ├─ Calculate statistics                                 │   │
│  │         └─ Return dashboard data                                │   │
│  │                                                                   │   │
│  │  GET    /api/dashboard/user                                     │   │
│  │         ├─ Verify token                                         │   │
│  │         └─ Return user info for dashboard                       │   │
│  │                                                                   │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                                                           │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                      CONTROLLERS                                 │   │
│  ├─────────────────────────────────────────────────────────────────┤   │
│  │                                                                   │   │
│  │  AuthController (app/Http/Controllers/Api/)                     │   │
│  │  ├─ register()          - New user registration                 │   │
│  │  ├─ login()             - User authentication                   │   │
│  │  ├─ user()              - Get current user                      │   │
│  │  ├─ updateProfile()     - Update user info                      │   │
│  │  ├─ changePassword()    - Change password                       │   │
│  │  └─ logout()            - Logout user                           │   │
│  │                                                                   │   │
│  │  DashboardController (app/Http/Controllers/Api/)               │   │
│  │  ├─ dashboard()         - Get dashboard data                    │   │
│  │  └─ user()              - Get user for dashboard                │   │
│  │                                                                   │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                                                           │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                      MIDDLEWARE                                  │   │
│  ├─────────────────────────────────────────────────────────────────┤   │
│  │                                                                   │   │
│  │  auth:sanctum                                                    │   │
│  │  ├─ Checks request for valid token                              │   │
│  │  ├─ Verifies token hasn't expired                               │   │
│  │  ├─ Loads authenticated user                                    │   │
│  │  └─ Denies access if invalid                                    │   │
│  │                                                                   │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                                                           │
│  ┌─────────────────────────────────────────────────────────────────┐   │
│  │                    RESPONSE FORMAT                               │   │
│  ├─────────────────────────────────────────────────────────────────┤   │
│  │                                                                   │   │
│  │  Success Response:                                               │   │
│  │  {                                                                │   │
│  │    "status": true,                                               │   │
│  │    "message": "Operation successful",                            │   │
│  │    "data": { ... }                                               │   │
│  │  }                                                                │   │
│  │                                                                   │   │
│  │  Error Response:                                                 │   │
│  │  {                                                                │   │
│  │    "status": false,                                              │   │
│  │    "message": "Error message",                                   │   │
│  │    "errors": { ... }                                             │   │
│  │  }                                                                │   │
│  │                                                                   │   │
│  └─────────────────────────────────────────────────────────────────┘   │
│                                                                           │
└──────────────────────────────────────────────────────────────────────────┘
                                   │
                    ┌──────────────▼───────────────┐
                    │    Eloquent ORM              │
                    │   (Security & Validation)    │
                    └──────────────┬───────────────┘
                                   │
┌──────────────────────────────────▼───────────────────────────────────────┐
│                      DATABASE LAYER (MySQL)                              │
├──────────────────────────────────────────────────────────────────────────┤
│                                                                           │
│  MAMP MySQL Server (Port 3306)                                           │
│  Database: hovertask                                                     │
│                                                                           │
│  ┌──────────────────────────────┐   ┌──────────────────────────────┐   │
│  │      Users Table             │   │   Personal Access Tokens     │   │
│  ├──────────────────────────────┤   ├──────────────────────────────┤   │
│  │ • id                          │   │ • id                         │   │
│  │ • fname                       │   │ • tokenable_id               │   │
│  │ • lname                       │   │ • tokenable_type             │   │
│  │ • username                    │   │ • name                       │   │
│  │ • email                       │   │ • token (hashed)             │   │
│  │ • phone                       │   │ • abilities                  │   │
│  │ • password (hashed - bcrypt)  │   │ • last_used_at               │   │
│  │ • country                     │   │ • expires_at                 │   │
│  │ • currency                    │   │ • created_at                 │   │
│  │ • avatar                      │   │ • updated_at                 │   │
│  │ • is_member                   │   │                              │   │
│  │ • email_verified_at           │   │ Relationships:               │   │
│  │ • created_at                  │   │ • Belongs to User            │   │
│  │ • updated_at                  │   │ • One-to-Many with Tokens    │   │
│  │                               │   │                              │   │
│  │ Relationships:                │   │ Features:                    │   │
│  │ • Has Many Tokens             │   │ • Unique per user            │   │
│  │ • Has Many Tasks              │   │ • Can be invalidated         │   │
│  │ • Has Many Adverts            │   │ • Supports expiration        │   │
│  │ • Has Many Products           │   │ • Secure storage             │   │
│  │                               │   │                              │   │
│  └──────────────────────────────┘   └──────────────────────────────┘   │
│                                                                           │
└──────────────────────────────────────────────────────────────────────────┘

```

---

## Authentication Flow

```
┌─────────────────────────────────────────────────────────────┐
│                   USER REGISTRATION                         │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  1. User submits registration form (frontend)               │
│     ├─ fname, lname, username, email, phone, password       │
│                                                              │
│  2. POST /api/auth/register                                 │
│     ├─ AuthController::register()                           │
│     ├─ Validate all fields                                  │
│     ├─ Check email uniqueness                               │
│     ├─ Hash password (bcrypt)                               │
│     ├─ Create user in database                              │
│     ├─ Generate Sanctum token                               │
│     └─ Return token + user data                             │
│                                                              │
│  3. Frontend stores token (localStorage)                    │
│                                                              │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                    USER LOGIN                               │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  1. User submits login form (frontend)                      │
│     ├─ email, password                                      │
│                                                              │
│  2. POST /api/auth/login                                    │
│     ├─ AuthController::login()                              │
│     ├─ Validate email & password                            │
│     ├─ Find user by email                                   │
│     ├─ Verify password against hash                         │
│     ├─ Generate Sanctum token                               │
│     └─ Return token + user data                             │
│                                                              │
│  3. Frontend stores token (localStorage)                    │
│                                                              │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│              ACCESSING PROTECTED ROUTES                     │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  1. Frontend makes request to protected route               │
│     ├─ Includes: Authorization: Bearer TOKEN               │
│                                                              │
│  2. Laravel Middleware checks:                              │
│     ├─ Token exists in header                               │
│     ├─ Token is valid (not expired, not revoked)           │
│     ├─ Token belongs to a user                              │
│     └─ Token matches database record                        │
│                                                              │
│  3. If valid:                                               │
│     ├─ Load authenticated user                              │
│     ├─ Execute controller method                            │
│     └─ Return user-specific data                            │
│                                                              │
│  4. If invalid:                                             │
│     ├─ Return 401 Unauthorized                              │
│     └─ Clear frontend token                                 │
│                                                              │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                   USER LOGOUT                               │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  1. Frontend sends logout request                           │
│     ├─ POST /api/auth/logout                                │
│     ├─ Authorization: Bearer TOKEN                          │
│                                                              │
│  2. AuthController::logout()                                │
│     ├─ Verify token is valid                                │
│     ├─ Delete token from database                           │
│     ├─ Invalidate token                                     │
│     └─ Return success message                               │
│                                                              │
│  3. Frontend removes token (localStorage)                   │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

---

## Request/Response Cycle

```
FRONTEND                           API                        DATABASE
   │                               │                             │
   │─── POST /auth/register ──────>│                             │
   │  {                            │                             │
   │    email: "user@test.com"    │                             │
   │    password: "pass123"        │                             │
   │  }                            │                             │
   │                               │                             │
   │                          [Validate]                         │
   │                               │                             │
   │                               │─── Hash password ──────────>│
   │                               │                             │
   │                               │<── Hash returned ───────────│
   │                               │                             │
   │                          [Create User]                      │
   │                               │                             │
   │                               │─── INSERT INTO users ─────>│
   │                               │                             │
   │                               │<── User ID returned ────────│
   │                               │                             │
   │                          [Generate Token]                   │
   │                               │                             │
   │                               │─── INSERT INTO tokens ─────>│
   │                               │                             │
   │                               │<── Token returned ──────────│
   │                               │                             │
   │<─── {status, token, user} ────│                             │
   │                               │                             │
   │ [Store Token]                 │                             │
   │                               │                             │
   │─── GET /auth/user ────────────>│                             │
   │ Header: Authorization: Bearer │                             │
   │                               │                             │
   │                          [Validate Token]                   │
   │                               │                             │
   │                               │─── SELECT FROM tokens ────>│
   │                               │                             │
   │                               │<── Token record returned ───│
   │                               │                             │
   │                               │─── SELECT FROM users ─────>│
   │                               │                             │
   │                               │<── User record returned ────│
   │                               │                             │
   │<─── {status, user} ───────────│                             │
   │                               │                             │
```

---

## Security Features

```
┌────────────────────────────────────────────────────────────────┐
│                   SECURITY MEASURES                            │
├────────────────────────────────────────────────────────────────┤
│                                                                 │
│  1. PASSWORD SECURITY                                          │
│     ├─ Stored as bcrypt hash (not plain text)                 │
│     ├─ Never transmitted over insecure connection             │
│     ├─ Only validated against hash (not reversed)             │
│     └─ Minimum password requirements enforced                 │
│                                                                 │
│  2. TOKEN SECURITY                                             │
│     ├─ Generated by Sanctum (cryptographically secure)        │
│     ├─ Stored in database (indexed for quick lookup)          │
│     ├─ Can be invalidated on logout                           │
│     ├─ Can have expiration time                               │
│     └─ One token per user per device (optional)               │
│                                                                 │
│  3. INPUT VALIDATION                                           │
│     ├─ All inputs validated before database operations        │
│     ├─ Email format validation                                │
│     ├─ Password strength requirements                         │
│     ├─ Username uniqueness check                              │
│     └─ Phone format validation                                │
│                                                                 │
│  4. CORS PROTECTION                                            │
│     ├─ Whitelisted domains only (5173, 5174, etc.)           │
│     ├─ Prevents unauthorized cross-origin requests           │
│     ├─ Credentials required for CORS requests                │
│     └─ Pre-flight requests handled                            │
│                                                                 │
│  5. SQL INJECTION PREVENTION                                   │
│     ├─ Using Eloquent ORM (parameterized queries)            │
│     ├─ No raw SQL concatenation                               │
│     ├─ All inputs escaped automatically                       │
│     └─ Prepared statements used                               │
│                                                                 │
│  6. ERROR HANDLING                                             │
│     ├─ No sensitive info exposed in errors                    │
│     ├─ Generic error messages to users                        │
│     ├─ Detailed logs stored securely                          │
│     └─ Try-catch blocks on all operations                     │
│                                                                 │
└────────────────────────────────────────────────────────────────┘
```

---

## File Structure

```
laravel-MKpr/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php         ✅ NEW
│   │   │       ├── DashboardController.php    ✅ NEW
│   │   │       └── ...
│   │   └── Middleware/
│   │       └── auth:sanctum
│   │
│   ├── Models/
│   │   └── User.php
│   │       └── HasApiTokens trait (Sanctum)
│   │
│   └── ...
│
├── database/
│   ├── seeders/
│   │   ├── TestUserSeeder.php    ✅ NEW
│   │   └── ...
│   │
│   └── migrations/
│       └── create_personal_access_tokens_table
│
├── routes/
│   └── api.php                   ✅ UPDATED
│
├── config/
│   ├── cors.php                  ✅ Configured
│   └── sanctum.php               ✅ Configured
│
└── ...
```

---

## Status Summary

| Component | Status | Details |
|-----------|--------|---------|
| AuthController | ✅ Ready | 6 methods, all working |
| DashboardController | ✅ Ready | 2 methods, all working |
| Routes | ✅ Ready | 8 endpoints configured |
| Middleware | ✅ Ready | auth:sanctum protecting routes |
| Database | ✅ Ready | MySQL connected, tables exist |
| Validation | ✅ Ready | All inputs validated |
| Security | ✅ Ready | Password hashing, token-based auth |
| CORS | ✅ Ready | Configured for frontend access |
| Testing | ✅ Ready | Test users created, curl ready |

---

**Everything is ready for immediate testing and deployment!** 🚀
