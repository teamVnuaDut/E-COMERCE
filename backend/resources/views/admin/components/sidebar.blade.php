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
            <div x-data="{ open: false }" x-effect="open = (activeMenu === 'users')">
                <button
                    @click="activeMenu = 'users'; open = !open"
                    :class="activeMenu === 'users' ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-800'"
                    class="flex items-center w-full px-4 py-3 rounded-lg transition-all duration-200 ease-in-out">
                    <i class="fas fa-users mr-3"></i>
                    <span>Quản lý người dùng</span>
                    <i class="fas fa-chevron-down ml-auto transform transition-transform"
                        :class="open ? 'rotate-180' : 'rotate-0'"></i>
                </button>

                <div x-show="open" x-transition class="mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}"
                        :class="request()->routeIs('admin.users.index') ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:bg-gray-100'"
                        class="flex items-center px-6 py-2 text-sm rounded transition">
                        📋 Danh sách người dùng
                    </a>
                    <a href="{{ route('admin.user.index') }}"
                        :class="request()->routeIs('admin.user.index') ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:bg-gray-100'"
                        class="flex items-center px-6 py-2 text-sm rounded transition">
                        🙋‍♂️ Người dùng hiện tại
                    </a>
                </div>
            </div>

            @php
            $adminMenus = [
            ['key' => 'products', 'icon' => 'fas fa-box', 'label' => 'Sản phẩm', 'route' => 'admin.product.index'],
            ['key' => 'category', 'icon' => 'fa-solid fa-thumbtack', 'label' => 'Danh mục', 'route' => 'admin.category.index'],
            ['key' => 'brand', 'icon' => 'fa-solid fa-copyright', 'label' => 'Nhãn hàng cung cấp', 'route' => 'admin.brand.index'],
            ['key' => 'attribute', 'icon' => 'fa-solid fa-tags', 'label' => 'Thuộc tính của sản phẩm', 'route' => 'admin.attribute.index'],
            ['key' => 'supplier', 'icon' => 'fa-solid fa-truck-field-un', 'label' => 'Nhà cung cấp', 'route' => 'admin.supplier.index'],
            ['key' => 'coupon', 'icon' => 'fa-solid fa-ticket', 'label' => 'Coupons', 'route' => 'admin.coupon.index'],
            ['key' => 'cart', 'icon' => 'fa-solid fa-cart-shopping', 'label' => 'Thông tin giỏ hàng', 'route' => 'admin.cart.index'],
            ['key' => 'order', 'icon' => 'fa-solid fa-clipboard-check', 'label' => 'Thông tin đơn hàng', 'route' => 'admin.order.index'],
            ['key' => 'payment', 'icon' => 'fa-solid fa-credit-card', 'label' => 'Thông tin phương thức thanh toán', 'route' => 'admin.payment.index'],
            ['key' => 'shipping', 'icon' => 'fa-solid fa-truck', 'label' => 'Thông tin vận chuyển', 'route' => 'admin.shipping.index'],
            ];
            @endphp

            @foreach ($adminMenus as $item)
            <a href="{{ route($item['route']) }}"
                :class="{ 'bg-indigo-600 text-white': activeMenu === '{{ $item['key'] }}' }"
                @click="activeMenu = '{{ $item['key'] }}'"
                class="flex items-center px-4 py-3 rounded-lg transition hover:bg-gray-800 hover:text-white">
                <i class="{{ $item['icon'] }} mr-3"></i>
                <span>{{ $item['label'] }}</span>
            </a>
            @endforeach
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
