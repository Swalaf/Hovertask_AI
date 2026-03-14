#!/bin/bash

# Hovertask System Recovery Script
# This script will fix all common issues and restart all services

set -e

echo "╔════════════════════════════════════════════════════════════════╗"
echo "║        HOVERTASK SYSTEM RECOVERY & RESTART                    ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Step 1: Kill any existing processes
echo -e "${YELLOW}Step 1: Cleaning up old processes...${NC}"
pkill -f "php artisan serve" 2>/dev/null || true
pkill -f "npm run dev" 2>/dev/null || true
sleep 2
echo -e "${GREEN}✅ Old processes killed${NC}"
echo ""

# Step 2: Clear Laravel caches
echo -e "${YELLOW}Step 2: Clearing Laravel caches...${NC}"
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan optimize:clear > /dev/null 2>&1 || true
php artisan cache:clear > /dev/null 2>&1 || true
echo -e "${GREEN}✅ Caches cleared${NC}"
echo ""

# Step 3: Check database
echo -e "${YELLOW}Step 3: Verifying database connection...${NC}"
if php artisan db:show > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Database connected${NC}"
else
    echo -e "${RED}❌ Database connection failed${NC}"
    echo "   Ensure MAMP MySQL is running (port 8889)"
    exit 1
fi
echo ""

# Step 4: Start Laravel
echo -e "${YELLOW}Step 4: Starting Laravel API server...${NC}"
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve --port 8000 > /tmp/laravel.log 2>&1 &
LARAVEL_PID=$!
sleep 3

if ps -p $LARAVEL_PID > /dev/null; then
    echo -e "${GREEN}✅ Laravel started (PID: $LARAVEL_PID)${NC}"
else
    echo -e "${RED}❌ Laravel failed to start${NC}"
    tail -20 /tmp/laravel.log
    exit 1
fi
echo ""

# Step 5: Start React Dashboard
echo -e "${YELLOW}Step 5: Starting React Dashboard...${NC}"
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev > /tmp/dashboard.log 2>&1 &
DASHBOARD_PID=$!
sleep 3

if ps -p $DASHBOARD_PID > /dev/null 2>/dev/null || lsof -i :5173 > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Dashboard started${NC}"
else
    echo -e "${YELLOW}⚠️  Dashboard starting (may take longer)${NC}"
fi
echo ""

# Step 6: Start React Main
echo -e "${YELLOW}Step 6: Starting React Main website...${NC}"
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev > /tmp/main.log 2>&1 &
MAIN_PID=$!
sleep 3

if ps -p $MAIN_PID > /dev/null 2>/dev/null || lsof -i :5174 > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Main website started${NC}"
else
    echo -e "${YELLOW}⚠️  Main website starting (may take longer)${NC}"
fi
echo ""

# Step 7: Verification
echo -e "${YELLOW}Step 7: Verifying all services...${NC}"
sleep 3

echo ""
echo "Service Status:"
echo "─────────────────────────────────────"

if lsof -i :8000 > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Laravel API${NC} (port 8000)"
else
    echo -e "${RED}❌ Laravel API${NC} (port 8000) - Not responding"
fi

if lsof -i :5173 > /dev/null 2>&1; then
    echo -e "${GREEN}✅ React Dashboard${NC} (port 5173)"
else
    echo -e "${RED}❌ React Dashboard${NC} (port 5173) - Not responding"
fi

if lsof -i :5174 > /dev/null 2>&1; then
    echo -e "${GREEN}✅ React Main${NC} (port 5174)"
else
    echo -e "${RED}❌ React Main${NC} (port 5174) - Not responding"
fi

echo ""
echo -e "${GREEN}✅ SYSTEM RECOVERY COMPLETE!${NC}"
echo ""
echo "Access the system:"
echo "  📱 Dashboard: http://localhost:5173"
echo "  🌐 Main Site: http://localhost:5174"
echo "  🔌 API: http://localhost:8000/api"
echo ""
echo "Test login:"
echo "  Email: test@hovertask.com"
echo "  Password: password123"
echo ""
echo "View logs:"
echo "  Laravel: tail -f /tmp/laravel.log"
echo "  Dashboard: tail -f /tmp/dashboard.log"
echo "  Main: tail -f /tmp/main.log"
echo ""
