# 🔧 FIXING THE 500 ERROR - Server Error Diagnosis

## Error Message
```
Sorry, your request failed. Please try again. 
Request id: 3275077a-bbdc-4974-9f87-45d3159ddcad

Reason: Server error: 500
```

---

## Common Causes & Solutions

### 1. ❌ Problem: Empty Request Body
**Error**: When sending POST/PUT requests without proper JSON body

**Solution**:
```bash
# ❌ WRONG - No body
curl -X POST http://localhost:8000/api/login

# ✅ CORRECT - With proper JSON
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}'
```

---

### 2. ❌ Problem: Missing Authorization Header
**Error**: When endpoint requires authentication

**Solution**:
```bash
# First, get token from login
TOKEN=$(curl -s -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}' \
  | grep -o '"token":"[^"]*"' | cut -d'"' -f4)

# Then use token in requests
curl -H "Authorization: Bearer $TOKEN" \
  http://localhost:8000/api/v1/dashboard/dashboard
```

---

### 3. ❌ Problem: Invalid JSON Format
**Error**: Malformed JSON in request body

**Solution**:
```bash
# ❌ WRONG - Unquoted strings
curl -X POST http://localhost:8000/api/login \
  -d '{email:test@hovertask.com,password:password123}'

# ✅ CORRECT - Properly quoted
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}'
```

---

### 4. ❌ Problem: Wrong Content-Type Header
**Error**: API doesn't recognize request format

**Solution**:
```bash
# ✅ Always include this for JSON
-H "Content-Type: application/json"

# Full example:
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}'
```

---

### 5. ❌ Problem: Laravel Not Running
**Error**: Connection refused or timeout

**Solution**:
```bash
# Check if Laravel is running
ps aux | grep "php artisan serve"

# If not running, start it:
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve --port 8000
```

---

### 6. ❌ Problem: Database Connection Issues
**Error**: 500 error with database-related operations

**Solution**:
```bash
# Check database connection
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan db:show

# If error, ensure MAMP MySQL is running:
# 1. Open MAMP application
# 2. Click "Start Servers"
# 3. Verify MySQL is running
```

---

### 7. ❌ Problem: Outdated Cache
**Error**: Unexpected behavior or wrong data

**Solution**:
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Or use fresh cache
php artisan optimize:clear
```

---

### 8. ❌ Problem: Missing Environment Variables
**Error**: Configuration errors

**Solution**:
```bash
# Check .env file
cd /Users/user/Desktop/hovertask/laravel-MKpr
cat .env

# Should have:
# DB_CONNECTION=mysql
# DB_HOST=localhost
# DB_PORT=3306
# DB_DATABASE=hovertask
# DB_USERNAME=root
# DB_PASSWORD=root

# Generate new app key if missing
php artisan key:generate
```

---

### 9. ❌ Problem: Invalid API Endpoint
**Error**: 404 Not Found (wrong URL)

**Solution**:
```bash
# Check correct endpoint format
# Base: http://localhost:8000/api/

# Valid endpoints:
GET  /api/v1/dashboard/dashboard
GET  /api/v1/dashboard/user
POST /api/login
POST /api/register
GET  /api/v1/task
POST /api/v1/product

# Invalid endpoints:
GET  /api/v1/category              # ❌ Wrong - route doesn't exist
POST /api/dashboard/dashboard      # ❌ Wrong - missing /v1/
```

---

### 10. ❌ Problem: CORS Error
**Error**: Cross-origin request blocked

**Solution**:
```bash
# Add CORS headers to your frontend requests
curl -X GET http://localhost:8000/api/v1/dashboard/dashboard \
  -H "Authorization: Bearer TOKEN" \
  -H "Origin: http://localhost:5173" \
  -H "Access-Control-Request-Method: GET"

# Frontend should work automatically if running on localhost:5173
```

---

## Quick Diagnostic Steps

### Step 1: Verify Services Are Running
```bash
# Check all 3 services
lsof -i -P -n | grep -E "8000|5173|5174"

# Should show:
# php ... 127.0.0.1:8000 (LISTEN)
# node ... [::1]:5173 (LISTEN)
# node ... [::1]:5174 (LISTEN)
```

### Step 2: Test Laravel API Directly
```bash
# Simple health check
curl http://localhost:8000/api

# Check login endpoint
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}'
```

### Step 3: View Laravel Logs
```bash
# Real-time logs
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log

# View recent errors
tail -100 /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log | grep -i "error\|exception"
```

### Step 4: Test Database Connection
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr

# Try Tinker
php artisan tinker

# Inside tinker:
> DB::connection()->getPdo()     # Should return PDO object
> App\Models\User::count()       # Should return number
> exit
```

---

## Complete Working Examples

### ✅ Login (Get Token)
```bash
curl -s -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@hovertask.com",
    "password": "password123"
  }' | jq .
```

**Expected Response**:
```json
{
  "status": true,
  "token": "1|abc123def456...",
  "user": {
    "id": 1,
    "email": "test@hovertask.com",
    "name": "Test",
    ...
  }
}
```

### ✅ Authenticated Request
```bash
# First get token
TOKEN="1|abc123def456..."

# Then use it
curl -H "Authorization: Bearer $TOKEN" \
  http://localhost:8000/api/v1/dashboard/dashboard | jq .
```

### ✅ Create Resource
```bash
curl -X POST http://localhost:8000/api/v1/product \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Product Name",
    "description": "Product description",
    "price": 1000,
    "category_id": 1
  }' | jq .
```

---

## Frontend-Specific Fixes

### If Error in React Dashboard

**Check 1: API Base URL**
```typescript
// Check src/utils/apiEndpointBaseURL
// Should be: http://localhost:8000

const API_BASE = process.env.REACT_APP_API_URL || 'http://localhost:8000';
```

**Check 2: Network Tab**
- Open browser DevTools (F12)
- Go to Network tab
- Trigger the action that fails
- See the actual API request and response

**Check 3: Console Errors**
- Open browser Console (F12)
- Look for red error messages
- Check error details

**Check 4: CORS Issues**
```typescript
// If CORS error, make sure:
1. Laravel is running
2. Frontend is on correct origin (http://localhost:5173)
3. API has CORS headers configured
```

---

## Error Codes Reference

| Code | Meaning | Solution |
|------|---------|----------|
| 400 | Bad Request | Check JSON format and required fields |
| 401 | Unauthorized | Include valid Bearer token |
| 403 | Forbidden | User doesn't have permission |
| 404 | Not Found | Check endpoint URL |
| 422 | Unprocessable | Validation failed - check error details |
| 500 | Server Error | Check Laravel logs |
| 503 | Service Unavailable | Check if services are running |

---

## Recovery Steps

If you keep getting 500 errors:

### Step 1: Restart Laravel
```bash
# Kill Laravel process
lsof -i :8000 | grep LISTEN | awk '{print $2}' | xargs kill -9

# Wait 2 seconds
sleep 2

# Restart Laravel
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan serve --port 8000
```

### Step 2: Clear Cache
```bash
cd /Users/user/Desktop/hovertask/laravel-MKpr
php artisan optimize:clear
```

### Step 3: Check Database
```bash
# Verify connection
php artisan db:show

# If error, restart MySQL:
# Open MAMP > Click "Start Servers"
```

### Step 4: Review Logs
```bash
# Check what went wrong
tail -50 /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

### Step 5: Test Simple Request
```bash
# Try basic endpoint
curl http://localhost:8000/api/v1/category
```

---

## Common 500 Error Scenarios

### Scenario 1: Bad Login
```
Error: Invalid credentials (401)
Solution: Use correct email/password
           - Email: test@hovertask.com
           - Password: password123
```

### Scenario 2: Missing Token
```
Error: {"message":"Unauthenticated"} (401)
Solution: Add Authorization header with valid token
```

### Scenario 3: Database Error
```
Error: SQLSTATE error
Solution: 
  1. Check MySQL is running in MAMP
  2. Run: php artisan migrate
  3. Restart Laravel
```

### Scenario 4: Endpoint Not Found
```
Error: 404 Not Found
Solution: Check endpoint URL is correct
          Example: /api/v1/dashboard/dashboard (not /api/dashboard/dashboard)
```

### Scenario 5: Validation Error
```
Error: 422 Unprocessable Entity
Solution: Check required fields in request
          Review error details in response
```

---

## Testing the API

### With Postman (GUI)
1. Download Postman
2. Create new request
3. Set method: POST
4. Set URL: http://localhost:8000/api/login
5. Go to Body tab
6. Select "raw" and "JSON"
7. Paste:
```json
{
  "email": "test@hovertask.com",
  "password": "password123"
}
```
8. Click Send

### With cURL (Command Line)
```bash
curl -s -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@hovertask.com","password":"password123"}' | jq .
```

### With Python
```python
import requests

response = requests.post(
    'http://localhost:8000/api/login',
    json={
        'email': 'test@hovertask.com',
        'password': 'password123'
    }
)

print(response.json())
```

---

## Preventing Future Errors

### 1. Always Include Content-Type Header
```bash
-H "Content-Type: application/json"
```

### 2. Validate JSON Before Sending
```bash
# Test JSON validity
echo '{"email":"test@hovertask.com","password":"password123"}' | jq .
```

### 3. Check Logs First
```bash
tail -50 /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

### 4. Test Endpoints Before Integration
```bash
# Test with curl first, then integrate into frontend
```

### 5. Handle Errors Properly
```typescript
// Always handle errors in React
try {
  const response = await fetch(url);
  if (!response.ok) {
    console.error('Error:', response.status, response.statusText);
  }
  return await response.json();
} catch (error) {
  console.error('Request failed:', error);
}
```

---

## Getting More Help

**See Logs**:
```bash
tail -f /Users/user/Desktop/hovertask/laravel-MKpr/storage/logs/laravel.log
```

**Check Status**:
```bash
ps aux | grep -E "php|npm"
lsof -i -P -n | grep -E "8000|5173|5174"
```

**Verify Setup**:
```bash
php --version              # Should show 8.5.2
which php                  # Should show MAMP path
php artisan db:show        # Should connect to database
```

---

## What Specific Action Causes Your 500 Error?

To help you better, please provide:

1. **What you were trying to do** (e.g., login, create product, complete task)
2. **The exact request you made** (curl command or React code)
3. **The full error message and response**
4. **What the Laravel logs say** (tail -50 storage/logs/laravel.log)

Once you provide this, I can give you the exact fix!

---

**Need Help?** Check the logs first - they usually tell you exactly what went wrong.
