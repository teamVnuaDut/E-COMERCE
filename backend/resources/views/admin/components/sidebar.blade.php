<aside class="sidebar bg-gray-900 text-gray-300 w-64 h-screen fixed top-0 left-0 flex flex-col shadow-lg"
    x-data="{
           activeMenu: '',
           init() {
               const path = window.location.pathname;

               if (path.includes('/dashboard')) this.activeMenu = 'dashboard';
               else if (path.includes('/products')) this.activeMenu = 'products';
               else if (path.includes('/category')) this.activeMenu = 'category';
               else if (path.includes('/brand')) this.activeMenu = 'brand';
               else if (path.includes('/attribute')) this.activeMenu = 'attribute';
               else if (path.includes('/supplier')) this.activeMenu = 'supplier';
               else if (path.includes('/coupon')) this.activeMenu = 'coupon';
               else if (path.includes('/cart')) this.activeMenu = 'cart';
               else if (path.includes('/order')) this.activeMenu = 'order';
               else if (path.includes('/payment')) this.activeMenu = 'payment';
               else if (path.includes('/shipping')) this.activeMenu = 'shipping';
               else if (path.includes('/user')) this.activeMenu = 'users';
               else if (path.includes('/settings')) this.activeMenu = 'settings';
               else this.activeMenu = '';
           }
       }"
    x-init="init()">
    <!-- Header -->
    <div class="sidebar-header px-6 py-4 border-b border-gray-700">
        <h1 class="text-lg font-bold tracking-wide text-white">LIVING HEALTHY LIFE</h1>
    </div>

    <!-- Sidebar Menu -->
    <div class="flex-1 overflow-y-auto px-3 py-4 space-y-1 custom-scrollbar scroll-smooth">
        <nav class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route(Auth::user()->role . '.dashboard') }}"
                :class="{
                   'bg-indigo-600 text-white': activeMenu === 'dashboard',
                   'text-gray-300 hover:text-white hover:bg-gray-800': activeMenu !== 'dashboard'
               }"
                @click="activeMenu = 'dashboard'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out">
                <i class="fas fa-th-large mr-3"
                    :class="{
                       'text-white': activeMenu === 'dashboard',
                       'text-gray-400': activeMenu !== 'dashboard'
                   }"></i>
                <span class="truncate">Dashboard</span>
            </a>

            @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.user.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'users' }"
                @click="activeMenu = 'users'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fas fa-users mr-3"></i>
                <span>Quản lý người dùng</span>
            </a>

            <a href="{{ route('admin.product.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'products' }"
                @click="activeMenu = 'products'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fas fa-box mr-3"></i>
                <span>Sản phẩm</span>
            </a>

            <a href="{{ route('admin.category.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'category' }"
                @click="activeMenu = 'category'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-thumbtack mr-3"></i>
                <span>Danh mục</span>
            </a>

            <a href="{{ route('admin.brand.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'brand' }"
                @click="activeMenu = 'brand'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-copyright mr-3"></i>
                <span>Nhãn hàng cung cấp</span>
            </a>

            <a href="{{ route('admin.attribute.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'attribute' }"
                @click="activeMenu = 'attribute'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-tags mr-3"></i>
                <span>Thuộc tính của sản phẩm</span>
            </a>

            <a href="{{ route('admin.supplier.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'supplier' }"
                @click="activeMenu = 'supplier'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-truck-field-un mr-3"></i>
                <span>Nhà cung cấp</span>
            </a>

            <a href="{{ route('admin.coupon.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'coupon' }"
                @click="activeMenu = 'coupon'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-ticket mr-3"></i>
                <span>Coupons</span>
            </a>

            <a href="{{ route('admin.cart.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'cart' }"
                @click="activeMenu = 'cart'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-cart-shopping mr-3"></i>
                <span>Thông tin giỏ hàng</span>
            </a>

            <a href="{{ route('admin.order.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'order' }"
                @click="activeMenu = 'order'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-clipboard-check mr-3"></i>
                <span>Thông tin đơn hàng</span>
            </a>

            <a href="{{ route('admin.payment.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'payment' }"
                @click="activeMenu = 'payment'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-credit-card mr-3"></i>
                <span>Thông tin phương thức thanh toán</span>
            </a>

            <a href="{{ route('admin.shipping.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'shipping' }"
                @click="activeMenu = 'shipping'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fa-solid fa-truck mr-3"></i>
                <span>Thông tin vận chuyển</span>
            </a>
            @endif

            @if(Auth::user()->role === 'manager')
            <a href="{{ route('manager.products.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'products' }"
                @click="activeMenu = 'products'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fas fa-box mr-3"></i>
                <span>Quản lý sản phẩm</span>
            </a>

            <a href="{{ route('manager.orders.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'orders' }"
                @click="activeMenu = 'orders'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fas fa-shopping-cart mr-3"></i>
                <span>Quản lý đơn hàng</span>
            </a>
            @endif

            @if(Auth::user()->role === 'staff')
            <a href="{{ route('staff.orders.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'orders' }"
                @click="activeMenu = 'orders'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fas fa-tasks mr-3"></i>
                <span>Xử lý đơn hàng</span>
            </a>
            @endif

            @if(Auth::user()->role === 'customer')
            <a href="{{ route('customer.orders.index') }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === 'my-orders' }"
                @click="activeMenu = 'my-orders'"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 ease-in-out hover:bg-gray-800 hover:text-white">
                <i class="fas fa-shopping-bag mr-3"></i>
                <span>Đơn hàng của tôi</span>
            </a>
            @endif
    </div>

    <!-- Footer: User Info + Settings + Logout -->
    <div class="border-t border-gray-700 px-6 py-4 space-y-4">
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.user.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <div class="flex items-center space-x-3">
                <i class="fas fa-user-circle text-3xl text-gray-400"></i>
                <div>
                    <p class="text-sm text-gray-300">Xin chào,</p>
                    <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </a>
        @endif

        <a href="#"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'settings' }"
            @click="activeMenu = 'settings'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-cog mr-3"></i>
            <span>Cài đặt hệ thống</span>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </button>
        </form>
    </div>
</aside>
