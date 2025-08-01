# ⚛️ React Frontend - E-Commerce Store

Frontend cho dự án E-Commerce sử dụng React 18, TypeScript, và Vite.

## 📋 Mục lục

- [Cài đặt](#cài-đặt)
- [Cấu hình](#cấu-hình)
- [Chạy dự án](#chạy-dự-án)
- [Cấu trúc dự án](#cấu-trúc-dự-án)
- [Components](#components)
- [State Management](#state-management)

## 🛠️ Cài đặt

### Yêu cầu hệ thống

- Node.js >= 18.0
- npm >= 8.0

### Bước cài đặt

```bash
# Clone repository
git clone <repository-url>
cd E-COMERCE/frontend/my-react-app

# Cài đặt dependencies
npm install

# Tạo file environment
echo "VITE_API_URL=http://localhost:8000/api" > .env
echo "VITE_APP_NAME=E-Commerce Store" >> .env

# Chạy development server
npm run dev
```

## ⚙️ Cấu hình

### Environment Variables

Tạo file `.env` trong thư mục gốc:

```env
VITE_API_URL=http://localhost:8000/api
VITE_APP_NAME=E-Commerce Store
```

### Vite Configuration

File: `vite.config.ts`

```typescript
import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  plugins: [react()],
  server: {
    port: 3000,
    host: true,
  },
  build: {
    outDir: 'dist',
    sourcemap: true,
  },
})
```

## 🏃‍♂️ Chạy dự án

### Development Mode

```bash
npm run dev
```

Frontend sẽ chạy tại: `http://localhost:3000`

### Production Build

```bash
npm run build
npm run preview
```

### Testing

```bash
npm test
npm run test:coverage
```

## 📁 Cấu trúc dự án

```
src/
├── components/           # React Components
│   ├── Cart.tsx         # Shopping Cart Component
│   ├── Product.tsx      # Product Card Component
│   └── Login.jsx        # Login Form Component
├── contexts/            # React Contexts
│   └── AuthContext.tsx  # Authentication Context
├── hooks/               # Custom Hooks
│   └── useAuth.ts       # Authentication Hook
├── services/            # API Services
│   └── api.ts           # Axios API Client
├── store/               # State Management
│   └── cartStore.ts     # Zustand Cart Store
├── types/               # TypeScript Types
├── utils/               # Utility Functions
├── App.tsx              # Main App Component
└── main.tsx             # Entry Point
```

## 🧩 Components

### Cart Component

```typescript
import { useCartStore } from '../store/cartStore';

export const Cart: React.FC = () => {
  const { items, removeItem, updateQuantity, getTotal } = useCartStore();
  
  return (
    <div className="p-4">
      <h2>Giỏ hàng ({items.length} sản phẩm)</h2>
      {/* Cart items */}
    </div>
  );
};
```

### Product Component

```typescript
interface ProductProps {
  id: number;
  name: string;
  price: number;
  image?: string;
  description?: string;
}

export const Product: React.FC<ProductProps> = ({ id, name, price, image }) => {
  const { addItem } = useCartStore();
  
  const handleAddToCart = () => {
    addItem({ id, name, price, image });
  };
  
  return (
    <div className="border rounded-lg p-4">
      {/* Product content */}
    </div>
  );
};
```

### Login Component

```typescript
import { useAuth } from '../hooks/useAuth';

export const Login: React.FC = () => {
  const { login } = useAuth();
  const [formData, setFormData] = useState({
    email: '',
    password: ''
  });
  
  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault();
    const result = await login(formData);
    if (result.success) {
      // Redirect to dashboard
    }
  };
  
  return (
    <form onSubmit={handleSubmit}>
      {/* Login form */}
    </form>
  );
};
```

## 🗃️ State Management

### Zustand Cart Store

```typescript
import { create } from 'zustand';
import { persist } from 'zustand/middleware';

interface CartItem {
  id: number;
  name: string;
  price: number;
  quantity: number;
  image?: string;
}

interface CartStore {
  items: CartItem[];
  addItem: (item: Omit<CartItem, 'quantity'>) => void;
  removeItem: (id: number) => void;
  updateQuantity: (id: number, quantity: number) => void;
  getTotal: () => number;
}

export const useCartStore = create<CartStore>()(
  persist(
    (set, get) => ({
      items: [],
      addItem: (item) => {
        // Add item logic
      },
      removeItem: (id) => {
        // Remove item logic
      },
      updateQuantity: (id, quantity) => {
        // Update quantity logic
      },
      getTotal: () => {
        // Calculate total
      },
    }),
    {
      name: 'cart-storage',
    }
  )
);
```

### Authentication Context

```typescript
interface AuthContextType {
  user: User | null;
  token: string | null;
  loading: boolean;
  isAuthenticated: boolean;
  login: (credentials: Record<string, unknown>) => Promise<any>;
  logout: () => Promise<void>;
}

export const AuthProvider = ({ children }: { children: ReactNode }) => {
  const [user, setUser] = useState<User | null>(null);
  const [token, setToken] = useState<string | null>(null);
  
  const login = async (credentials: Record<string, unknown>) => {
    // Login logic
  };
  
  const logout = async () => {
    // Logout logic
  };
  
  return (
    <AuthContext.Provider value={{ user, token, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};
```

## 🔌 API Integration

### Axios Configuration

```typescript
import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

// Request interceptor
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('auth_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Response interceptor
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem('auth_token');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);
```

### API Services

```typescript
export const authAPI = {
  register: (userData: any) => api.post('/register', userData),
  login: (credentials: any) => api.post('/login', credentials),
  logout: () => api.post('/logout'),
  getUser: () => api.get('/user'),
};

export const productsAPI = {
  getProducts: (params = {}) => api.get('/products', { params }),
  getProduct: (id: number) => api.get(`/products/${id}`),
  createProduct: (productData: any) => api.post('/products', productData),
  updateProduct: (id: number, productData: any) => api.put(`/products/${id}`, productData),
  deleteProduct: (id: number) => api.delete(`/products/${id}`),
};
```

## 🎨 Styling

### Tailwind CSS

Dự án sử dụng Tailwind CSS cho styling:

```bash
# Cài đặt Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

### Configuration

File: `tailwind.config.js`

```javascript
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

## 🧪 Testing

### Jest & React Testing Library

```bash
# Cài đặt testing dependencies
npm install -D @testing-library/react @testing-library/jest-dom vitest

# Chạy tests
npm test

# Chạy tests với coverage
npm run test:coverage
```

### Test Example

```typescript
import { render, screen } from '@testing-library/react';
import { Product } from './Product';

describe('Product Component', () => {
  it('renders product information', () => {
    const product = {
      id: 1,
      name: 'Test Product',
      price: 100,
      description: 'Test description'
    };
    
    render(<Product {...product} />);
    
    expect(screen.getByText('Test Product')).toBeInTheDocument();
    expect(screen.getByText('100 VNĐ')).toBeInTheDocument();
  });
});
```

## 📦 Build & Deployment

### Production Build

```bash
# Build for production
npm run build

# Preview production build
npm run preview
```

### Deployment Options

#### Vercel
1. Connect GitHub repository
2. Set build command: `npm run build`
3. Set output directory: `dist`
4. Deploy

#### Netlify
1. Connect GitHub repository
2. Set build command: `npm run build`
3. Set publish directory: `dist`
4. Deploy

## 🔧 Troubleshooting

### Common Issues

1. **API Connection Error**
   - Kiểm tra `VITE_API_URL` trong `.env`
   - Đảm bảo backend server đang chạy
   - Kiểm tra CORS configuration

2. **Authentication Issues**
   - Clear localStorage: `localStorage.clear()`
   - Kiểm tra token format
   - Verify API endpoints

3. **Build Errors**
   - Clear node_modules: `rm -rf node_modules && npm install`
   - Kiểm tra TypeScript errors
   - Update dependencies

## 📞 Support

Nếu gặp vấn đề:
1. Kiểm tra console errors
2. Tạo issue trên GitHub
3. Liên hệ qua email: your-email@example.com

## 📝 License

Dự án này được phân phối dưới giấy phép MIT.
