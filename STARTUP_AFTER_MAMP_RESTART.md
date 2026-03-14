# 🚀 HOVERTASK - COMPLETE SYSTEM STARTUP GUIDE

## After MAMP Restart - Follow These Steps

Since MAMP has been restarted, follow these steps to get everything running:

---

## ✅ Step 1: Verify PHP Version

Open **Terminal** and run:
```bash
php --version
```

**Expected**: `PHP 8.5.2`

If you see `PHP 7.3.x`, close terminal and reopen it.

---

## ✅ Step 2: Clear Laravel Caches

```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan optimize:clear
```

---

## ✅ Step 3: Start Laravel API Server

Open **Terminal 1** and run:
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve --port 8000
```

**Expected Output**:
```
INFO  Server running on [http://127.0.0.1:8000]
```

Leave this terminal running.

---

## ✅ Step 4: Start React Dashboard

Open **Terminal 2** and run:
```bash
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev
```

**Expected Output**:
```
VITE v6.0.0  ready in XXX ms

➜  Local:   http://localhost:5173/
```

Leave this terminal running.

---

## ✅ Step 5: Start React Main Website

Open **Terminal 3** and run:
```bash
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev
```

**Expected Output**:
```
VITE v6.0.0  ready in XXX ms

➜  Local:   http://localhost:5174/
```

Leave this terminal running.

---

## ✅ Step 6: Access the Dashboard

In your browser, visit:
```
http://localhost:5173
```

---

## ✅ Step 7: Login

Use these credentials:
```
Email:    test@hovertask.com
Password: password123
```

---

## Troubleshooting After MAMP Restart

### Problem: "Connection Refused" on port 8000

**Solution**: Check if Laravel server is running
```bash
lsof -i :8000
```

If empty, restart Laravel:
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve --port 8000
```

---

### Problem: "Port 8000 already in use"

**Solution**: Kill the old process
```bash
lsof -i :8000 | grep LISTEN | awk '{print $2}' | xargs kill -9
```

Then restart:
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve --port 8000
```

---

### Problem: Database connection error

**Solution 1**: Verify MySQL is running in MAMP
- Open MAMP application
- Click "Start Servers"
- Wait for all services to turn green

**Solution 2**: Test connection
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan db:show
```

**Solution 3**: Restart MySQL in MAMP
- Open MAMP
- Click "Stop Servers"
- Wait 5 seconds
- Click "Start Servers"
- Try again

---

### Problem: Still getting 500 errors

**Solution**: Clear everything and restart

```bash
# Terminal 1: Kill Laravel
lsof -i :8000 | grep LISTEN | awk '{print $2}' | xargs kill -9 2>/dev/null

# Clear caches
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan optimize:clear

# Restart Laravel
php artisan serve --port 8000
```

Then try the API request again.

---

## Quick System Check

Run this to verify everything is working:

```bash
echo "=== SYSTEM CHECK ===" 

echo ""
echo "1. PHP Version:"
php --version | head -1

echo ""
echo "2. Database:"
cd /Users/user/Desktop/hovertask/laravel-MKpr && php artisan db:show | head -1

echo ""
echo "3. Laravel API:"
curl -s http://localhost:8000 | head -1

echo ""
echo "4. Dashboard:"
curl -s http://localhost:5173 | head -1

echo ""
echo "5. Services Listening:"
lsof -i -P -n 2>/dev/null | grep LISTEN | grep -E "8000|5173|5174"
```

---

## One-Line System Recovery

If everything is broken, run this:

```bash
# Kill everything
pkill -f "php artisan serve" 2>/dev/null
pkill -f "npm run dev" 2>/dev/null

# Wait
sleep 2

# Start Laravel
cd /Users/user/Desktop/hovertask/laravel-MKpr && php artisan serve --port 8000 &

# Start Dashboard
cd /Users/user/Desktop/hovertask/hovertask-dashboard && npm run dev &

# Start Main
cd /Users/user/Desktop/hovertask/Hovertask-main && npm run dev &

# Wait
sleep 5

# Check status
lsof -i -P -n 2>/dev/null | grep LISTEN | grep -E "8000|5173|5174"
```

---

## Quick Commands Reference

### Check if Services are Running
```bash
lsof -i -P -n | grep LISTEN | grep -E "8000|5173|5174"
```

### View Laravel Logs
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

### Test Login API
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}'
```

### Clear Laravel Cache
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan optimize:clear
```

### Restart MySQL
Open MAMP > Stop Servers > Wait > Start Servers

---

## Expected Behavior After Everything Restarts

✅ **Port 8000** (Laravel API)
- Shows "Server running on [http://127.0.0.1:8000]"
- API responds to requests

✅ **Port 5173** (React Dashboard)
- Shows "Local: http://localhost:5173"
- Dashboard loads in browser

✅ **Port 5174** (React Main)
- Shows "Local: http://localhost:5174"
- Main website loads in browser

✅ **MySQL**
- MAMP shows "Server Running"
- Databases can be accessed

---

## Most Common Issues After MAMP Restart

| Issue | Fix |
|-------|-----|
| PHP still shows 7.3 | Close and reopen terminal |
| Port 8000 in use | `lsof -i :8000 \| awk '{print $2}' \| xargs kill -9` |
| Database won't connect | Check MAMP MySQL is running |
| Stil getting 500 errors | `php artisan optimize:clear` then restart |
| React won't load | Check ports 5173/5174 are free |

---

## Success Indicators

When everything is working correctly, you should see:

1. **Terminal 1 (Laravel)**:
   ```
   INFO  Server running on [http://127.0.0.1:8000]
   ```

2. **Terminal 2 (Dashboard)**:
   ```
   ➜  Local:   http://localhost:5173/
   ```

3. **Terminal 3 (Main)**:
   ```
   ➜  Local:   http://localhost:5174/
   ```

4. **MAMP Application**:
   - Apache: Green
   - MySQL: Green
   - All running

5. **Browser**:
   - http://localhost:5173 loads the dashboard
   - Login with test@hovertask.com / password123 works

---

## Final Verification

After all services are running, test with:

```bash
# Test 1: API responds
curl http://localhost:8000/api

# Test 2: Dashboard loads  
curl http://localhost:5173

# Test 3: All services listening
lsof -i -P -n 2>/dev/null | grep -E "8000|5173|5174" | wc -l
# Should output: 3 or more
```

---

## If You Still Have Issues

1. **Check Laravel logs**: 
   ```bash
   tail -100 /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
   ```

2. **Check npm logs**:
   ```bash
   tail -50 /tmp/dashboard.log
   tail -50 /tmp/main.log
   ```

3. **Verify MAMP**:
   - Open MAMP application
   - Verify Apache and MySQL are both running (green)
   - Check the "MySQL" tab shows the database

4. **Test database directly**:
   ```bash
   cd /Users/user/Desktop/hovertask/laravel-MKpr
   php artisan tinker
   # Type: DB::connection()->getPdo()
   # Should return a PDO object
   # Type: exit
   ```

---

## Summary

After MAMP restart:

1. ✅ Open 3 terminals
2. ✅ Run Laravel in Terminal 1
3. ✅ Run Dashboard in Terminal 2
4. ✅ Run Main in Terminal 3
5. ✅ Visit http://localhost:5173
6. ✅ Login with test@hovertask.com / password123

**That's it! Your system is ready.**

---

**Last Updated**: March 9, 2026  
**Status**: Ready to use after MAMP restart  
**Next Step**: Follow the steps above
