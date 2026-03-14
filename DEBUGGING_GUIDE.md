# 🔧 Hovertask - Comprehensive Troubleshooting & Logging Guide

## 📊 Logging Setup

### Enable Full Debug Logging

Edit `/Users/user/Desktop/hovertask/laravel-MKpr/.env`:

```env
APP_DEBUG=true
APP_LOG_LEVEL=debug
LOG_CHANNEL=single
LOG_DEPRECATIONS_CHANNEL=null
```

### View Real-time Logs

**Terminal 4 - Watch Laravel Logs:**
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

This shows all errors, warnings, and debug info in real-time.

### Common Log Messages

#### ✓ Success
```
[2024-03-09 12:34:56] local.DEBUG: User authenticated: test@hovertask.com
[2024-03-09 12:34:56] local.INFO: Task created with ID 42
```

#### ✗ Errors to Fix
```
[2024-03-09 12:34:56] local.ERROR: SQLSTATE[HY000]: General error: 1030 Got error...
→ FIX: Database not connected, check .env DB settings

[2024-03-09 12:34:56] local.ERROR: Route [api.task.create] not defined
→ FIX: Route not registered in routes/api.php

[2024-03-09 12:34:56] local.ERROR: Call to undefined method User::validate()
→ FIX: Check model exists and method is defined
```

---

## 🐛 Debugging Frontend

### Enable React DevTools

1. Open browser DevTools: **F12**
2. Go to **Console** tab
3. Look for error messages (red text)

### Common React Errors

#### ✓ Normal (Expected)
```
[HMR] connected.
[vite] hmr update received:
```

#### ✗ Fix These
```
Uncaught TypeError: Cannot read property 'value' of undefined
→ Check Redux state, selector might be wrong

CORS error: Access to XMLHttpRequest at 'http://localhost:8000' 
from origin 'http://localhost:5173' has been blocked
→ Add to Laravel .env:
   CORS_ALLOWED_ORIGINS=http://localhost:5173

Error: Network error when attempting to fetch resource
→ Laravel backend not running, check Terminal 1
```

### Browser Console Tips

```javascript
// Check current user (if logged in)
console.log(localStorage.getItem('auth_token'))

// Check API base URL
console.log(import.meta.env.VITE_API_URL)

// Check Redux state (if extension installed)
// Open Redux tab in DevTools
```

---

## 🌐 Debugging Network Requests

### Check API Calls

1. Open **DevTools** → **Network** tab
2. Perform action in app (login, fetch data, etc.)
3. Look for new requests

### Analyze Request

**Example: Login Request**
```
Request:
  Method: POST
  URL: http://localhost:8000/login
  Headers: Content-Type: application/json
  Body: { "email": "test@hovertask.com", "password": "password123" }

Response:
  Status: 200 OK
  Body: { "token": "abc123...", "user": {...} }
```

### Status Codes

| Code | Meaning | Fix |
|------|---------|-----|
| **200** | ✓ Success | Good! |
| **401** | Not authenticated | Login again |
| **403** | Forbidden/permission denied | Check user permissions |
| **404** | Not found | Check URL in API call |
| **500** | Server error | Check Laravel logs |
| **CORS error** | Cross-origin blocked | Check CORS_ALLOWED_ORIGINS in .env |

### Common Request Issues

```
Request shows 0ms response time
→ API endpoint doesn't exist
→ Check routes/api.php

Request hangs for 30+ seconds
→ Database query is slow or stuck
→ Check database connection

Request returns 401 with valid token
→ Token expired or invalid
→ Clear localStorage and login again
```

---

## 🗄️ Database Debugging

### Check Database Connection

```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan tinker

# Try this:
DB::connection()->getPdo();
# Should show: PDOStatement object
# If error, database connection failed
```

### View Database Contents

#### Via phpMyAdmin (GUI)
- Visit: http://localhost:8888/phpMyAdmin/
- Username: root
- Password: root
- Select database: hovertask_local
- Browse tables: users, tasks, products, etc.

#### Via Terminal
```bash
/Applications/MAMP/Library/bin/mysql -u root -p
# Password: root

# See databases
SHOW DATABASES;

# Select database
USE hovertask_local;

# See tables
SHOW TABLES;

# Query users
SELECT * FROM users;

# Query with filter
SELECT * FROM users WHERE email = 'test@hovertask.com';

# Exit
exit
```

### Common Database Issues

```
Access denied for user 'root'@'localhost'
→ Password wrong, check .env DB_PASSWORD

Can't connect to MySQL server
→ MAMP MySQL not running
→ Open MAMP app and click Start Servers

SQLSTATE[HY000]: General error
→ Database tables don't exist
→ Run: php artisan migrate
```

### Database Debugging in Laravel

```bash
php artisan tinker

# Check if test user exists
App\Models\User::where('email', 'test@hovertask.com')->first();

# Create test user if needed
App\Models\User::create([
    'fname' => 'Test',
    'lname' => 'User',
    'email' => 'test@hovertask.com',
    'password' => bcrypt('password123'),
    'email_verified_at' => now(),
    'is_member' => true,
    'balance' => 50000,
]);

# Check migrations status
php artisan migrate:status

# Reset everything
php artisan migrate:fresh

exit
```

---

## 🔐 Authentication Issues

### Login Not Working

**Checklist:**
1. Is test user created?
```bash
/Applications/MAMP/Library/bin/mysql -u root -p
# Password: root
USE hovertask_local;
SELECT * FROM users;
```

2. Is password correct?
```bash
php artisan tinker
$user = App\Models\User::where('email', 'test@hovertask.com')->first();
# If null, user doesn't exist
exit
```

3. Check `.env` configuration
```env
SANCTUM_STATEFUL_DOMAINS=localhost:5173,localhost:5174,localhost:8000,localhost:8888
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://localhost:5174
```

4. Check Laravel logs
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
# Look for authentication errors
```

### Token Issues

```bash
# Check token storage in browser
# Open DevTools Console and run:
localStorage.getItem('auth_token')
// Should show a long string like: eyJ0eXAiOiJKV1QiLCJhbGc...

# Clear and re-login if token corrupted
localStorage.removeItem('auth_token')
// Then reload page and login again
```

---

## ⚙️ Configuration Issues

### CORS Configuration

**Issue**: Browser shows CORS error

**Fix**: Update `.env`:
```env
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:5173,http://localhost:5174,http://localhost:8000,http://localhost:8888

# Also add to config/cors.php:
'allowed_origins' => explode(',', env('CORS_ALLOWED_ORIGINS', '*')),
```

**Then restart Laravel**:
- Stop terminal (Ctrl+C)
- Re-run: `php artisan serve`

### Sanctum Configuration

**Issue**: Sessions/authentication not persisting

**Fix**: Check `.env`:
```env
SANCTUM_STATEFUL_DOMAINS=localhost:5173,localhost:5174,localhost:8000,localhost:8888
```

### API URL Configuration

**Issue**: React can't find backend

**Check** React `.env.local`:
```env
VITE_API_URL=http://localhost:8000
```

**Check** apiEndpointBaseURL in React code:
```typescript
// src/utils/apiEndpointBaseURL.ts
const baseURL = import.meta.env.VITE_API_URL || 'http://localhost:8000';
```

---

## 🚀 Performance Issues

### Slow Dashboard Loading

**Diagnose**:
1. Open DevTools → **Network** tab
2. Reload page (Cmd+R)
3. Look for slow requests (red = slow)

**Common Causes**:
```
Long response time from /api/dashboard/user
→ Database query is slow
→ Check: SELECT * FROM users WHERE id = 1;
→ Add indexes to frequently queried columns

Large bundle size
→ Run: npm run build
→ Check: vite analyze

Too many API calls
→ Check Network tab
→ Look for duplicate requests
→ Implement request deduplication
```

### Memory Issues

```bash
# Monitor Node.js process
top -p $(lsof -t -i:5173)

# Kill and restart if using too much memory
kill -9 $(lsof -t -i:5173)
npm run dev
```

---

## 🔄 Hot Module Replacement (HMR) Issues

### React Changes Not Updating

**Issue**: Changed a component but changes don't show

**Fix**:
1. Hard refresh browser: **Cmd+Shift+R**
2. If still not working:
```bash
# Kill React dev server
pkill -f "npm run dev"

# Clear cache
rm -rf node_modules/.vite

# Restart
npm run dev
```

### HMR Connection Error

**Console shows**:
```
[vite] server connection lost and attempting to reconnect...
```

**Fix**:
1. Check if React dev server is still running
2. Restart React dev server
3. Clear browser cache

---

## 🛑 Complete Reset

When everything is broken and you want to start fresh:

```bash
# 1. Stop all services (Ctrl+C in each terminal)

# 2. Clear React cache
cd /Users/user/Desktop/hovertask/hovertask-dashboard
rm -rf node_modules
npm install

cd /Users/user/Desktop/hovertask/Hovertask-main
rm -rf node_modules
npm install

# 3. Reset Laravel
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan cache:clear
php artisan config:cache
php artisan migrate:fresh

# 4. Recreate test user
php artisan tinker
App\Models\User::create([...])
exit

# 5. Restart everything
# Terminal 1: php artisan serve
# Terminal 2: npm run dev
```

---

## 📋 Debugging Checklist

- [ ] MAMP Apache running? (Open MAMP app)
- [ ] MAMP MySQL running? (Check green checkmark)
- [ ] Laravel terminal shows: "Server running on..."?
- [ ] React terminal shows: "Local: http://localhost:5173"?
- [ ] Database tables exist? (php artisan migrate:status)
- [ ] Test user exists? (Check users table)
- [ ] .env files configured correctly?
- [ ] Can access http://localhost:8000? (may show error, that's ok)
- [ ] Can access http://localhost:5173?
- [ ] Browser console has no red errors? (F12)
- [ ] API calls show 200 status? (F12 Network tab)

---

## 🆘 Emergency Debug Mode

Enable maximum verbosity:

### Laravel

Edit `.env`:
```env
APP_DEBUG=true
APP_LOG_LEVEL=debug
LOG_CHANNEL=single
```

Then watch logs:
```bash
tail -f storage/logs/laravel.log
```

### React

Edit `src/main.tsx`:
```typescript
// Add debug logging
console.log('API URL:', import.meta.env.VITE_API_URL);
console.log('Environment:', import.meta.env.MODE);

// Add to store
window.Redux = store;  // Access via window.Redux in console
```

### Browser Console

```javascript
// Set to verbose logging
localStorage.setItem('debug', 'app:*');

// Monitor all fetch calls
const originalFetch = fetch;
window.fetch = function(...args) {
  console.log('API Call:', args);
  return originalFetch.apply(this, args);
};
```

---

## 📞 Getting Help

1. **Check the logs**: Every error is logged
2. **Check the console**: Browser shows JavaScript errors
3. **Check the network**: DevTools shows API issues
4. **Check the database**: phpMyAdmin shows data issues
5. **Read the docs**: All guides have solutions

---

## 🎯 Quick Reference

| Problem | Check | Fix |
|---------|-------|-----|
| Can't login | Test user exists? | php artisan tinker → Create user |
| API 404 errors | Route registered? | Check routes/api.php |
| CORS error | CORS_ALLOWED_ORIGINS set? | Update .env, restart Laravel |
| Database error | MySQL running? | Open MAMP, start MySQL |
| React not loading | npm run dev working? | Check React terminal output |
| Slow responses | Database query slow? | Check Laravel logs for SQL |
| Port in use | Process running on port? | lsof -i :5173, kill -9 <PID> |
| Changes not updating | HMR working? | Hard refresh (Cmd+Shift+R) |

---

**Happy debugging!** 🔍
