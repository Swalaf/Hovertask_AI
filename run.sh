#!/bin/bash

# 🚀 HOVERTASK UNIFIED DEV SERVER
# One command to run everything!

# Navigate to hovertask root
cd "$(dirname "$0")" || exit

# Start all three services in background
echo "🚀 Starting Hovertask services..."

# Kill any existing processes on these ports
lsof -ti:8000 | xargs kill -9 2>/dev/null
lsof -ti:5173 | xargs kill -9 2>/dev/null
lsof -ti:5174 | xargs kill -9 2>/dev/null

# Start Laravel backend
cd laravel-MKpr
php artisan serve --port=8000 &
LARAVEL=$!
echo "✓ Laravel backend started (PID: $LARAVEL)"
sleep 2

# Start React Dashboard
cd ../hovertask-dashboard
npm run dev &
DASHBOARD=$!
echo "✓ React dashboard started (PID: $DASHBOARD)"
sleep 3

# Start React Marketing
cd ../Hovertask-main
npm run dev &
MARKETING=$!
echo "✓ React marketing started (PID: $MARKETING)"

echo ""
echo "════════════════════════════════════════════"
echo "✅ ALL SERVICES RUNNING!"
echo "════════════════════════════════════════════"
echo ""
echo "🌐 Dashboard:  http://localhost:5173"
echo "🌐 Marketing:  http://localhost:5174"
echo "🔌 API:        http://localhost:8000"
echo ""
echo "🔑 Login: test@hovertask.com / password123"
echo ""
echo "Press Ctrl+C to stop all services"
echo "════════════════════════════════════════════"
echo ""

# Wait for Ctrl+C
trap "kill $LARAVEL $DASHBOARD $MARKETING 2>/dev/null; echo 'Services stopped'; exit 0" SIGINT

wait
