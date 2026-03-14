# 🚀 Hovertask - Quick Start Reference

## 📋 Choose Your Setup Method

### Option 1: Automated Setup (Recommended)
```bash
cd /Users/user/Desktop/hovertask
bash setup.sh
```
Then follow on-screen instructions.

### Option 2: Manual Step-by-Step
See **MANUAL_SETUP.md** for detailed instructions

### Option 3: Quick Start (After Initial Setup)
```bash
cd /Users/user/Desktop/hovertask
bash start.sh
```

---

## 🎯 The Fastest Way (5 Minutes)

### Prerequisites (One-time only)
Make sure MAMP is installed from https://www.mamp.info/en/mac/

### Step 1: Start MAMP (1 min)
- Open **MAMP.app** from Applications
- Click **Start Servers**
- Wait for green checkmarks ✓

### Step 2: Open 3 Terminal Windows

**Terminal 1:**
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve
```
Runs at: **http://localhost:8000**

**Terminal 2:**
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev
```
Runs at: **http://localhost:5173**

**Terminal 3 (Optional):**
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev
```
Runs at: **http://localhost:5174**

### Step 3: Test Login (1 min)
- Visit: http://localhost:5173
- Email: **test@hovertask.com**
- Password: **password123**
- You're in! ✓

---

## 🔗 URL Reference

| Service | URL | Status |
|---------|-----|--------|
| MAMP Dashboard | http://localhost:8888/MAMP/ | Check servers |
| Marketing Site | http://localhost:5174 | Landing page |
| Dashboard App | http://localhost:5173 | Main app |
| Laravel API | http://localhost:8000 | Backend |
| phpMyAdmin | http://localhost:8888/phpMyAdmin/ | Database GUI |

---

## 👤 Test Credentials

```
Email: test@hovertask.com
Password: password123
Balance: ₦50,000
Membership: Activated
```

---

## 🆘 Quick Fixes

### "Cannot connect to database"
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan migrate
```

### "CORS Error"
Add to Laravel `.env`:
```env
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://localhost:5174,http://localhost:8000
```
Then restart Laravel terminal (Ctrl+C, then re-run `php artisan serve`)

### "Login doesn't work"
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan tinker
App\Models\User::where('email', 'test@hovertask.com')->first();
exit
# Should show user. If not:
php artisan migrate:fresh
# Then recreate test user
```

### "Port already in use"
```bash
# Kill existing process
lsof -i :5173
kill -9 <PID>
```

---

## 📊 Debugging

### View Laravel Logs (Real-time)
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

### View React Errors
- Press F12 in browser
- Go to Console tab
- Look for red errors

### Check API Responses
- Press F12 in browser
- Go to Network tab
- Look for failed requests
- Click request → Response tab

---

## 🧪 Test Features

After login, test:

1. **Dashboard** - View balance, tasks, etc.
2. **Earn Section** - Browse available tasks
3. **Advertise** - Check ad creation flow
4. **Marketplace** - Browse products
5. **Profile** - Edit profile info
6. **Transactions** - View wallet history

---

## 🛑 Stop Everything

Press **Ctrl+C** in each terminal to stop servers.

To kill all processes:
```bash
pkill -f "php artisan serve"
pkill -f "npm run dev"
```

---

## 📱 What's Running

- **React 19** - Frontend UI
- **Vite 6** - Bundler & dev server
- **Laravel 11** - Backend API
- **PostgreSQL/MySQL** - Database
- **Tailwind CSS** - Styling
- **Redux** - State management
- **Pusher** - Real-time (mocked locally)

---

## 📁 Project Structure

```
/Users/user/Desktop/hovertask/
├── hovertask-dashboard/      # React frontend (port 5173)
├── Hovertask-main/           # React marketing site (port 5174)
├── laravel-MKpr/             # Laravel backend (port 8000)
├── WEBSITE_ARCHITECTURE.md   # Full system docs
├── LOCAL_SETUP_GUIDE.md      # Detailed setup guide
├── MANUAL_SETUP.md           # Step-by-step manual guide
├── setup.sh                  # Automated setup script
└── start.sh                  # Quick start script
```

---

## 💡 Pro Tips

1. **Hot Reload**: React changes reload automatically
2. **Laravel Tinker**: Use `php artisan tinker` to debug
3. **DevTools**: Press F12 for browser debugging
4. **Redux DevTools**: Install extension for state debugging
5. **Database GUI**: Use phpMyAdmin at http://localhost:8888/phpMyAdmin/

---

## 🚀 Ready?

1. Start MAMP
2. Open 3 terminals with the commands above
3. Visit http://localhost:5173
4. Login with test credentials
5. Explore! 🎉

---

## 📞 Need Help?

Check these files in order:
1. **MANUAL_SETUP.md** - Detailed step-by-step
2. **LOCAL_SETUP_GUIDE.md** - Comprehensive guide
3. **WEBSITE_ARCHITECTURE.md** - System overview
4. Browser console (F12) - JavaScript errors
5. Laravel logs - Backend errors

---

**Happy coding!** 🎯
