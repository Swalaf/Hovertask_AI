#!/bin/bash

# 🔧 Quick Start Script - Launch all services
# Run this to start everything at once

print_header() {
    echo ""
    echo "════════════════════════════════════════"
    echo "  $1"
    echo "════════════════════════════════════════"
    echo ""
}

print_header "🚀 Starting Hovertask Local Services"

# Check if MAMP is running
print_header "Checking MAMP"
if pgrep -q "Apache"; then
    echo "✓ Apache is running"
else
    echo "✗ Apache is not running. Please start MAMP."
    echo "  Open: /Applications/MAMP"
    echo "  Click 'Start Servers'"
    exit 1
fi

# Start Laravel
print_header "Starting Laravel Backend"
echo "Starting Laravel at http://localhost:8000"
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve &
LARAVEL_PID=$!
echo "Laravel PID: $LARAVEL_PID"

# Wait a moment for Laravel to start
sleep 3

# Start Dashboard
print_header "Starting React Dashboard"
echo "Starting Dashboard at http://localhost:5173"
cd /Users/user/Desktop/hovertask/hovertask-dashboard
npm run dev &
DASHBOARD_PID=$!
echo "Dashboard PID: $DASHBOARD_PID"

# Start Marketing Site (optional)
print_header "Starting React Marketing Site"
echo "Starting Marketing Site at http://localhost:5174"
cd /Users/user/Desktop/hovertask/Hovertask-main
npm run dev &
MARKETING_PID=$!
echo "Marketing Site PID: $MARKETING_PID"

# Print summary
print_header "✅ All Services Started!"
echo "Test Credentials:"
echo "  Email: test@hovertask.com"
echo "  Password: password123"
echo ""
echo "Access Points:"
echo "  Marketing Site: http://localhost:5174"
echo "  Dashboard:      http://localhost:5173"
echo "  Laravel API:    http://localhost:8000"
echo "  MAMP Dashboard: http://localhost:8888/MAMP/"
echo ""
echo "Processes:"
echo "  Laravel:   PID $LARAVEL_PID"
echo "  Dashboard: PID $DASHBOARD_PID"
echo "  Marketing: PID $MARKETING_PID"
echo ""
echo "To stop all services, press Ctrl+C"
echo "Or manually kill PIDs: kill $LARAVEL_PID $DASHBOARD_PID $MARKETING_PID"
echo ""

# Keep script running
wait
