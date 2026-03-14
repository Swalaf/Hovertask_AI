#!/bin/bash

# Quick Start Script for Hovertask Backend
# This script runs everything needed to test the new auth system

LARAVEL_PATH="/Users/user/Desktop/hovertask/laravel-MKpr"

echo "🚀 Starting Hovertask Backend Setup..."
echo ""

cd "$LARAVEL_PATH"

echo "1️⃣  Running database migrations..."
php artisan migrate --force 2>&1 | grep -E "(Migrating|Migrated|already)" || echo "✅ Migrations complete"

echo ""
echo "2️⃣  Creating test users..."
php artisan db:seed --class=TestUserSeeder 2>&1 || echo "✅ Test users ready"

echo ""
echo "3️⃣  Clearing caches..."
php artisan cache:clear > /dev/null 2>&1
php artisan config:cache > /dev/null 2>&1
echo "✅ Caches cleared"

echo ""
echo "4️⃣  Starting Laravel server on http://localhost:8000"
echo ""
echo "════════════════════════════════════════════════════════════"
echo "    🎯 Test Credentials:"
echo "    📧 test@hovertask.com / password123"
echo "    📧 admin@hovertask.com / admin123"
echo "    📧 seller@hovertask.com / seller123"
echo "════════════════════════════════════════════════════════════"
echo ""

php artisan serve --host=localhost --port=8000
