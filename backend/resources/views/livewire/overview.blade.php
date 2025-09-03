<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Overview</h2>
    <p class="text-gray-600 mb-6">Thống kê số liệu.</p>

    <div class="overview-card bg-blue-50 rounded-lg p-4 border border-blue-200 mb-6">
        <h3 class="text-lg font-semibold text-blue-800 mb-2">
            <a href="{{ route('admin.overview') }}" class="hover:text-blue-600 transition-colors flex items-center">
                <i class="fas fa-chart-bar mr-2"></i> System Overview
            </a>
        </h3>
        <p class="text-blue-600">Here you can find a quick overview of the system's status.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <h4 class="font-semibold text-gray-600">Products</h4>
                <div class="bg-blue-100 p-2 rounded-full">
                    <i class="fas fa-box text-blue-500"></i>
                </div>
            </div>
            <!-- Hiển thị tổng số sản phẩm -->
            <p class="text-2xl font-bold mt-2">{{ $totalProducts }}</p>

            <!-- Hiển thị phần trăm thay đổi nếu có -->
            @if(isset($percentageChange))
            <p class="text-green-500 text-sm mt-1">
                <i class="fas fa-arrow-up"></i> {{ $percentageChange }}%
            </p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <h4 class="font-semibold text-gray-600">Orders</h4>
                <div class="bg-green-100 p-2 rounded-full">
                    <i class="fas fa-shopping-cart text-green-500"></i>
                </div>
            </div>
            <p class="text-2xl font-bold mt-2">{{ $totalOrders }}</p>
            @if(isset($percentageChange))
            <p class="text-green-500 text-sm mt-1">
                <i class="fas fa-arrow-up"></i> {{ $percentageChange }}%
            </p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <h4 class="font-semibold text-gray-600">Empty</h4>
                <div class="bg-green-100 p-2 rounded-full">
                    <i class="fas fa-shopping-cart text-green-500"></i>
                </div>
            </div>
            <p class="text-2xl font-bold mt-2">---</p>
            <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up"></i> Empty</p>
        </div>

        <!--  -->
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <h4 class="font-semibold text-gray-600">Inventories</h4>
                <div class="bg-blue-100 p-2 rounded-full">
                    <i class="fas fa-box text-blue-500"></i>
                </div>
            </div>
            <p class="text-2xl font-bold mt-2">1,234</p>
            <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up"></i> 12% from last month</p>
        </div>



        <!-- <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <h4 class="font-semibold text-gray-600">Revenue</h4>
                <div class="bg-purple-100 p-2 rounded-full">
                    <i class="fas fa-dollar-sign text-purple-500"></i>
                </div>
            </div>
            <p class="text-2xl font-bold mt-2">$12,345</p>
            <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up"></i> 15% from last month</p>
        </div> -->
    </div>

    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">PART IV LIFE</h3>
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <p class="text-gray-700">
                <strong>GET admin</strong> - We provide a number of daily statements and health products to help you find your health.
            </p>
            <p class="text-gray-700 mt-2">
                Our system offers personalized health recommendations, progress tracking, and a comprehensive database of health products tailored to your needs.
            </p>
        </div>
    </div>
</div>
