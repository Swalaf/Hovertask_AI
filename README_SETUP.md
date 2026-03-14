# 🎯 Hovertask - Local Development Setup

Welcome! This guide will get you running the complete Hovertask platform locally with MAMP in about 20 minutes.

---

## 📚 Documentation Files

We've created comprehensive guides for you:

| File | Purpose | Read When |
|------|---------|-----------|
| **QUICK_START.md** | 5-minute quick reference | First time, just want to run it |
| **MANUAL_SETUP.md** | Detailed step-by-step guide | Want full control & understanding |
| **LOCAL_SETUP_GUIDE.md** | Comprehensive setup documentation | Reference guide |
| **WEBSITE_ARCHITECTURE.md** | System design & architecture | Want to understand the platform |

---

## ⚡ Super Quick Start (Recommended)

### Prerequisites
- MAMP installed: https://www.mamp.info/en/mac/
- Node.js v18+
- Composer
- Git

### 3-Step Setup

**Step 1: Start MAMP (1 min)**
- Open MAMP.app → Click "Start Servers"

**Step 2: Run Setup (5 min)**
```bash
cd /Users/user/Desktop/hovertask
bash setup.sh
```

**Step 3: Start Services (3 terminals)**

Terminal 1:
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve
```

Terminal 2:
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev
```

Terminal 3 (Optional):
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev
```

**Done!** Visit http://localhost:5173 and login with:
- Email: `test@hovertask.com`
- Password: `password123`

---

## 🎯 What's Running

Once everything starts, you have:

| Service | URL | Purpose |
|---------|-----|---------|
| **React Dashboard** | http://localhost:5173 | Main app for users |
| **React Marketing** | http://localhost:5174 | Landing/marketing site |
| **Laravel API** | http://localhost:8000 | Backend API server |
| **MAMP** | http://localhost:8888/MAMP/ | Database & server management |
| **phpMyAdmin** | http://localhost:8888/phpMyAdmin/ | Database GUI (user: root, pass: root) |

---

## 🏗️ Architecture Overview

```
┌─────────────────────────────────────────────────────┐
│              User's Browser                         │
│  http://localhost:5173 (React Dashboard)            │
└────────────────────┬────────────────────────────────┘
                     │ Axios HTTP Requests
                     ▼
┌─────────────────────────────────────────────────────┐
│          Laravel API Server                         │
│          http://localhost:8000                      │
│  (Authentication, Tasks, Marketplace, etc.)         │
└────────────────────┬────────────────────────────────┘
                     │ SQL Queries
                     ▼
┌─────────────────────────────────────────────────────┐
│           PostgreSQL/MySQL Database                 │
│         (Running via MAMP)                          │
│         Database: hovertask_local                   │
└─────────────────────────────────────────────────────┘
```

---

## 📋 What's Included

### Frontend (React)
- Dashboard application (hovertask-dashboard)
- Marketing website (Hovertask-main)
- State management with Redux
- Tailwind CSS styling
- Real-time notifications via Pusher

### Backend (Laravel)
- REST API endpoints
- User authentication (Sanctum)
- Database models & migrations
- Task & product management
- Payment processing (Paystack)
- Real-time broadcasting

### Database
- PostgreSQL or MySQL
- 40+ tables for complete functionality
- Seeders for test data

---

## 🔐 Test Account

Use these credentials to login:

```
Email:    test@hovertask.com
Password: password123

Account Details:
- Balance: ₦50,000
- Status: Premium Member ✓
- Email Verified: ✓
```

---

## 🚀 Starting Services

### Method 1: Individual Terminals (Recommended for Development)

**Terminal 1 - Laravel:**
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve
```

**Terminal 2 - Dashboard:**
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev
```

**Terminal 3 - Marketing (Optional):**
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev
```

### Method 2: Combined Script (All-in-one)

```bash
cd /Users/user/Desktop/hovertask
bash start.sh
```

This starts all services in one command (though you can't see individual logs).

---

## 🧪 Testing the Application

### Verify Everything is Running

1. **Check MAMP**: http://localhost:8888/MAMP/
   - Apache: ✓
   - MySQL: ✓

2. **Check API**: 
   - Terminal should show: `Server running on http://127.0.0.1:8000`

3. **Check React**: 
   - Terminal should show: `Local: http://localhost:5173/`

### Test User Login

1. Visit: http://localhost:5173
2. You may redirect to sign-in page
3. Enter test credentials
4. Should see dashboard with balance ₦50,000

### Test Features

Try these pages in the dashboard:
- ✓ Dashboard (home)
- ✓ Earn section
- ✓ Advertise section
- ✓ Marketplace
- ✓ Profile
- ✓ Wallet

All should load without errors.

---

## 🔍 Debugging

### View Console Errors
- Press **F12** in browser
- Go to **Console** tab
- Look for red error messages

### View Network Requests
- Press **F12** in browser
- Go to **Network** tab
- Refresh page to see API calls
- Click requests to see response

### View Laravel Logs
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

### View Database
- Visit: http://localhost:8888/phpMyAdmin/
- Username: root
- Password: root
- Database: hovertask_local

---

## 🛠️ Common Issues & Fixes

### Port Already in Use
```bash
# Find process on port 5173
lsof -i :5173

# Kill it
kill -9 <PID>
```

### CORS Error
Add to Laravel `.env` and restart:
```env
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://localhost:5174
```

### Database Connection Failed
```bash
# Check database exists
/Applications/MAMP/Library/bin/mysql -u root -p
# Password: root
# Then: CREATE DATABASE hovertask_local;
```

### Login Doesn't Work
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan migrate:fresh
# Then recreate test user via tinker
php artisan tinker
# Create test user...
```

### "npm ERR! code ERESOLVE"
```bash
npm install --legacy-peer-deps
```

---

## 📊 Project Structure

```
hovertask/
├── hovertask-dashboard/          # React frontend
│   ├── src/
│   │   ├── pages/               # Feature pages
│   │   ├── components/          # Shared components
│   │   ├── hooks/               # Custom React hooks
│   │   ├── redux/               # State management
│   │   └── utils/               # Helper functions
│   └── package.json
│
├── Hovertask-main/               # React marketing site
│   └── src/pages/               # Marketing pages
│
├── laravel-MKpr/                 # Laravel backend
│   ├── app/
│   │   ├── Models/              # Database models
│   │   ├── Http/Controllers/    # API controllers
│   │   └── Services/            # Business logic
│   ├── routes/api.php           # API routes
│   ├── database/migrations/     # Database schema
│   └── .env                     # Configuration
│
├── QUICK_START.md               # Quick reference
├── MANUAL_SETUP.md              # Step-by-step guide
├── LOCAL_SETUP_GUIDE.md         # Comprehensive guide
├── WEBSITE_ARCHITECTURE.md      # System design
├── setup.sh                     # Auto setup script
└── start.sh                     # Quick start script
```

---

## 🎓 Learning Path

1. **First**: Get it running (this guide)
2. **Second**: Read WEBSITE_ARCHITECTURE.md to understand the system
3. **Third**: Explore code starting with `src/App.tsx`
4. **Fourth**: Try modifying components and see hot-reload work
5. **Fifth**: Make your own features!

---

## 📝 Key Commands

```bash
# Laravel
php artisan serve                  # Start dev server
php artisan migrate               # Run migrations
php artisan tinker                # Interactive PHP shell
php artisan cache:clear           # Clear cache
php artisan db:seed               # Seed database
php artisan storage:link          # Link storage for uploads

# npm/React
npm run dev                        # Start dev server
npm run build                      # Production build
npm install                        # Install dependencies
npm run lint                       # Check code

# MAMP MySQL
/Applications/MAMP/Library/bin/mysql -u root -p

# Logs
tail -f storage/logs/laravel.log  # Watch Laravel logs
```

---

## 🎯 Next Steps After Setup

1. **Explore the UI**: Click around, familiarize yourself
2. **Read Architecture**: Understand how components work together
3. **Review Code**: Start with routing in App.tsx
4. **Make Changes**: Try editing a component to see hot-reload
5. **Study Database**: Check models in Laravel app/Models/
6. **Test Features**: Try task creation, marketplace, etc.

---

## ✅ Verification Checklist

Before you're done:

- [ ] MAMP running (Apache ✓, MySQL ✓)
- [ ] Laravel backend at http://localhost:8000
- [ ] React dashboard at http://localhost:5173
- [ ] Can login with test@hovertask.com
- [ ] Dashboard shows balance ₦50,000
- [ ] Can navigate between sections
- [ ] No red errors in console (F12)
- [ ] API calls showing status 200 in Network tab

---

## 📞 Help Resources

1. **Quick questions?** → Read QUICK_START.md
2. **Step-by-step help?** → Read MANUAL_SETUP.md
3. **Detailed setup?** → Read LOCAL_SETUP_GUIDE.md
4. **Understand system?** → Read WEBSITE_ARCHITECTURE.md
5. **Code in browser?** → Press F12, explore Console & Network tabs
6. **Backend errors?** → Check storage/logs/laravel.log

---

## 🎉 You're All Set!

```
✓ Backend: http://localhost:8000
✓ Frontend: http://localhost:5173
✓ Database: MAMP MySQL hovertask_local
✓ Ready to develop!
```

**Happy coding!** 🚀

---

## 📄 Additional Files

- `.env.example.local` - Environment template
- All setup scripts in this directory
- All documentation files created

---

**Questions?** Check the documentation files. Everything is documented! 📚
