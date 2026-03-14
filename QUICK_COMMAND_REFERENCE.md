# 🎯 HOVERTASK - QUICK COMMAND REFERENCE

## ✅ Current Status: ALL SYSTEMS OPERATIONAL 🟢

```
✅ PHP 8.5.2 Active
✅ Laravel API Running (port 8000)
✅ React Dashboard Running (port 5173)  
✅ React Main Site Running (port 5174)
✅ Database Connected
✅ Test User Ready
```

---

## 🚀 Quick Start Commands

### Open Dashboard
```bash
# In browser:
http://localhost:5173

# Or open with curl:
curl http://localhost:5173
```

### Login Credentials
```
Email:    test@hovertask.com
Password: password123
```

### Test API
```bash
# Login and get token
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}'

# Should return something like:
# {"status":true,"token":"...","user":{...}}
```

---

## 🔧 Service Management

### Check Service Status
```bash
# See running services
lsof -i -P -n | grep -E "8000|5173|5174"

# Check specific service
ps aux | grep "php artisan serve"
ps aux | grep "npm run dev"
```

### Kill Services (If Needed)
```bash
# Kill Laravel API
lsof -i :8000 | grep LISTEN | awk '{print $2}' | xargs kill -9

# Kill React Dashboard
lsof -i :5173 | grep LISTEN | awk '{print $2}' | xargs kill -9

# Kill React Main
lsof -i :5174 | grep LISTEN | awk '{print $2}' | xargs kill -9

# Or kill all at once:
pkill -f "php artisan serve"
pkill -f "npm run dev"
```

### Restart All Services
```bash
# Terminal 1: Start Laravel
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve --port 8000

# Terminal 2: Start Dashboard
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev

# Terminal 3: Start Main Site
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev
```

### Run in Background (Single Terminal)
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr && php artisan serve --port 8000 > /tmp/laravel.log 2>&1 &
cd /Users/user/Desktop/hovertask/hovertask-dashboard && npm run dev > /tmp/dashboard.log 2>&1 &
cd /Users/user/Desktop/hovertask/Hovertask-main && npm run dev > /tmp/main.log 2>&1 &
```

---

## 📝 Useful Laravel Commands

### Database
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Refresh database
php artisan migrate:fresh --seed

# Check database connection
php artisan tinker
# Inside tinker:
> DB::connection()->getPdo()
> exit
```

### Cache
```bash
# Clear all cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Clear specific cache
php artisan cache:clear --tags=users
```

### Create User in Tinker
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan tinker

# Inside tinker:
> App\Models\User::create([
    'name' => 'John',
    'lname' => 'Doe',
    'fname' => 'John',
    'username' => 'johndoe',
    'email' => 'john@example.com',
    'password' => bcrypt('password123'),
    'phone' => '08012345678',
    'country' => 'NG',
    'currency' => 'NGN',
    'email_verified_at' => now()
  ])
> exit
```

### Logs
```bash
# View Laravel logs
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log

# View application logs
tail -f /tmp/laravel.log
```

---

## 📊 Useful Frontend Commands

### React Dashboard
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard

# Development
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview

# Check for errors
npm run lint

# Format code
npm run format
```

### React Main Site
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main

# Same commands as dashboard...
npm run dev
npm run build
npm run preview
npm run lint
```

---

## 🔍 Debugging

### View Service Logs
```bash
# Laravel logs
tail -f /tmp/laravel.log

# Dashboard logs
tail -f /tmp/dashboard.log

# Main site logs
tail -f /tmp/main.log
```

### Check PHP Version
```bash
php --version
# Should show: PHP 8.5.2

which php
# Should show: /Applications/MAMP/bin/php/php8.5.2/bin/php
```

### Test Database Connection
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php -r "
require 'vendor/autoload.php';
\$app = require_once 'bootstrap/app.php';
\$app->make('Illuminate\\Contracts\\Console\\Kernel')->bootstrap();

try {
    \DB::connection()->getPdo();
    echo '✅ Database connection successful!';
} catch (Exception \$e) {
    echo '❌ Error: ' . \$e->getMessage();
}
"
```

### Test API Endpoint
```bash
# Without authentication
curl -s http://localhost:8000/api/v1/public/categories

# With authentication
curl -s -H "Authorization: Bearer YOUR_TOKEN" \
  http://localhost:8000/api/v1/dashboard/dashboard
```

---

## 🌐 Available URLs

| Service | URL | Port | Status |
|---------|-----|------|--------|
| Dashboard | http://localhost:5173 | 5173 | 🟢 |
| Main Site | http://localhost:5174 | 5174 | 🟢 |
| API Base | http://localhost:8000 | 8000 | 🟢 |
| API Docs | http://localhost:8000/api/docs | 8000 | 📋 |

---

## 🔑 API Endpoints (Sample)

### Authentication
```bash
# Register
POST /api/register
Body: {name, lname, fname, username, email, password, phone, country, currency}

# Login
POST /api/login
Body: {email, password}
Returns: {token, user}

# Logout
POST /api/logout
Headers: Authorization: Bearer TOKEN
```

### Dashboard
```bash
# Get user data
GET /api/v1/dashboard/dashboard
Headers: Authorization: Bearer TOKEN

# Update profile
PUT /api/v1/dashboard/update-profile
Headers: Authorization: Bearer TOKEN
Body: {name, lname, avatar, bio, ...}
```

### Tasks
```bash
# List tasks
GET /api/v1/task
Headers: Authorization: Bearer TOKEN

# Get task details
GET /api/v1/task/{id}
Headers: Authorization: Bearer TOKEN

# Complete task
POST /api/v1/task/{id}/complete
Headers: Authorization: Bearer TOKEN
Body: {proof_url, ...}
```

### Marketplace
```bash
# List products
GET /api/v1/product
Headers: Authorization: Bearer TOKEN

# Get product details
GET /api/v1/product/{id}

# Create product
POST /api/v1/product
Headers: Authorization: Bearer TOKEN
Body: {name, description, price, images, ...}
```

---

## 📁 Project Paths

```
/Users/user/Desktop/hovertask/
├── laravel-MKpr/              Backend API
├── hovertask-dashboard/       Main Dashboard
├── Hovertask-main/            Marketing Site
└── *.md files                 Documentation
```

### Key Files

**Laravel**
```
laravel-MKpr/.env              Environment config
laravel-MKpr/app/Models/       Database models
laravel-MKpr/routes/api.php    API endpoints
laravel-MKpr/storage/logs/     Application logs
```

**React**
```
src/pages/                     Page components
src/components/                Reusable components
src/redux/                     State management
src/hooks/                     Custom hooks
src/utils/                     Utility functions
```

---

## 🐛 Troubleshooting Quick Fixes

### "Port already in use"
```bash
# Find process using port 8000
lsof -i :8000

# Kill it
kill -9 <PID>
```

### "Cannot connect to database"
```bash
# Check MAMP is running
# Open /Applications/MAMP and click "Start Servers"

# Test connection
cd laravel-MKpr && php artisan db:show
```

### "npm ERR! code ENOENT"
```bash
# Reinstall dependencies
cd hovertask-dashboard
rm -rf node_modules package-lock.json
npm install
npm run dev
```

### "PHP version wrong"
```bash
# Check current PHP
php --version

# Should show 8.5.2. If not:
source ~/.zshrc

# Verify again
php --version
```

### "Composer dependencies missing"
```bash
cd laravel-MKpr
composer install
composer update
```

---

## 🎯 Workflow Example

### Complete Development Cycle
```bash
# 1. Start all services (3 terminals or background)
cd laravel-MKpr && php artisan serve --port 8000 &
cd hovertask-dashboard && npm run dev &
cd Hovertask-main && npm run dev &

# 2. Make API changes in Laravel
# Edit: laravel-MKpr/app/Http/Controllers/...
# Changes auto-reload

# 3. Make UI changes in React
# Edit: hovertask-dashboard/src/pages/...
# HMR (Hot Module Replacement) auto-updates

# 4. Test changes in browser
# Visit: http://localhost:5173

# 5. Check logs if issues
tail -f /tmp/laravel.log
tail -f /tmp/dashboard.log
```

---

## 📚 Documentation Files

All documentation is in `/Users/user/Desktop/hovertask/`:

- `WEBSITE_ARCHITECTURE.md` - Complete system design
- `PHP_UPDATE_COMPLETE.md` - PHP upgrade details
- `ALL_STEPS_COMPLETE.md` - Full completion summary
- `QUICK_COMMAND_REFERENCE.md` - This file

---

## ✨ System Info

```
Date: March 9, 2026
OS: macOS
PHP: 8.5.2 (MAMP)
Node: Latest
Database: MySQL (MAMP)
Services: 3 Running
Status: 🟢 FULLY OPERATIONAL
```

---

## 🎓 Next Steps

1. **Explore the code** - Start in `laravel-MKpr/app`
2. **Review WEBSITE_ARCHITECTURE.md** - Understand the system
3. **Make test changes** - Try editing a component
4. **Test the API** - Use curl to test endpoints
5. **Deploy when ready** - Follow deployment guides

---

## 💡 Pro Tips

✅ Use multiple terminal tabs to run services  
✅ Keep Browser DevTools open for debugging  
✅ Use `console.log()` for React debugging  
✅ Use Laravel Tinker for quick database queries  
✅ Watch the logs while testing  
✅ Clear cache if changes don't appear  
✅ Restart services if port conflicts occur  

---

**Happy Coding! 🚀**

For more info, see the documentation files or contact support.
