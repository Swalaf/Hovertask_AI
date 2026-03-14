# 🔐 Hovertask API - Authentication Endpoints Documentation

## Base URL
```
http://localhost:8000/api
```

---

## 📝 Public Endpoints (No Authentication Required)

### 1. Register New User
**Endpoint:** `POST /auth/register`

**Description:** Create a new user account

**Request Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
  "fname": "John",
  "lname": "Doe",
  "username": "johndoe",
  "email": "john@test.com",
  "phone": "+234-800-000-0000",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response (201 Created):**
```json
{
  "status": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "fname": "John",
      "lname": "Doe",
      "email": "john@test.com",
      "username": "johndoe",
      "phone": "+234-800-000-0000"
    },
    "token": "1|abc123...def456"
  }
}
```

**Error Response (422 Unprocessable Entity):**
```json
{
  "status": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email has already been taken."]
  }
}
```

**Test Command:**
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "fname": "John",
    "lname": "Doe",
    "username": "johndoe",
    "email": "john@test.com",
    "phone": "+234-800-000-0000",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

---

### 2. Login User
**Endpoint:** `POST /auth/login`

**Description:** Authenticate user and get access token

**Request Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
  "email": "test@hovertask.com",
  "password": "password123"
}
```

**Response (200 OK):**
```json
{
  "status": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "fname": "Test",
      "lname": "User",
      "email": "test@hovertask.com",
      "username": "testuser",
      "phone": "+234-800-000-0000",
      "country": "Nigeria",
      "currency": "NGN"
    },
    "token": "1|abc123...def456"
  }
}
```

**Error Response (401 Unauthorized):**
```json
{
  "status": false,
  "message": "Invalid credentials"
}
```

**Test Command:**
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@hovertask.com",
    "password": "password123"
  }'
```

---

## 🔒 Protected Endpoints (Authentication Required)

> **Required Header:** `Authorization: Bearer YOUR_TOKEN`
> 
> Replace `YOUR_TOKEN` with the token received from login or register

---

### 3. Get Current User
**Endpoint:** `GET /auth/user`

**Description:** Get currently authenticated user's profile

**Request Headers:**
```
Content-Type: application/json
Authorization: Bearer YOUR_TOKEN
```

**Response (200 OK):**
```json
{
  "status": true,
  "user": {
    "id": 1,
    "fname": "Test",
    "lname": "User",
    "email": "test@hovertask.com",
    "username": "testuser",
    "phone": "+234-800-000-0000",
    "country": "Nigeria",
    "currency": "NGN",
    "avatar": "https://via.placeholder.com/150",
    "is_member": true,
    "created_at": "2024-01-15T10:30:00.000000Z"
  }
}
```

**Test Command:**
```bash
curl -X GET http://localhost:8000/api/auth/user \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

---

### 4. Update User Profile
**Endpoint:** `PUT /auth/update-profile`

**Description:** Update user profile information

**Request Headers:**
```
Content-Type: application/json
Authorization: Bearer YOUR_TOKEN
```

**Request Body:**
```json
{
  "fname": "Jonathan",
  "lname": "Smith",
  "phone": "+234-800-000-1111",
  "country": "Ghana",
  "currency": "GHS",
  "avatar": "https://example.com/avatar.jpg"
}
```

**Response (200 OK):**
```json
{
  "status": true,
  "message": "Profile updated successfully",
  "user": {
    "id": 1,
    "fname": "Jonathan",
    "lname": "Smith",
    "email": "test@hovertask.com",
    "phone": "+234-800-000-1111",
    "country": "Ghana",
    "currency": "GHS"
  }
}
```

**Test Command:**
```bash
curl -X PUT http://localhost:8000/api/auth/update-profile \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "fname": "Jonathan",
    "lname": "Smith",
    "phone": "+234-800-000-1111"
  }'
```

---

### 5. Change Password
**Endpoint:** `POST /auth/change-password`

**Description:** Change user password with current password verification

**Request Headers:**
```
Content-Type: application/json
Authorization: Bearer YOUR_TOKEN
```

**Request Body:**
```json
{
  "current_password": "password123",
  "password": "newpassword456",
  "password_confirmation": "newpassword456"
}
```

**Response (200 OK):**
```json
{
  "status": true,
  "message": "Password changed successfully"
}
```

**Error Response (401 Unauthorized):**
```json
{
  "status": false,
  "message": "Current password is incorrect"
}
```

**Test Command:**
```bash
curl -X POST http://localhost:8000/api/auth/change-password \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "current_password": "password123",
    "password": "newpassword456",
    "password_confirmation": "newpassword456"
  }'
```

---

### 6. Logout
**Endpoint:** `POST /auth/logout`

**Description:** Logout user and invalidate current token

**Request Headers:**
```
Content-Type: application/json
Authorization: Bearer YOUR_TOKEN
```

**Response (200 OK):**
```json
{
  "status": true,
  "message": "Logout successful"
}
```

**Test Command:**
```bash
curl -X POST http://localhost:8000/api/auth/logout \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

---

### 7. Get Dashboard Data
**Endpoint:** `GET /dashboard`

**Description:** Get user's dashboard with statistics and balance

**Request Headers:**
```
Content-Type: application/json
Authorization: Bearer YOUR_TOKEN
```

**Response (200 OK):**
```json
{
  "status": true,
  "data": {
    "user": {
      "id": 1,
      "fname": "Test",
      "lname": "User",
      "email": "test@hovertask.com"
    },
    "balance": 0,
    "tasks_completed": 0,
    "earnings": 0,
    "statistics": {
      "total_tasks": 0,
      "total_adverts": 0,
      "total_sales": 0
    }
  }
}
```

**Test Command:**
```bash
curl -X GET http://localhost:8000/api/dashboard \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

---

### 8. Get Dashboard User Info
**Endpoint:** `GET /dashboard/user`

**Description:** Get current user's information for dashboard display

**Request Headers:**
```
Content-Type: application/json
Authorization: Bearer YOUR_TOKEN
```

**Response (200 OK):**
```json
{
  "status": true,
  "user": {
    "id": 1,
    "fname": "Test",
    "lname": "User",
    "email": "test@hovertask.com",
    "username": "testuser",
    "avatar": "https://via.placeholder.com/150"
  }
}
```

**Test Command:**
```bash
curl -X GET http://localhost:8000/api/dashboard/user \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

---

## 🧪 Complete Testing Workflow

### 1. Register a New User
```bash
REGISTER_RESPONSE=$(curl -s -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "fname": "Test",
    "lname": "User",
    "username": "testuser123",
    "email": "testuser123@hovertask.com",
    "phone": "+234-800-000-0000",
    "password": "password123",
    "password_confirmation": "password123"
  }')

TOKEN=$(echo $REGISTER_RESPONSE | jq -r '.data.token')
echo "New user token: $TOKEN"
```

### 2. Login with Test User
```bash
LOGIN_RESPONSE=$(curl -s -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@hovertask.com",
    "password": "password123"
  }')

TOKEN=$(echo $LOGIN_RESPONSE | jq -r '.data.token')
echo "Login token: $TOKEN"
```

### 3. Get User Profile
```bash
curl -s -X GET http://localhost:8000/api/auth/user \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" | jq .
```

### 4. Update Profile
```bash
curl -s -X PUT http://localhost:8000/api/auth/update-profile \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "fname": "UpdatedName",
    "phone": "+234-800-000-1111"
  }' | jq .
```

### 5. Get Dashboard
```bash
curl -s -X GET http://localhost:8000/api/dashboard \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" | jq .
```

### 6. Change Password
```bash
curl -s -X POST http://localhost:8000/api/auth/change-password \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "current_password": "password123",
    "password": "newpassword456",
    "password_confirmation": "newpassword456"
  }' | jq .
```

### 7. Logout
```bash
curl -s -X POST http://localhost:8000/api/auth/logout \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" | jq .
```

---

## ✅ Test Users Available

After running the seeder, these credentials are available:

| Email | Password | Role |
|-------|----------|------|
| test@hovertask.com | password123 | Regular User |
| admin@hovertask.com | admin123 | Admin |
| seller@hovertask.com | seller123 | Seller |

---

## 🔄 Authentication Flow

```
1. User provides email/password
   ↓
2. API validates credentials
   ↓
3. API generates Sanctum token
   ↓
4. Token returned to frontend
   ↓
5. Frontend stores token (localStorage/sessionStorage)
   ↓
6. Frontend includes token in Authorization header
   ↓
7. API middleware validates token
   ↓
8. API returns protected resources
```

---

## 📊 Error Codes

| Code | Status | Meaning |
|------|--------|---------|
| 200 | OK | Successful request |
| 201 | Created | Resource created successfully |
| 400 | Bad Request | Invalid request format |
| 401 | Unauthorized | Authentication failed or token invalid |
| 403 | Forbidden | Authenticated but permission denied |
| 404 | Not Found | Resource not found |
| 422 | Unprocessable Entity | Validation failed |
| 500 | Internal Server Error | Server error |

---

## 🔒 Security Features

- ✅ Password hashing (bcrypt)
- ✅ Token-based authentication (Sanctum)
- ✅ CSRF protection
- ✅ Rate limiting ready
- ✅ Input validation
- ✅ SQL injection protection

---

## 📱 Frontend Integration Example (JavaScript)

### Register
```javascript
const response = await fetch('http://localhost:8000/api/auth/register', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    fname: 'John',
    lname: 'Doe',
    username: 'johndoe',
    email: 'john@test.com',
    phone: '+234-800-000-0000',
    password: 'password123',
    password_confirmation: 'password123'
  })
});

const data = await response.json();
const token = data.data.token;
localStorage.setItem('token', token);
```

### Login
```javascript
const response = await fetch('http://localhost:8000/api/auth/login', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    email: 'test@hovertask.com',
    password: 'password123'
  })
});

const data = await response.json();
const token = data.data.token;
localStorage.setItem('token', token);
```

### Protected Request
```javascript
const token = localStorage.getItem('token');

const response = await fetch('http://localhost:8000/api/auth/user', {
  method: 'GET',
  headers: {
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${token}`
  }
});

const user = await response.json();
console.log(user);
```

---

**Last Updated:** Today
**Version:** 1.0.0
**Status:** ✅ Ready for Testing
