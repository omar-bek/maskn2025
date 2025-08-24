# Insha'at API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication Endpoints

### 1. Login
**POST** `/api/login`

**Request Body:**
```json
{
    "email": "client@example.com",
    "password": "password",
    "device_name": "iPhone 15"
}
```

**Response:**
```json
{
    "success": true,
    "message": "تم تسجيل الدخول بنجاح",
    "data": {
        "user": {
            "id": 2,
            "name": "Client User",
            "email": "client@example.com",
            "user_type": "client",
            "user_type_display": "عميل",
            "phone": "+971501234567",
            "is_verified": true
        },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

### 2. Register
**POST** `/api/register`

**Request Body:**
```json
{
    "name": "New User",
    "email": "newuser@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "user_type_id": 1,
    "phone": "+971501234567",
    "device_name": "Android Device"
}
```

**Response:**
```json
{
    "success": true,
    "message": "تم إنشاء الحساب بنجاح",
    "data": {
        "user": {
            "id": 15,
            "name": "New User",
            "email": "newuser@example.com",
            "user_type": "client",
            "user_type_display": "عميل",
            "phone": "+971501234567",
            "is_verified": false
        },
        "token": "2|def456...",
        "token_type": "Bearer"
    }
}
```

### 3. Get User Profile
**GET** `/api/user`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "user": {
            "id": 2,
            "name": "Client User",
            "email": "client@example.com",
            "user_type": "client",
            "user_type_display": "عميل",
            "phone": "+971501234567",
            "whatsapp": "+971501234567",
            "address": "Dubai, UAE",
            "city": "Dubai",
            "country": "UAE",
            "is_verified": true,
            "is_active": true,
            "profile": null
        }
    }
}
```

### 4. Logout
**POST** `/api/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "تم تسجيل الخروج بنجاح"
}
```

### 5. Logout All Devices
**POST** `/api/logout-all`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "تم تسجيل الخروج من جميع الأجهزة بنجاح"
}
```

### 6. Get User Types
**GET** `/api/user-types`

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "client",
            "display_name_ar": "عميل",
            "display_name_en": "Client",
            "description_ar": "عميل يبحث عن تصميم وبناء منزل",
            "description_en": "Client looking for house design and construction"
        },
        {
            "id": 2,
            "name": "consultant",
            "display_name_ar": "استشاري",
            "display_name_en": "Consultant",
            "description_ar": "مهندس استشاري للتصميم",
            "description_en": "Design consultant engineer"
        },
        {
            "id": 3,
            "name": "contractor",
            "display_name_ar": "مقاول",
            "display_name_en": "Contractor",
            "description_ar": "مقاول للبناء والتشييد",
            "description_en": "Construction contractor"
        },
        {
            "id": 4,
            "name": "supplier",
            "display_name_ar": "مورد",
            "display_name_en": "Supplier",
            "description_ar": "مورد للمواد والخدمات",
            "description_en": "Materials and services supplier"
        }
    ]
}
```

## Protected Endpoints

### Projects
**GET** `/api/projects`

### Offers
**GET** `/api/offers`

### Cost Calculator
**POST** `/api/calculate-cost`

## Testing with cURL

### Login Example:
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "client@example.com",
    "password": "password",
    "device_name": "Test Device"
  }'
```

### Get User Profile Example:
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## Available Test Users

| Email | Password | User Type |
|-------|----------|-----------|
| admin@inshaat.com | password | Admin |
| client@example.com | password | Client |
| consultant@example.com | password | Consultant |
| contractor@example.com | password | Contractor |
| supplier@example.com | password | Supplier |

## Error Responses

### Validation Error:
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The provided credentials are incorrect."]
    }
}
```

### Unauthorized:
```json
{
    "message": "Unauthenticated."
}
```
