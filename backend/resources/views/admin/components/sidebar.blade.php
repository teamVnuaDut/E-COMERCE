<aside class="sidebar bg-gray-900 text-gray-300 w-64 h-screen fixed top-0 left-0 flex flex-col shadow-lg"
    x-data="{ activeMenu: 'dashboard' }">

    <!-- Header -->
    <div class="sidebar-header px-6 py-4 border-b border-gray-700">
        <h1 class="text-lg font-bold tracking-wide text-white">LIVING HEALTHY LIFE</h1>
    </div>

    <!-- User Info -->
    <div class="px-6 py-4 border-b border-gray-700 flex items-center space-x-3">
        <i class="fas fa-user-circle text-3xl text-gray-400"></i>
        <div>
            <p class="text-sm">Xin chào,</p>
            <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        {{-- Dashboard cho tất cả --}}
        <a href="{{ route(Auth::user()->role . '.dashboard') }}"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'dashboard' }"
            @click="activeMenu = 'dashboard'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-th-large mr-3"></i>
            <span>Dashboard</span>
        </a>

        {{-- Menu riêng cho Admin --}}
        @if(Auth::user()->role === 'admin')
        <a href="#"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'users' }"
            @click="activeMenu = 'users'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-users mr-3"></i>
            <span>Quản lý người dùng</span>
        </a>

        <a href="#"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'settings' }"
            @click="activeMenu = 'settings'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-cog mr-3"></i>
            <span>Cài đặt hệ thống</span>
        </a>
        @endif

        {{-- Menu riêng cho Manager --}}
        @if(Auth::user()->role === 'manager')
        <a href="{{ route('manager.products.index') }}"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'products' }"
            @click="activeMenu = 'products'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-box mr-3"></i>
            <span>Quản lý sản phẩm</span>
        </a>

        <a href="{{ route('manager.orders.index') }}"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'orders' }"
            @click="activeMenu = 'orders'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-shopping-cart mr-3"></i>
            <span>Quản lý đơn hàng</span>
        </a>
        @endif

        {{-- Menu riêng cho Staff --}}
        @if(Auth::user()->role === 'staff')
        <a href="{{ route('staff.orders.index') }}"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'orders' }"
            @click="activeMenu = 'orders'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-tasks mr-3"></i>
            <span>Xử lý đơn hàng</span>
        </a>
        @endif

        {{-- Menu riêng cho Customer --}}
        @if(Auth::user()->role === 'customer')
        <a href="{{ route('customer.orders.index') }}"
            :class="{ 'bg-gray-800 text-white': activeMenu === 'my-orders' }"
            @click="activeMenu = 'my-orders'"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 hover:text-white transition">
            <i class="fas fa-shopping-bag mr-3"></i>
            <span>Đơn hàng của tôi</span>
        </a>
        @endif
    </nav>

    <!-- Logout -->
    <div class="px-6 py-4 border-t border-gray-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </button>
        </form>
    </div>
</aside>