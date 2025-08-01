# 🛒 E-Commerce Project

Dự án E-Commerce với Laravel Backend và React Frontend, sử dụng Laravel Sanctum cho xác thực API.

## 📋 Mục lục

- [Cài đặt](#cài-đặt)
- [Cấu hình](#cấu-hình)
- [Chạy dự án](#chạy-dự-án)
- [API Endpoints](#api-endpoints)
- [Cấu trúc dự án](#cấu-trúc-dự-án)
- [Tính năng](#tính-năng)
- [Đóng góp](#đóng-góp)

## 🚀 Cài đặt

### Yêu cầu hệ thống

- **PHP** >= 8.1
- **Composer** >= 2.0
- **Node.js** >= 18.0
- **npm** >= 8.0
- **MySQL** >= 8.0 hoặc **PostgreSQL** >= 13.0

### Backend (Laravel)

```bash
# Clone repository
git clone <repository-url>
cd E-COMERCE

# Cài đặt dependencies
cd backend
composer install

# Copy file environment
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

# Chạy seeders (nếu có)
php artisan db:seed

# Cài đặt Laravel Sanctum
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

### Frontend (React)

```bash
# Di chuyển vào thư mục frontend
cd ../frontend/my-react-app

# Cài đặt dependencies
npm install

# Tạo file .env
echo "VITE_API_URL=http://localhost:8000/api" > .env
echo "VITE_APP_NAME=E-Commerce Store" >> .env
```

## ⚙️ Cấu hình

### Backend Configuration

1. **Database**: Cấu hình trong `backend/.env`
2. **CORS**: Đã cấu hình trong `backend/config/cors.php`
3. **Sanctum**: Cấu hình trong `backend/config/sanctum.php`

### Frontend Configuration

1. **API URL**: Cấu hình trong `frontend/my-react-app/.env`
2. **Environment Variables**:
   ```env
   VITE_API_URL=http://localhost:8000/api
   VITE_APP_NAME=E-Commerce Store
   ```

## 🏃‍♂️ Chạy dự án

### Development Mode

```bash
# Terminal 1 - Backend
cd backend
php artisan serve

# Terminal 2 - Frontend
cd frontend/my-react-app
npm run dev
```

### Production Mode

```bash
# Build frontend
cd frontend/my-react-app
npm run build

# Backend production
cd backend
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔌 API Endpoints

### Authentication

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Đăng ký người dùng mới |
| POST | `/api/login` | Đăng nhập |
| POST | `/api/logout` | Đăng xuất |
| GET | `/api/user` | Lấy thông tin user |
| POST | `/api/refresh` | Làm mới token |
| POST | `/api/change-password` | Đổi mật khẩu |

### Dashboard

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/dashboard/stats` | Lấy thống kê dashboard |

### Products (Planned)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/products` | Lấy danh sách sản phẩm |
| GET | `/api/products/{id}` | Lấy chi tiết sản phẩm |
| POST | `/api/products` | Tạo sản phẩm mới |
| PUT | `/api/products/{id}` | Cập nhật sản phẩm |
| DELETE | `/api/products/{id}` | Xóa sản phẩm |

### Orders (Planned)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/orders` | Lấy danh sách đơn hàng |
| GET | `/api/orders/{id}` | Lấy chi tiết đơn hàng |
| POST | `/api/orders` | Tạo đơn hàng mới |
| PATCH | `/api/orders/{id}/status` | Cập nhật trạng thái |

## 📁 Cấu trúc dự án

```
E-COMERCE/
├── backend/                          # Laravel Backend
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   └── Api/
│   │   │   │       └── AuthController.php
│   │   │   └── Middleware/
│   │   │       └── ApiAuthentication.php
│   │   └── Models/
│   │       └── User.php
│   ├── config/
│   │   ├── cors.php
│   │   └── sanctum.php
│   ├── database/
│   │   └── migrations/
│   ├── resources/
│   │   └── views/
│   │       └── dashboard/
│   └── routes/
│       └── api.php
├── frontend/
│   └── my-react-app/                 # React Frontend
│       ├── src/
│       │   ├── components/
│       │   │   ├── Cart.tsx
│       │   │   ├── Product.tsx
│       │   │   └── Login.jsx
│       │   ├── contexts/
│       │   │   └── AuthContext.tsx
│       │   ├── hooks/
│       │   │   └── useAuth.ts
│       │   ├── services/
│       │   │   └── api.ts
│       │   └── store/
│       │       └── cartStore.ts
│       └── package.json
└── README.md
```

## ✨ Tính năng

### ✅ Đã hoàn thành

- **Authentication System**
  - Đăng ký/Đăng nhập với Laravel Sanctum
  - Token-based authentication
  - Auto logout khi token hết hạn
  - Persistent login với localStorage

- **Frontend Components**
  - Responsive design với Tailwind CSS
  - Shopping cart với Zustand
  - Product listing
  - Login form

- **Backend API**
  - RESTful API endpoints
  - CORS configuration
  - Input validation
  - Error handling

- **Dashboard Views**
  - Admin dashboard layout
  - Products management
  - Orders management
  - Statistics display

### 🚧 Đang phát triển

- [ ] Product CRUD operations
- [ ] Order management system
- [ ] Payment integration
- [ ] User profile management
- [ ] Admin panel
- [ ] Email notifications
- [ ] Image upload functionality

### 📋 Kế hoạch

- [ ] Multi-language support
- [ ] Advanced search & filtering
- [ ] Wishlist functionality
- [ ] Review & rating system
- [ ] Inventory management
- [ ] Analytics dashboard
- [ ] Mobile app

## 🛠️ Công nghệ sử dụng

### Backend
- **Laravel 10** - PHP Framework
- **Laravel Sanctum** - API Authentication
- **MySQL/PostgreSQL** - Database
- **Tailwind CSS** - Styling (Dashboard)

### Frontend
- **React 18** - JavaScript Framework
- **TypeScript** - Type Safety
- **Vite** - Build Tool
- **Tailwind CSS** - Styling
- **Zustand** - State Management
- **Axios** - HTTP Client
- **Lucide React** - Icons

## 🧪 Testing

```bash
# Backend tests
cd backend
php artisan test

# Frontend tests
cd frontend/my-react-app
npm test
```

## 📦 Deployment

### Backend Deployment

1. **Server Requirements**:
   - PHP >= 8.1
   - Composer
   - MySQL/PostgreSQL
   - Nginx/Apache

2. **Deployment Steps**:
   ```bash
   git clone <repository>
   cd backend
   composer install --optimize-autoloader --no-dev
   cp .env.example .env
   php artisan key:generate
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan migrate --force
   ```

### Frontend Deployment

1. **Build for Production**:
   ```bash
   cd frontend/my-react-app
   npm run build
   ```

2. **Deploy to Vercel/Netlify**:
   - Connect repository
   - Set build command: `npm run build`
   - Set output directory: `dist`

## 🤝 Đóng góp

1. Fork dự án
2. Tạo feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## 📝 License

Dự án này được phân phối dưới giấy phép MIT. Xem file `LICENSE` để biết thêm chi tiết.

## 📞 Liên hệ

- **Email**: your-email@example.com
- **GitHub**: [@your-username](https://github.com/your-username)

## 🙏 Cảm ơn

Cảm ơn bạn đã sử dụng dự án E-Commerce này! Nếu bạn thấy dự án hữu ích, hãy cho một ⭐️ trên GitHub. 