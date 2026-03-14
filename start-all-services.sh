#!/bin/bash

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}  🚀 Starting Hovertask Services${NC}"
echo -e "${BLUE}========================================${NC}"
echo ""

# Start Laravel Backend
echo -e "${GREEN}[1/3]${NC} Starting ${YELLOW}Laravel Backend${NC} on http://localhost:8000"
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve &
LARAVEL_PID=$!
echo -e "${GREEN}✓ Laravel PID: $LARAVEL_PID${NC}"
echo ""

# Wait a moment for Laravel to start
sleep 3

# Start React Dashboard
echo -e "${GREEN}[2/3]${NC} Starting ${YELLOW}React Dashboard${NC} on http://localhost:5173"
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev &
DASHBOARD_PID=$!
echo -e "${GREEN}✓ Dashboard PID: $DASHBOARD_PID${NC}"
echo ""

# Wait a moment
sleep 2

# Start React Marketing Site
echo -e "${GREEN}[3/3]${NC} Starting ${YELLOW}React Marketing Website${NC} on http://localhost:5174"
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev &
MARKETING_PID=$!
echo -e "${GREEN}✓ Marketing Site PID: $MARKETING_PID${NC}"
echo ""

echo -e "${BLUE}========================================${NC}"
echo -e "${GREEN}✅ All Services Started!${NC}"
echo -e "${BLUE}========================================${NC}"
echo ""
echo -e "${YELLOW}🌐 Access Points:${NC}"
echo -e "  • Dashboard:   ${GREEN}http://localhost:5173${NC}"
echo -e "  • Marketing:   ${GREEN}http://localhost:5174${NC}"
echo -e "  • API:         ${GREEN}http://localhost:8000${NC}"
echo ""
echo -e "${YELLOW}🔑 Login Credentials:${NC}"
echo -e "  • Email:    ${GREEN}test@hovertask.com${NC}"
echo -e "  • Password: ${GREEN}password123${NC}"
echo ""
echo -e "${YELLOW}📊 Process IDs:${NC}"
echo -e "  • Laravel:   $LARAVEL_PID"
echo -e "  • Dashboard: $DASHBOARD_PID"
echo -e "  • Marketing: $MARKETING_PID"
echo ""
echo -e "${YELLOW}⚠️  To stop all services, run:${NC}"
echo -e "  ${GREEN}kill $LARAVEL_PID $DASHBOARD_PID $MARKETING_PID${NC}"
echo ""
echo -e "${BLUE}========================================${NC}"
echo -e "Press Ctrl+C to stop the script (services will continue running)"
echo -e "${BLUE}========================================${NC}"
echo ""

# Wait for all processes
wait
