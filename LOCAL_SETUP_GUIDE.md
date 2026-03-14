# 🚀 Hovertask Local Setup Guide - MAMP, Laravel, React, PostgreSQL

## Prerequisites Checklist

Before starting, ensure you have installed:
- ✅ **MAMP** (macOS, Apache, MySQL/PostgreSQL, PHP)
- ✅ **Node.js** (v18+) - `node -v`
- ✅ **npm** (v9+) - `npm -v`
- ✅ **Composer** (PHP dependency manager) - `composer -v`
- ✅ **Git** - `git -v`

---

## 📋 Step 1: Set Up MAMP

### 1.1 Install MAMP (if not already installed)
- Download from: https://www.mamp.info/en/mac/
- Install in `/Applications/MAMP`
- Open MAMP and start the servers

### 1.2 Configure MAMP
1. Open **MAMP** → **Preferences**
2. Go to **Ports** tab
   - Apache Port: **8888** (or preferred)
   - MySQL/PostgreSQL Port: **3306**
3. Go to **Web Server** tab
   - Document Root: Set to your project folder
   - Example: `/Users/user/Desktop/hovertask/laravel-MKpr/public`
4. Click **OK** and **Start Servers**

### 1.3 Verify MAMP is Running
- Visit: http://localhost:8888/MAMP/
- You should see the MAMP dashboard
- MySQL/PostgreSQL should be showing as "running"

---

## 📦 Step 2: Setup Laravel Backend

### 2.1 Navigate to Laravel Project
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
```

### 2.2 Install PHP Dependencies
```bash
composer install
```
This installs all Laravel packages from `composer.json`

### 2.3 Create Environment Configuration
```bash
# Copy example env file
cp .env.example .env

# Generate app key
php artisan key:generate
```

### 2.4 Configure `.env` File
Edit `/Users/user/Desktop/hovertask/laravel-MKpr/.env`:

```env
APP_NAME=Hovertask
APP_ENV=local
APP_KEY=base64:... (auto-generated)
APP_DEBUG=true
APP_URL=http://localhost:8888

# Database Configuration (PostgreSQL with MAMP)
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=hovertask_local
DB_USERNAME=root
DB_PASSWORD=root

# Or MySQL with MAMP
# DB_CONNECTION=mysql
# DB_HOST=localhost
# DB_PORT=3306
# DB_DATABASE=hovertask_local
# DB_USERNAME=root
# DB_PASSWORD=root

# Mail (for testing)
MAIL_MAILER=log
MAIL_FROM_ADDRESS=test@hovertask.local
MAIL_FROM_NAME="${APP_NAME}"

# Sanctum (API Authentication)
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000,localhost:5173

# CORS
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:5173

# Pusher/Broadcasting (for real-time features)
PUSHER_APP_ID=test
PUSHER_APP_KEY=test
PUSHER_APP_SECRET=test
PUSHER_APP_CLUSTER=mt1

# Cloudinary (for image uploads)
CLOUDINARY_URL=cloudinary://your_key:your_secret@your_cloud

# Paystack (optional for payments)
PAYSTACK_PUBLIC_KEY=your_key
PAYSTACK_SECRET_KEY=your_key
```

### 2.5 Create Database

#### Option A: Using MAMP MySQL
```bash
# Access MySQL via MAMP
/Applications/MAMP/Library/bin/mysql -u root -p

# Password: root (default)

# Create database
CREATE DATABASE hovertask_local;
exit;
```

#### Option B: Using PostgreSQL
```bash
# If using PostgreSQL, ensure it's running in MAMP
# Create database via command line:
createdb -U postgres hovertask_local
```

### 2.6 Run Database Migrations
```bash
php artisan migrate
```

This creates all database tables needed for the application.

### 2.7 Seed Database (Optional - adds test data)
```bash
php artisan db:seed
```

### 2.8 Generate Storage Link (for file uploads)
```bash
php artisan storage:link
```

### 2.9 Create a Test User Account (for logging in)
```bash
php artisan tinker
```

Then in the Tinker shell:
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
exit
```

---

## 🚀 Step 3: Start Laravel Development Server

### Option A: Using MAMP Apache (Recommended)
The Laravel app will be served at: **http://localhost:8888**

Make sure Document Root in MAMP points to:
`/Users/user/Desktop/hovertask/laravel-MKpr/public`

### Option B: Using Laravel's Built-in Server
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve
```

This starts the server at: **http://localhost:8000**

---

## ⚛️ Step 4: Setup React Dashboard Frontend

### 4.1 Navigate to Dashboard Project
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
```

### 4.2 Install Dependencies
```bash
npm install
```

### 4.3 Create Environment Configuration
Create a `.env.local` file in the dashboard folder:

```env
VITE_API_URL=http://localhost:8000
# OR if using MAMP:
VITE_API_URL=http://localhost:8888
```

### 4.4 Update API Configuration in Code
Edit `/src/utils/apiEndpointBaseURL.ts`:

```typescript
const apiEndpointBaseURL = 
  import.meta.env.DEV 
    ? 'http://localhost:8000'  // Laravel artisan serve
    // ? 'http://localhost:8888'  // MAMP Apache
    : 'https://api.hovertask.com'; // Production

export default apiEndpointBaseURL;
```

### 4.5 Start React Development Server
```bash
npm run dev
```

This starts the dashboard at: **http://localhost:5173**

---

## 📊 Step 5: Setup React Marketing Website (Optional)

### 5.1 Navigate to Marketing Website
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
```

### 5.2 Install Dependencies
```bash
npm install
```

### 5.3 Create Environment Configuration
Create a `.env.local` file:

```env
VITE_API_URL=http://localhost:8000
# OR VITE_API_URL=http://localhost:8888
```

### 5.4 Start Development Server
```bash
npm run dev
```

This starts the marketing site at: **http://localhost:5174**

---

## 🔐 Step 6: Testing & Login

### Test Credentials
```
Email: test@hovertask.com
Password: password123
```

### Access Points
- **Marketing Site**: http://localhost:5174
- **Dashboard**: http://localhost:5173
- **Laravel API**: http://localhost:8000 (or 8888)
- **MAMP Dashboard**: http://localhost:8888/MAMP/

### Test Login Flow
1. Open http://localhost:5174 (marketing site)
2. Click "Sign In"
3. Enter test credentials
4. Should redirect to http://localhost:5173 (dashboard)
5. Explore all features

---

## 📝 Step 7: Enable Logging & Debugging

### 7.1 Enable Laravel Debugging
Edit `.env`:
```env
APP_DEBUG=true
APP_LOG_LEVEL=debug
```

### 7.2 Check Laravel Logs
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

### 7.3 Enable React Debugging
In browser:
1. Open **DevTools** (F12)
2. **Console** tab - shows React/app errors
3. **Network** tab - shows API calls
4. **Redux** tab (if Redux DevTools installed)

### 7.4 Install Redux DevTools (Optional)
```bash
npm install @redux-devtools/extension
```

Then in React Redux store to enable time-travel debugging.

---

## 🐛 Troubleshooting

### Issue: "Cannot connect to database"
**Solution:**
```bash
# Check if MAMP MySQL/PostgreSQL is running
# Verify DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD in .env
# Try connecting manually:
mysql -u root -p -h localhost
```

### Issue: "CORS Error in Console"
**Solution:**
Update `CORS_ALLOWED_ORIGINS` in `.env`:
```env
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:5173,http://localhost:5174,http://localhost:8888,http://localhost:8000
```

Then restart Laravel.

### Issue: "API 404 Not Found"
**Solution:**
1. Check Laravel routes are properly defined
2. Ensure `VITE_API_URL` points to correct backend
3. Check browser Network tab for actual API URL being called

### Issue: "Pusher/Real-time not working"
**Solution:**
Real-time features won't work locally without proper Pusher credentials. For testing, you can:
- Mock Pusher in local environment
- Or disable real-time features for local testing

### Issue: "File uploads not working"
**Solution:**
Run:
```bash
php artisan storage:link
```

### Issue: "Email verification not sending"
**Solution:**
In `.env`, use log driver:
```env
MAIL_MAILER=log
```

Check email output in `/storage/logs/laravel.log`

---

## 📋 Database Troubleshooting

### Reset Database
```bash
# Drop and recreate database
php artisan migrate:fresh

# Or with seeders
php artisan migrate:fresh --seed
```

### Check Database Connection
```bash
php artisan tinker
# Then try:
DB::connection()->getPdo();
# Should show no error if connected
```

---

## 🔄 Quick Start Commands Summary

### Terminal 1: Laravel Backend
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve
# Or use MAMP (already running)
```

### Terminal 2: React Dashboard
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev
```

### Terminal 3: React Marketing Site (Optional)
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev
```

### Terminal 4: Check Logs (Optional)
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

---

## ✅ Verification Checklist

After setup, verify:

- [ ] MAMP is running (Apache + MySQL/PostgreSQL)
- [ ] Laravel database migrations complete
- [ ] Test user created in database
- [ ] Laravel backend accessible at http://localhost:8000 or 8888
- [ ] React dashboard running at http://localhost:5173
- [ ] React marketing site running at http://localhost:5174
- [ ] Can login with test@hovertask.com / password123
- [ ] Dashboard loads successfully
- [ ] Can navigate between pages
- [ ] Browser console has no major errors
- [ ] API calls showing in Network tab

---

## 🎯 Access URLs

| Service | URL | Purpose |
|---------|-----|---------|
| **MAMP Dashboard** | http://localhost:8888/MAMP/ | Check server status |
| **Laravel API** | http://localhost:8000 or 8888 | Backend API |
| **React Dashboard** | http://localhost:5173 | Main app |
| **React Marketing** | http://localhost:5174 | Landing page |
| **phpMyAdmin** | http://localhost:8888/phpMyAdmin/ | Database management |

---

## 📚 Useful Commands Reference

```bash
# Laravel
php artisan migrate                    # Run migrations
php artisan tinker                     # Interactive shell
php artisan serve                      # Start dev server
php artisan cache:clear                # Clear cache
php artisan config:cache               # Cache config
php artisan db:seed                    # Seed database
php artisan make:migration name        # Create migration
php artisan make:model ModelName       # Create model

# React/npm
npm run dev                            # Start dev server
npm run build                          # Production build
npm install package-name               # Install package
npm run lint                           # Run linter

# Composer
composer install                       # Install dependencies
composer update                        # Update dependencies
composer require package/name          # Require new package
```

---

## 🚨 Important Notes

1. **Local Development Only**: This setup is for local development testing only
2. **No HTTPS**: Local setup uses HTTP only
3. **No Real Payments**: Paystack is disabled locally
4. **No Email Delivery**: Emails are logged to file
5. **No Real-time Notifications**: Pusher won't work without proper config
6. **Test Data Only**: Use test accounts, not real user data
7. **MAMP Ports**: Remember to stop MAMP when done to free up ports

---

## Next Steps

Once everything is running:
1. Explore the dashboard features
2. Test user login/registration flow
3. Try task completion and earning features
4. Check marketplace functionality
5. Test payment callback flow
6. Review API responses in Network tab
7. Check logs for errors

---

## Need Help?

If you encounter issues:
1. Check the Laravel logs: `tail -f storage/logs/laravel.log`
2. Check browser console (F12) for JavaScript errors
3. Check Network tab for API call failures
4. Verify `.env` configuration
5. Ensure MAMP servers are running
6. Try clearing cache: `php artisan cache:clear`

Good luck! 🎉
