import axios from 'axios';

// Tạo instance axios với cấu hình mặc định
const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

// Interceptor để thêm token vào header
api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('auth_token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Interceptor để xử lý response
api.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response?.status === 401) {
            // Token hết hạn hoặc không hợp lệ
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);

// Auth API
export const authAPI = {
    // Đăng ký
    register: (userData) => api.post('/register', userData),
    
    // Đăng nhập
    login: (credentials) => api.post('/login', credentials),
    
    // Đăng xuất
    logout: () => api.post('/logout'),
    
    // Lấy thông tin user
    getUser: () => api.get('/user'),
    
    // Làm mới token
    refresh: () => api.post('/refresh'),
    
    // Đổi mật khẩu
    changePassword: (passwordData) => api.post('/change-password', passwordData),
};

// Dashboard API
export const dashboardAPI = {
    // Lấy thống kê
    getStats: () => api.get('/dashboard/stats'),
};

// Products API
export const productsAPI = {
    // Lấy danh sách sản phẩm
    getProducts: (params = {}) => api.get('/products', { params }),
    
    // Lấy chi tiết sản phẩm
    getProduct: (id) => api.get(`/products/${id}`),
    
    // Tạo sản phẩm mới
    createProduct: (productData) => api.post('/products', productData),
    
    // Cập nhật sản phẩm
    updateProduct: (id, productData) => api.put(`/products/${id}`, productData),
    
    // Xóa sản phẩm
    deleteProduct: (id) => api.delete(`/products/${id}`),
};

// Orders API
export const ordersAPI = {
    // Lấy danh sách đơn hàng
    getOrders: (params = {}) => api.get('/orders', { params }),
    
    // Lấy chi tiết đơn hàng
    getOrder: (id) => api.get(`/orders/${id}`),
    
    // Cập nhật trạng thái đơn hàng
    updateOrderStatus: (id, status) => api.patch(`/orders/${id}/status`, { status }),
};

// Cart API
export const cartAPI = {
    // Lấy giỏ hàng
    getCart: () => api.get('/cart'),
    
    // Thêm sản phẩm vào giỏ hàng
    addToCart: (productId, quantity = 1) => api.post('/cart/items', { product_id: productId, quantity }),
    
    // Cập nhật số lượng
    updateCartItem: (itemId, quantity) => api.put(`/cart/items/${itemId}`, { quantity }),
    
    // Xóa sản phẩm khỏi giỏ hàng
    removeFromCart: (itemId) => api.delete(`/cart/items/${itemId}`),
    
    // Xóa toàn bộ giỏ hàng
    clearCart: () => api.delete('/cart'),
};

// Upload API
export const uploadAPI = {
    // Upload hình ảnh
    uploadImage: (file) => {
        const formData = new FormData();
        formData.append('image', file);
        return api.post('/upload/image', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
    },
};

export default api; 