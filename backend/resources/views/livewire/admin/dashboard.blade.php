<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-800">📊 Admin Dashboard</h1>
        <span class="text-sm text-gray-500">Cập nhật lúc {{ now()->format('H:i d/m/Y') }}</span>
    </div>

    <!-- Thống kê nhanh -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow hover:scale-105 transform transition">
            <h2 class="text-lg font-semibold">👤 Người dùng</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
            <p class="text-sm text-blue-100">+{{ $newUsersThisWeek }} tuần này</p>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-2xl shadow hover:scale-105 transform transition">
            <h2 class="text-lg font-semibold">📦 Sản phẩm</h2>
            <p class="text-3xl font-bold mt-2">350</p>
            <p class="text-sm text-green-100">+25 mới thêm</p>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 rounded-2xl shadow hover:scale-105 transform transition">
            <h2 class="text-lg font-semibold">🛒 Đơn hàng</h2>
            <p class="text-3xl font-bold mt-2">45</p>
            <p class="text-sm text-yellow-100">Đang chờ xử lý</p>
        </div>
    </div>

    <!-- Biểu đồ -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold mb-4">📈 Thống kê doanh số</h2>
        <canvas id="salesChart"></canvas>
    </div>

    <!-- Hoạt động gần đây -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold mb-4">📰 Hoạt động gần đây</h2>
        <ul class="space-y-2 text-gray-700">
            <li>✅ Admin vừa thêm sản phẩm mới.</li>
            <li>🔄 Manager đã cập nhật trạng thái đơn hàng #1234.</li>
            <li>🚚 Staff xử lý đơn hàng #5678.</li>
        </ul>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
            datasets: [{
                label: 'Doanh số',
                data: [12, 19, 8, 17, 23, 30, 28],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
