<aside class="sidebar" x-data="{ activeMenu: 'dashboard' }">
    <div class="sidebar-header">
        <h1 class="text-xl font-bold">LIVING HEALTHY LIFE</h1>
    </div>

    <!-- User info -->
    <div class="px-4 py-3 border-b border-gray-700">
        <div class="flex items-center">
            <span class="fas fa-user-circle text-2xl text-gray-400 mr-3"></span>
            <span class="text-gray-300">Hi there {{ Auth::user()->name }}</span>
        </div>
    </div>

    <nav class="sidebar-menu">
        <a href="#"
            :class="{ 'active': activeMenu === 'dashboard' }"
            @click="activeMenu = 'dashboard'"
            class="flex items-center px-4 py-3 transition-colors">
            <i class="fas fa-th-large mr-3"></i> Dashboard
        </a>

        <a href="#"
            :class="{ 'active': activeMenu === 'users' }"
            @click="activeMenu = 'users'"
            class="flex items-center px-4 py-3 transition-colors">
            <i class="fas fa-users mr-3"></i> Thông tin người dùng
        </a>

        <a href="{{ route('admin.products') }}"
            :class="{ 'active': activeMenu === 'products' }"
            @click="activeMenu = 'products'"
            class="flex items-center px-4 py-3 transition-colors">
            <i class="fas fa-box mr-3"></i> Sản phẩm
        </a>

        <a href="#"
            :class="{ 'active': activeMenu === 'orders' }"
            @click="activeMenu = 'orders'"
            class="flex items-center px-4 py-3 transition-colors">
            <i class="fas fa-shopping-cart mr-3"></i> Đơn hàng
        </a>

        <a href="{{ route('admin.categories') }}"
            :class="{ 'active': activeMenu === 'categories' }"
            @click="activeMenu = 'categories'"
            class="flex items-center px-4 py-3 transition-colors">
            <i class="fas fa-th-list mr-3"></i> Danh mục sản phẩm
        </a>

        <a href="{{ route('admin.settings') }}"
            :class="{ 'active': activeMenu === 'settings' }"
            @click="activeMenu = 'settings'"
            class="flex items-center px-4 py-3 transition-colors">
            <i class="fas fa-cog mr-3"></i> Cài đặt
        </a>

        <!-- Logout button -->
        <form action="{{ route('logout') }}" method="POST" class="px-4 py-3">
            @csrf
            <button type="submit" class="flex items-center text-gray-300 hover:text-white transition-colors w-full">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </button>
        </form>
    </nav>
</aside>