# 🔄 COMPLETE LARAVEL AUTHENTICATION & API REBUILD

## Overview
We'll rebuild the entire Laravel authentication system and API backend from scratch with:
- ✅ Modern Sanctum authentication
- ✅ Clean API architecture
- ✅ Proper error handling
- ✅ User registration & login
- ✅ Token-based auth
- ✅ Protected routes
- ✅ Complete test user setup

---

## Phase 1: Fresh Start

### Step 1: Backup Current Setup
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr

# Create backup
cp -r . ../laravel-MKpr-backup-$(date +%Y%m%d)
echo "✅ Backup created"
```

### Step 2: Clear Everything
```bash
# Remove cache files
rm -rf storage/logs/*
rm -rf bootstrap/cache/*

# Clear database (if needed)
# php artisan migrate:reset
```

---

## Phase 2: Authentication System Rebuild

### Step 1: Update User Model

File: `app/Models/User.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'lname',
        'fname',
        'email',
        'username',
        'password',
        'phone',
        'country',
        'currency',
        'avatar',
        'bio',
        'email_verified_at',
        'is_member',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_member' => 'boolean',
    ];

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }
}
```

### Step 2: Create Authentication Controller

File: `app/Http/Controllers/Api/AuthController.php`

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'fname' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users',
                'username' => 'required|string|unique:users|min:3',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|string|min:7|max:15|unique:users',
                'country' => 'required|string|size:2',
                'currency' => 'required|string|size:3',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'lname' => $validated['lname'],
                'fname' => $validated['fname'],
                'email' => $validated['email'],
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['phone'],
                'country' => $validated['country'],
                'currency' => $validated['currency'],
                'email_verified_at' => now(),
            ]);

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Registration successful',
                'token' => $token,
                'user' => $user,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Registration failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Login failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get current user
     */
    public function user(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'user' => $request->user(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'lname' => 'sometimes|string|max:255',
                'fname' => 'sometimes|string|max:255',
                'bio' => 'sometimes|string|max:500',
                'avatar' => 'sometimes|string',
                'phone' => 'sometimes|string|unique:users,phone,' . auth()->id(),
            ]);

            $request->user()->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Profile updated',
                'user' => $request->user(),
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Update failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            if (!Hash::check($validated['current_password'], auth()->user()->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Current password is incorrect',
                ], 401);
            }

            auth()->user()->update([
                'password' => Hash::make($validated['new_password']),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully',
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logout successful',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Logout failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
```

### Step 3: Create Dashboard Controller

File: `app/Http/Controllers/Api/DashboardController.php`

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get dashboard data
     */
    public function dashboard(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'status' => true,
                'data' => [
                    'user' => $user,
                    'balance' => 0,
                    'tasks_completed' => 0,
                    'earnings' => 0,
                    'statistics' => [
                        'total_tasks' => 0,
                        'total_adverts' => 0,
                        'total_sales' => 0,
                    ],
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user dashboard data
     */
    public function user(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'user' => $request->user(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
```

---

## Phase 3: Update Routes

File: `routes/api.php`

```php
<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // Dashboard routes
    Route::prefix('v1')->group(function () {
        Route::get('/dashboard/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('/dashboard/user', [DashboardController::class, 'user']);
    });
});

// Health check
Route::get('/health', function () {
    return response()->json(['status' => 'ok'], 200);
});
```

---

## Phase 4: Database & Migrations

### Step 1: Run migrations (if not already done)
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan migrate --force
```

### Step 2: Create test user seeder

File: `database/seeders/TestUserSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@hovertask.com'],
            [
                'name' => 'Test',
                'lname' => 'User',
                'fname' => 'Test',
                'username' => 'testuser',
                'email' => 'test@hovertask.com',
                'password' => Hash::make('password123'),
                'phone' => '08012345678',
                'country' => 'NG',
                'currency' => 'NGN',
                'email_verified_at' => now(),
                'is_member' => true,
            ]
        );

        echo "✅ Test user created/verified\n";
    }
}
```

### Step 3: Run seeder
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan db:seed --class=TestUserSeeder
```

---

## Phase 5: Configuration

### Update CORS (config/cors.php)
```php
'allowed_origins' => ['http://localhost:5173', 'http://localhost:5174'],
'supports_credentials' => true,
```

### Update Sanctum (config/sanctum.php)
```php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost,localhost:3000,localhost:5173,localhost:5174')),
```

---

## Phase 6: Testing

### Test 1: Register New User
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John",
    "lname": "Doe",
    "fname": "John",
    "email": "john@example.com",
    "username": "johndoe",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "08098765432",
    "country": "NG",
    "currency": "NGN"
  }'
```

### Test 2: Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@hovertask.com",
    "password": "password123"
  }'
```

### Test 3: Get User (Protected)
```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
  http://localhost:8000/api/user
```

### Test 4: Get Dashboard (Protected)
```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
  http://localhost:8000/api/v1/dashboard/dashboard
```

---

## Phase 7: Common Issues & Fixes

### Issue: "Target class does not exist"
**Solution**: Check namespace in controller matches class location

### Issue: "Route not defined"
**Solution**: Clear route cache
```bash
php artisan route:clear
php artisan optimize:clear
```

### Issue: "CORS error"
**Solution**: Ensure CORS middleware is configured and headers are set

### Issue: "Token not working"
**Solution**: 
```bash
# Regenerate sanctum tokens
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## Rebuild Checklist

- [ ] User model updated
- [ ] AuthController created
- [ ] DashboardController created
- [ ] Routes updated (api.php)
- [ ] Migrations run
- [ ] Test user seeder created
- [ ] CORS configured
- [ ] Sanctum configured
- [ ] Test user created via seeder
- [ ] API endpoints tested with curl
- [ ] Login endpoint working
- [ ] Protected routes working
- [ ] Token generation working

---

## Quick Start After Rebuild

```bash
# 1. Navigate to Laravel
cd /Users/user/Desktop/hovertask/laravel-MKpr

# 2. Clear everything
php artisan optimize:clear

# 3. Run migrations
php artisan migrate --force

# 4. Create test user
php artisan db:seed --class=TestUserSeeder

# 5. Start server
php artisan serve --port 8000

# 6. In another terminal, test login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}'
```

---

## Next: Rebuilding Additional Endpoints

After core auth works, we'll rebuild:
- Tasks endpoints
- Products/Marketplace endpoints
- Advertisements endpoints
- Wallet endpoints
- User profile endpoints
- Analytics endpoints

---

**Ready to start the rebuild?**

Follow the steps above in order, and we'll have a clean, working authentication system!
