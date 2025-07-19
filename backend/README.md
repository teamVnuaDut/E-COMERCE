# 🚀 Laravel Backend - E-Commerce API

Backend API cho dự án E-Commerce sử dụng Laravel 10 và Laravel Sanctum.

## 📋 Mục lục

- [Cài đặt](#cài-đặt)
- [Cấu hình](#cấu-hình)
- [API Documentation](#api-documentation)
- [Database](#database)
- [Authentication](#authentication)

## 🛠️ Cài đặt

### Yêu cầu hệ thống

- PHP >= 8.1
- Composer >= 2.0
- MySQL >= 8.0 hoặc PostgreSQL >= 13.0

### Bước cài đặt

```bash
# Clone repository
git clone <repository-url>
cd E-COMERCE/backend

# Cài đặt dependencies
composer install

# Copy environment file
cp .env.example .env

# Tạo application key
php artisan key:generate

# Cấu hình database trong .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=

# Chạy migrations
php artisan migrate

# Cài đặt Laravel Sanctum
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

## ⚙️ Cấu hình

### Environment Variables

```env
APP_NAME="E-Commerce API"
APP_ENV=local
APP_KEY=base64:your-key-here
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost:3000,127.0.0.1:3000
```

### CORS Configuration

File: `config/cors.php`

```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_origins' => ['*'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
'supports_credentials' => false,
```

## 🔌 API Documentation

### Authentication Endpoints

#### Đăng ký
```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "created_at": "2024-01-01T00:00:00.000000Z"
        },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

#### Đăng nhập
```http
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

#### Đăng xuất
```http
POST /api/logout
Authorization: Bearer {token}
```

#### Lấy thông tin user
```http
GET /api/user
Authorization: Bearer {token}
```

#### Làm mới token
```http
POST /api/refresh
Authorization: Bearer {token}
```

#### Đổi mật khẩu
```http
POST /api/change-password
Authorization: Bearer {token}
Content-Type: application/json

{
    "current_password": "oldpassword",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
}
```

### Dashboard Endpoints

#### Thống kê
```http
GET /api/dashboard/stats
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "total_products": 0,
        "total_orders": 0,
        "total_customers": 0,
        "total_revenue": 0
    }
}
```

## 🗄️ Database

### Migrations

```bash
# Tạo migration mới
php artisan make:migration create_products_table

# Chạy migrations
php artisan migrate

# Rollback migration
php artisan migrate:rollback

# Refresh migrations
php artisan migrate:refresh
```

### Models

#### User Model
```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
```

## 🔐 Authentication

### Laravel Sanctum

Sanctum được sử dụng cho API authentication với token-based approach.

#### Cấu hình
File: `config/sanctum.php`

```php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
    Sanctum::currentApplicationUrlWithPort(),
))),
```

#### Middleware
```php
// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
```

## 🧪 Testing

```bash
# Chạy tất cả tests
php artisan test

# Chạy test cụ thể
php artisan test --filter=AuthControllerTest

# Chạy tests với coverage
php artisan test --coverage
```

## 🚀 Deployment

### Production Setup

```bash
# Optimize for production
composer install --optimize-autoloader --no-dev

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force
```

### Server Requirements

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Nginx/Apache
- SSL Certificate (recommended)

## 📁 Cấu trúc thư mục

```
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       └── AuthController.php
│   │   └── Middleware/
│   │       └── ApiAuthentication.php
│   └── Models/
│       └── User.php
├── config/
│   ├── cors.php
│   └── sanctum.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       └── dashboard/
├── routes/
│   └── api.php
└── README.md
```

## 🔧 Troubleshooting

### Common Issues

1. **CORS Error**
   - Kiểm tra cấu hình CORS trong `config/cors.php`
   - Đảm bảo frontend domain được thêm vào `SANCTUM_STATEFUL_DOMAINS`

2. **Token Authentication Failed**
   - Kiểm tra token format: `Bearer {token}`
   - Verify token hasn't expired
   - Check if user exists in database

3. **Database Connection**
   - Verify database credentials in `.env`
   - Check if database exists
   - Run `php artisan migrate:status`

## 📞 Support

Nếu gặp vấn đề, vui lòng:
1. Kiểm tra logs trong `storage/logs/laravel.log`
2. Tạo issue trên GitHub
3. Liên hệ qua email: your-email@example.com
