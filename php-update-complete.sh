#!/bin/bash

# 🚀 HOVERTASK PHP UPDATE - Complete System Update to Latest PHP 8.5.2
# This script updates all PHP references system-wide and configures everything

echo "╔════════════════════════════════════════════════════════════════╗"
echo "║         🚀 HOVERTASK COMPLETE PHP UPDATE                       ║"
echo "║         Latest Version: PHP 8.5.2                             ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""

# Current state
echo "📊 CURRENT STATE:"
echo "  System PHP:  $(php --version | head -1)"
echo "  PHP Location: $(which php)"
echo ""

# Available MAMP versions
echo "✅ AVAILABLE MAMP VERSIONS:"
ls -la /Applications/MAMP/bin/php/ 2>/dev/null | grep "^d" | awk '{print "  " $NF}' || echo "  MAMP not found"
echo ""

# Latest version
LATEST_PHP="/Applications/MAMP/bin/php/php8.5.2/bin/php"
LATEST_PHP_VERSION="8.5.2"

if [ ! -f "$LATEST_PHP" ]; then
    echo "❌ PHP 8.5.2 not found in MAMP!"
    echo "Available versions:"
    ls /Applications/MAMP/bin/php/ | grep php
    exit 1
fi

echo "🔧 CONFIGURATION:"
echo "  Target PHP: $LATEST_PHP_VERSION"
echo "  Path: $LATEST_PHP"
echo ""

# Step 1: Update Shell Configuration
echo "📝 STEP 1: Updating Shell Configuration..."

# Detect shell
SHELL_RC="$HOME/.zshrc"
if [ ! -f "$SHELL_RC" ]; then
    SHELL_RC="$HOME/.bash_profile"
fi

# Remove old PHP exports if they exist
sed -i '' '/export PATH.*MAMP.*php.*bin/d' "$SHELL_RC" 2>/dev/null || true
sed -i '' '/export PATH.*Applications.*php.*bin/d' "$SHELL_RC" 2>/dev/null || true

# Add new PHP export at end
echo "" >> "$SHELL_RC"
echo "# HOVERTASK PHP 8.5.2 Configuration (Updated $(date))" >> "$SHELL_RC"
echo "export PATH=\"/Applications/MAMP/bin/php/php8.5.2/bin:\$PATH\"" >> "$SHELL_RC"
echo "export PHP_VERSION=\"8.5.2\"" >> "$SHELL_RC"

echo "✓ Updated: $SHELL_RC"
echo ""

# Step 2: Update Current Session
echo "📝 STEP 2: Updating Current Session..."
export PATH="/Applications/MAMP/bin/php/php8.5.2/bin:$PATH"
export PHP_VERSION="8.5.2"
echo "✓ Current session updated"
echo ""

# Step 3: Verify PHP Update
echo "📝 STEP 3: Verifying PHP Installation..."
echo ""
echo "  New PHP Version:"
php --version | head -1 | sed 's/^/    /'
echo ""
echo "  PHP Location:"
which php | sed 's/^/    /'
echo ""
echo "  PHP Executable:"
php -r "echo '    ' . PHP_SAPI . ' (' . php_uname() . ')' . PHP_EOL;"
echo ""

# Step 4: Update Laravel Project
echo "📝 STEP 4: Checking Laravel Project..."
LARAVEL_DIR="/Users/user/Desktop/hovertask/laravel-MKpr"

if [ -d "$LARAVEL_DIR" ]; then
    echo "  Found Laravel project: $LARAVEL_DIR"
    echo "  Checking composer.json..."
    
    if [ -f "$LARAVEL_DIR/composer.json" ]; then
        echo "✓ composer.json found"
        
        # Show current PHP requirement
        echo "  Current PHP requirement:"
        grep -A 1 '"php"' "$LARAVEL_DIR/composer.json" | head -2 | sed 's/^/    /'
    fi
fi
echo ""

# Step 5: Kill Old Processes
echo "📝 STEP 5: Cleaning Up Old Processes..."
echo "  Killing processes on ports 8000, 5173, 5174..."

for port in 8000 5173 5174; do
    PID=$(lsof -ti:$port 2>/dev/null)
    if [ -n "$PID" ]; then
        kill -9 $PID 2>/dev/null
        echo "  ✓ Killed process on port $port"
    fi
done
echo ""

# Step 6: Summary
echo "╔════════════════════════════════════════════════════════════════╗"
echo "║              ✅ PHP UPDATE COMPLETE!                          ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""
echo "📋 SUMMARY:"
echo "  ✓ Shell configuration updated"
echo "  ✓ PHP 8.5.2 activated in PATH"
echo "  ✓ Old processes cleaned up"
echo ""

echo "🔄 Next Steps:"
echo "  1. Close and reopen terminal (or run: source $SHELL_RC)"
echo "  2. Verify: php --version"
echo "  3. Start services: bash /Users/user/Desktop/hovertask/run.sh"
echo ""

echo "📊 Verify with:"
echo "  php --version"
echo "  php -i | grep \"PHP Version\""
echo "  php -m (to see installed modules)"
echo ""

echo "🚀 Ready! Run this to start everything:"
echo "  bash /Users/user/Desktop/hovertask/run.sh"
echo ""
