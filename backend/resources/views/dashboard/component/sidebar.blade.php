<aside class="w-64 bg-white h-screen shadow-md fixed top-0 left-0 flex flex-col">
    <div class="h-16 flex items-center justify-center border-b">
        <span class="text-xl font-bold text-blue-600">Dashboard</span>
    </div>
    <nav class="flex-1 px-4 py-6">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Trang chủ
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Sản phẩm
                </a>
            </li>
            <li>
                <a href="{{ route('order.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Đơn hàng
                </a>
            </li>
            <li>
                <a href="{{ route('customer.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 11-8 0 4 4 0 018 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Khách hàng
                </a>
            </li>
            <li>
                <a href="{{ route('setting.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 0V4m0 16v-4m8-4h-4m-8 0H4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Cài đặt
                </a>
            </li>
        </ul>
    </nav>
    <div class="px-4 py-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-3 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Đăng xuất
            </button>
        </form>
    </div>
</aside>
