# 🎯 Hovertask - Manual Step-by-Step Local Setup

> **Recommended**: Follow this guide step-by-step if the automated script doesn't work perfectly.

---

## ✅ Phase 1: Prerequisites & MAMP Setup (10 minutes)

### Step 1: Install Required Software

Make sure you have:
```bash
# Check these are installed
node -v        # Should be v18+
npm -v         # Should be v9+
composer -v    # Should be 2.x
git -v         # Should be recent
php -v         # Should be 8.2+
```

If any are missing:
- **Node.js**: https://nodejs.org/
- **Composer**: https://getcomposer.org/
- **MAMP**: https://www.mamp.info/en/mac/

### Step 2: Start MAMP

1. Open **Finder** → Applications → MAMP
2. Double-click **MAMP.app**
3. Click **Start Servers** button (top-right)
4. Wait for Apache and MySQL to show ✓ green lights

You should see:
```
✓ Apache Server is running
✓ MySQL Server is running
```

### Step 3: Configure MAMP Document Root

1. Click **Preferences** in MAMP
2. Go to **Web Server** tab
3. Set **Document Root** to: `/Users/user/Desktop/hovertask/laravel-MKpr/public`
4. Click **OK**
5. MAMP will restart

### Step 4: Verify MAMP is Running

Open your browser:
- Visit: http://localhost:8888/MAMP/
- You should see MAMP dashboard with status ✓

---

## 🗄️ Phase 2: Laravel Backend Setup (15 minutes)

### Step 5: Navigate to Laravel Project

```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
```

### Step 6: Install Composer Dependencies

```bash
composer install
```

**Wait for it to complete.** You'll see many packages being downloaded.

```bash
# Expected output ends with:
# "Loading composer repositories with package information
#  Installing dependencies (including require-dev) from lock file
#  ... (many packages)
#  Done."
```

### Step 7: Generate Application Key

```bash
php artisan key:generate
```

**Expected output:**
```
Application key set successfully.
```

### Step 8: Create `.env` Configuration File

**Option A: Quick Copy**
```bash
cp .env.example .env
```

**Option B: Manual Creation**

Create file: `/Users/user/Desktop/hovertask/laravel-MKpr/.env`

Add this content:
```env
APP_NAME=Hovertask
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hovertask_local
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file

MAIL_MAILER=log
MAIL_FROM_ADDRESS=test@hovertask.local
MAIL_FROM_NAME=Hovertask

SANCTUM_STATEFUL_DOMAINS=localhost:3000,localhost:5173,localhost:5174,localhost:8000,localhost:8888
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:5173,http://localhost:5174,http://localhost:8000,http://localhost:8888

PUSHER_APP_ID=test
PUSHER_APP_KEY=test
PUSHER_APP_SECRET=test

CLOUDINARY_URL=cloudinary://demo
```

### Step 9: Create Database

Open a terminal and run:

```bash
# Access MySQL via terminal
/Applications/MAMP/Library/bin/mysql -u root -p

# When prompted for password, type: root (then press Enter)
```

In MySQL console:
```sql
CREATE DATABASE hovertask_local;
exit
```

### Step 10: Run Database Migrations

```bash
php artisan migrate
```

**Expected output:**
```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table
... (many migrations)
✓ All migrations completed
```

### Step 11: Create Storage Link

```bash
php artisan storage:link
```

**Expected output:**
```
The [public/storage] link has been connected to [storage/app/public].
```

### Step 12: Create Test User Account

```bash
php artisan tinker
```

In the interactive shell, paste:
```php
App\Models\User::create([
    'fname' => 'Test',
    'lname' => 'User',
    'email' => 'test@hovertask.com',
    'password' => bcrypt('password123'),
    'email_verified_at' => now(),
    'is_member' => true,
    'balance' => 50000,
    'how_you_want_to_use' => 'earn',
]);
```

Then:
```php
exit
```

**Expected output:**
```
=> User created successfully with ID: 1
```

---

## 🚀 Phase 3: Start Laravel Server (2 minutes)

Open a **NEW terminal window** and run:

```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve
```

**Expected output:**
```
  INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to quit
```

✅ **Leave this running!** Keep this terminal open.

### Verify Laravel is Working

Open browser: http://localhost:8000

You might see an error page - that's normal. The API endpoint isn't designed for browser access, just API calls.

---

## ⚛️ Phase 4: React Dashboard Setup (10 minutes)

Open a **NEW terminal window** (keep Laravel running in other terminal):

### Step 13: Navigate to Dashboard

```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
```

### Step 14: Install npm Dependencies

```bash
npm install
```

**Wait for completion.** This takes a few minutes.

**Expected output ends with:**
```
up to date, audited 180 packages
found 0 vulnerabilities
```

### Step 15: Create Environment Configuration

Create file: `/Users/user/Desktop/hovertask/hovertask-dashboard/.env.local`

Add:
```env
VITE_API_URL=http://localhost:8000
```

### Step 16: Start Development Server

```bash
npm run dev
```

**Expected output:**
```
  VITE v6.0.0  dev server running at:

  ➜  Local:   http://localhost:5173/
  ➜  press h + enter to show help
```

✅ **Leave this running!** Keep this terminal open.

### Verify Dashboard is Working

Open browser: http://localhost:5173

You should see either:
- Login page (if not authenticated)
- Or redirect to sign-in page

---

## 🌐 Phase 5: React Marketing Website Setup (Optional, 5 minutes)

Open a **NEW terminal window**:

### Step 17: Navigate to Marketing Site

```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
```

### Step 18: Install Dependencies

```bash
npm install
```

### Step 19: Create Environment File

Create: `/Users/user/Desktop/hovertask/Hovertask-main/.env.local`

Add:
```env
VITE_API_URL=http://localhost:8000
```

### Step 20: Start Development Server

```bash
npm run dev
```

**Expected output:**
```
  ➜  Local:   http://localhost:5174/
```

✅ **Leave this running!**

---

## 🧪 Phase 6: Testing & Verification (10 minutes)

### Test URLs Summary

Open these in your browser:

| Service | URL | What You'll See |
|---------|-----|-----------------|
| **MAMP** | http://localhost:8888/MAMP/ | MAMP dashboard |
| **Marketing Site** | http://localhost:5174 | Landing page |
| **Dashboard** | http://localhost:5173 | Login page |
| **Laravel API** | http://localhost:8000 | Error (expected) |

### Test Login

1. Go to http://localhost:5174 (Marketing Site)
2. Click **"Sign In"** or go to http://localhost:5173
3. Enter credentials:
   ```
   Email: test@hovertask.com
   Password: password123
   ```
4. Click **Sign In**
5. Should redirect to dashboard at http://localhost:5173

### Verify You're Logged In

You should see:
- ✓ Dashboard page with "Welcome" message
- ✓ Your test user name displayed
- ✓ Balance showing: ₦50,000
- ✓ Navigation menu on left side
- ✓ No login page

### Test Navigation

Click these menu items:
- ✓ Dashboard
- ✓ Earn
- ✓ Advertise
- ✓ Marketplace
- ✓ Add Me Up

All should load without errors.

### Check Browser Console

1. Press `F12` to open DevTools
2. Go to **Console** tab
3. You should see **NO red error messages**
4. Some yellow warnings are okay

### Check Network Requests

1. Press `F12` to open DevTools
2. Go to **Network** tab
3. Refresh page (Cmd+R)
4. You should see:
   - ✓ `/api/dashboard/user` - Status 200 (Success)
   - ✓ CSS/JS files - Status 200

If you see 401/403, authentication failed. Check:
- Are you logged in?
- Is test user created in database?
- Are Laravel and React API URLs correct?

---

## 🐛 Phase 7: Debug & Logs

### View Laravel Logs

Open **NEW terminal**:
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

This shows real-time Laravel errors. Leave it open while testing.

### View React Console

Open browser DevTools (F12) → Console tab

Shows JavaScript errors in real-time.

### Check API Errors

In DevTools:
1. Network tab
2. Filter by "Fetch/XHR"
3. Click failed request
4. Go to **Response** tab to see error message

---

## 🛑 Troubleshooting Quick Fixes

### Problem: "Cannot connect to database"

**Solution 1**: Verify MAMP MySQL is running
```bash
# In terminal
/Applications/MAMP/Library/bin/mysql -u root -p
# Type password: root
# If it connects, type: exit
```

**Solution 2**: Check `.env` database config
```bash
# These should match:
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=root
DB_DATABASE=hovertask_local
```

**Solution 3**: Recreate database
```bash
php artisan migrate:fresh
```

### Problem: CORS Error in Browser Console

**Fix**: Add to `.env`:
```env
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://localhost:5174,http://localhost:8000
```

Then restart Laravel:
- Stop the terminal (Ctrl+C)
- Run: `php artisan serve`

### Problem: "Cannot GET /"

**This is normal!** The Laravel `/` route doesn't exist. The API is not meant for browser browsing.

### Problem: Login doesn't work

**Check:**
1. Is test user in database?
```bash
php artisan tinker
# Then:
App\Models\User::where('email', 'test@hovertask.com')->first();
# Should show user data
exit
```

2. Are Laravel and React URLs correct?
3. Check browser console for errors (F12)
4. Check Laravel logs: `tail -f storage/logs/laravel.log`

### Problem: "npm ERR! code ERESOLVE"

**Fix:**
```bash
# In the React project directory
npm install --legacy-peer-deps
```

### Problem: Ports Already in Use

**Find what's using port 5173:**
```bash
lsof -i :5173
# Then kill it:
kill -9 <PID>
```

---

## 📊 Full Terminal Layout (Recommended)

For smooth testing, arrange terminals like this:

**Terminal 1 - Laravel Backend:**
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve
```

**Terminal 2 - React Dashboard:**
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev
```

**Terminal 3 - React Marketing (Optional):**
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev
```

**Terminal 4 - Log Monitoring (Optional):**
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

---

## 🎯 Quick Reference Cheat Sheet

### Stopping Everything
```bash
# In each terminal, press:
Ctrl + C

# Or kill processes:
pkill -f "php artisan serve"
pkill -f "npm run dev"
```

### Clearing Cache
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan cache:clear
php artisan config:cache
```

### Resetting Database
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan migrate:fresh
php artisan tinker
# Then create test user again
```

### Viewing Database
```bash
# Access MySQL
/Applications/MAMP/Library/bin/mysql -u root -p
# Password: root

# In MySQL:
USE hovertask_local;
SELECT * FROM users;
exit
```

### Or use phpMyAdmin (GUI)
- Visit: http://localhost:8888/phpMyAdmin/
- Username: root
- Password: root

---

## ✅ Final Checklist

Before calling it "ready":

- [ ] MAMP is running (Apache ✓, MySQL ✓)
- [ ] Laravel backend running at http://localhost:8000
- [ ] React dashboard running at http://localhost:5173
- [ ] Marketing site running at http://localhost:5174
- [ ] Can login with test@hovertask.com / password123
- [ ] Dashboard shows without errors
- [ ] Can navigate between pages
- [ ] Browser console has no red errors
- [ ] Network tab shows 200 status for API calls
- [ ] Laravel logs show no errors (optional)

---

## 🎉 You're Ready!

Once everything passes the checklist:

1. **Explore the app**: Click through all features
2. **Test the flow**: Try task completion, marketplace, etc.
3. **Watch console**: Monitor F12 console and Laravel logs
4. **Study code**: Start with `/src/App.tsx` to understand routing
5. **Make changes**: Edit React components and see hot-reload

---

## 📚 Next: Understanding the Code

Now that it's running, check out:
- `WEBSITE_ARCHITECTURE.md` - Full system overview
- `/src/pages/` - Feature pages
- `/src/components/` - Reusable components
- Laravel routes in `routes/api.php`

Happy coding! 🚀
