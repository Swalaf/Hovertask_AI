#!/bin/bash

# 🚀 Hovertask Complete Local Setup Script
# This script automates the entire setup process

set -e  # Exit on error

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Print colored output
print_header() {
    echo -e "\n${BLUE}════════════════════════════════════════${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}════════════════════════════════════════${NC}\n"
}

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_info() {
    echo -e "${YELLOW}ℹ $1${NC}"
}

# Check prerequisites
print_header "Checking Prerequisites"

# Check Node.js
if ! command -v node &> /dev/null; then
    print_error "Node.js not installed. Please install from https://nodejs.org/"
    exit 1
fi
print_success "Node.js installed: $(node -v)"

# Check npm
if ! command -v npm &> /dev/null; then
    print_error "npm not installed"
    exit 1
fi
print_success "npm installed: $(npm -v)"

# Check Composer
if ! command -v composer &> /dev/null; then
    print_error "Composer not installed. Please install from https://getcomposer.org/"
    exit 1
fi
print_success "Composer installed: $(composer -v | head -n1)"

# Check Git
if ! command -v git &> /dev/null; then
    print_error "Git not installed"
    exit 1
fi
print_success "Git installed: $(git -v)"

# Check MAMP
if [ ! -d "/Applications/MAMP" ]; then
    print_error "MAMP not found in /Applications/MAMP"
    print_info "Please install MAMP from https://www.mamp.info/en/mac/"
    exit 1
fi
print_success "MAMP found at /Applications/MAMP"

# Setup Laravel Backend
print_header "Setting Up Laravel Backend"

cd /Users/user/Desktop/hovertask/laravel-MKpr

# Install Composer dependencies
print_info "Installing Composer dependencies..."
composer install
print_success "Composer dependencies installed"

# Copy .env.example to .env
if [ ! -f .env ]; then
    print_info "Creating .env file..."
    cp .env.example .env
    print_success ".env file created"
else
    print_info ".env already exists, skipping..."
fi

# Generate application key
print_info "Generating Laravel application key..."
php artisan key:generate
print_success "Application key generated"

# Create .env settings
print_info "Configuring .env for local development..."
cat > .env << 'EOF'
APP_NAME=Hovertask
APP_ENV=local
APP_KEY=base64:# (auto-generated above)
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hovertask_local
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=log
MAIL_FROM_ADDRESS=test@hovertask.local
MAIL_FROM_NAME="${APP_NAME}"

SANCTUM_STATEFUL_DOMAINS=localhost:3000,localhost:5173,localhost:5174,localhost:8000,localhost:8888
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:5000,http://localhost:5173,http://localhost:5174,http://localhost:8000,http://localhost:8888

PUSHER_APP_ID=test
PUSHER_APP_KEY=test
PUSHER_APP_SECRET=test
PUSHER_APP_CLUSTER=mt1

CLOUDINARY_URL=cloudinary://demo

PAYSTACK_PUBLIC_KEY=test_key
PAYSTACK_SECRET_KEY=test_key
EOF
print_success ".env configured"

# Storage link
print_info "Creating storage link..."
php artisan storage:link 2>/dev/null || true
print_success "Storage link created"

print_info "Running database migrations..."
php artisan migrate --force
print_success "Database migrations completed"

print_info "Creating test user..."
php artisan tinker <<'EOF'
App\Models\User::firstOrCreate(
    ['email' => 'test@hovertask.com'],
    [
        'fname' => 'Test',
        'lname' => 'User',
        'password' => bcrypt('password123'),
        'email_verified_at' => now(),
        'is_member' => true,
        'balance' => 50000,
        'how_you_want_to_use' => 'earn',
    ]
);
print("Test user created!\n");
exit;
EOF
print_success "Test user created"

# Setup React Dashboard
print_header "Setting Up React Dashboard"

cd /Users/user/Desktop/hovertask/hovertask-dashboard

print_info "Installing npm dependencies..."
npm install
print_success "Dependencies installed"

print_info "Creating .env.local..."
cat > .env.local << 'EOF'
VITE_API_URL=http://localhost:8000
EOF
print_success ".env.local created"

# Setup React Marketing Site
print_header "Setting Up React Marketing Site"

cd /Users/user/Desktop/hovertask/Hovertask-main

print_info "Installing npm dependencies..."
npm install
print_success "Dependencies installed"

print_info "Creating .env.local..."
cat > .env.local << 'EOF'
VITE_API_URL=http://localhost:8000
EOF
print_success ".env.local created"

# Completion message
print_header "✅ Setup Complete!"

echo -e "${GREEN}Everything is ready! Here's how to start:${NC}\n"

echo -e "${YELLOW}Terminal 1 - Laravel Backend:${NC}"
echo "cd /Users/user/Desktop/hovertask/laravel-MKpr"
echo "php artisan serve"
echo ""

echo -e "${YELLOW}Terminal 2 - React Dashboard:${NC}"
echo "cd /Users/user/Desktop/hovertask/hovertask-dashboard"
echo "npm run dev"
echo ""

echo -e "${YELLOW}Terminal 3 - React Marketing (Optional):${NC}"
echo "cd /Users/user/Desktop/hovertask/Hovertask-main"
echo "npm run dev"
echo ""

echo -e "${YELLOW}Test Credentials:${NC}"
echo "Email: test@hovertask.com"
echo "Password: password123"
echo ""

echo -e "${YELLOW}Access URLs:${NC}"
echo "Marketing Site: http://localhost:5174"
echo "Dashboard: http://localhost:5173"
echo "Laravel API: http://localhost:8000"
echo ""

echo -e "${GREEN}Happy coding! 🚀${NC}\n"
