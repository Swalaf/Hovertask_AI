#!/bin/bash

# 🚀 Fix PHP Version - Use MAMP PHP 8.3 Instead of System PHP 7.3

echo "🔧 Fixing PHP version issue..."
echo ""

# Add MAMP PHP to PATH
export PATH="/Applications/MAMP/bin/php/php8.3.30/bin:$PATH"

# Verify
echo "✓ PHP Path Updated"
echo ""
echo "Checking PHP version:"
php --version
echo ""

# Confirm it's the right version
PHP_VERSION=$(php -r "echo PHP_VERSION;" 2>/dev/null | cut -d'.' -f1)
if [ "$PHP_VERSION" -eq "8" ]; then
    echo "✅ PHP 8.x detected! Ready to start."
    echo ""
    echo "Starting Hovertask services..."
    echo ""
    cd /Users/user/Desktop/hovertask
    bash run.sh
else
    echo "❌ PHP version still incorrect. Please check PATH configuration."
    exit 1
fi
