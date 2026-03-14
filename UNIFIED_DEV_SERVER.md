# 🚀 UNIFIED DEV SERVER - One Command Solution

## The Problem ❌
Running 3 separate terminals is tedious:
```bash
Terminal 1: cd laravel-MKpr && php artisan serve
Terminal 2: cd hovertask-dashboard && npm run dev
Terminal 3: cd Hovertask-main && npm run dev
```

## The Solution ✅
Now you can start EVERYTHING with ONE command:

```bash
bash /Users/user/Desktop/hovertask/run.sh
```

That's it! 🎉

---

## 🎯 What You Get

### Before (Complex)
```
Terminal 1 → Laravel Backend
Terminal 2 → React Dashboard
Terminal 3 → React Marketing
Terminal 4 → Monitoring/Debugging
= 4+ terminal windows needed
```

### After (Simple)
```
Single Terminal → All Three Services + Auto Browser Open
= 1 terminal window, everything running!
```

---

## 📋 Quick Start

**Copy and paste this ONE command:**
```bash
bash /Users/user/Desktop/hovertask/run.sh
```

**What happens automatically:**
✅ Starts Laravel backend on :8000  
✅ Starts React dashboard on :5173  
✅ Starts React marketing on :5174  
✅ Opens browser to dashboard  
✅ Kills any zombie processes  
✅ Shows you the access URLs  

---

## 🌐 Access Points

Once running, visit:
| Service | URL |
|---------|-----|
| Dashboard | http://localhost:5173 |
| Marketing | http://localhost:5174 |
| API | http://localhost:8000 |

---

## 🔑 Login

```
Email:    test@hovertask.com
Password: password123
```

---

## ⚙️ Managing Services

### Stop Everything
Press `Ctrl+C` in the terminal

### View Logs (in separate terminal)
```bash
# Laravel logs
tail -f ~/.hovertask/logs/laravel.log

# Dashboard logs
tail -f ~/.hovertask/logs/dashboard.log

# Marketing logs
tail -f ~/.hovertask/logs/marketing.log
```

### Kill Specific Port
```bash
# Kill port 8000 (Laravel)
lsof -ti:8000 | xargs kill -9

# Kill port 5173 (Dashboard)
lsof -ti:5173 | xargs kill -9

# Kill port 5174 (Marketing)
lsof -ti:5174 | xargs kill -9
```

---

## 🔧 Architecture - Why This Works

### Original Architecture (Production)
```
Separate Deployments
├── Frontend (Vercel)
├── Backend (Railway/Render)
└── Marketing (Vercel)
```

**Problem for Local Dev**: Need 3 terminals

### New Development Approach
```
Unified Dev Environment
├── Single Parent Process
├── Manages 3 Child Processes
└── Single Terminal Needed
```

**Benefits**:
✅ One terminal window  
✅ Auto cleanup on exit  
✅ Single Ctrl+C to stop all  
✅ Shared logging  
✅ Same as production code  

---

## 📊 Process Management

### Automated Port Cleanup
The script automatically kills any stale processes:
```bash
lsof -ti:8000 | xargs kill -9
lsof -ti:5173 | xargs kill -9
lsof -ti:5174 | xargs kill -9
```

This prevents "port already in use" errors.

### Process Tracking
```
PIDs shown in console output:
- Laravel PID: XXXXX
- Dashboard PID: XXXXX
- Marketing PID: XXXXX
```

---

## 🚨 Troubleshooting

### "Port already in use"
```bash
# Already handled! Script auto-kills stale processes
# Just run the script again
```

### "Permission denied"
```bash
chmod +x /Users/user/Desktop/hovertask/run.sh
```

### Service won't start
```bash
# Check logs
tail -f ~/.hovertask/logs/laravel.log
tail -f ~/.hovertask/logs/dashboard.log
tail -f ~/.hovertask/logs/marketing.log
```

### Need individual terminals (for debugging)
```bash
# Still supported! Run in separate terminals:
cd /Users/user/Desktop/hovertask/laravel-MKpr && php artisan serve
cd /Users/user/Desktop/hovertask/hovertask-dashboard && npm run dev
cd /Users/user/Desktop/hovertask/Hovertask-main && npm run dev
```

---

## 💡 Advanced Usage

### Custom Ports
Edit `run.sh` and change:
```bash
LARAVEL_PORT=8000      # Change this
DASHBOARD_PORT=5173    # Or this
MARKETING_PORT=5174    # Or this
```

### Keep Running in Background
```bash
# Start and detach
nohup bash /Users/user/Desktop/hovertask/run.sh > dev.log 2>&1 &

# Later, stop it
pkill -f "dev-server"
```

### Docker Alternative
We can also containerize this if you prefer:
```bash
# Future enhancement: docker-compose.yml
docker-compose up
```

---

## 🎯 Recommended Workflow

### Daily Development
```bash
# Morning: Start all services
bash /Users/user/Desktop/hovertask/run.sh

# Work...

# Evening: Ctrl+C to stop
```

### Separate Terminal Monitoring (Optional)
```bash
# Terminal 1: Main server
bash /Users/user/Desktop/hovertask/run.sh

# Terminal 2 (optional): Monitor Laravel logs
tail -f ~/.hovertask/logs/laravel.log

# Terminal 3 (optional): Monitor React logs
tail -f ~/.hovertask/logs/dashboard.log
```

---

## 📈 Comparison

| Task | Before | After |
|------|--------|-------|
| Start all services | 3 commands | 1 command |
| Terminal windows | 3+ | 1 |
| Stop services | 3x Ctrl+C | 1x Ctrl+C |
| Check status | Manual | Automatic |
| Kill zombies | Manual | Automatic |
| See all URLs | Manual | Automatic |
| Setup time | 5 min | 1 second |

---

## 🎉 You're All Set!

Run this command and you're done:
```bash
bash /Users/user/Desktop/hovertask/run.sh
```

Everything else is automatic! 🚀

---

## 📞 Need Help?

Problems? Check:
1. **Port conflicts**: Script auto-kills them
2. **Missing dependencies**: Run `bash setup.sh` first
3. **Database issues**: Check `laravel.log`
4. **Frontend issues**: Check `dashboard.log`

The unified dev server handles 99% of common issues automatically!
