<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Products</h2>
    <p class="text-gray-600 mb-6">Thông tin các sản phẩm.</p>

    <div class="overview-card bg-blue-50 rounded-lg p-4 border border-blue-200 mb-6">
        <!-- <h3 class="text-lg font-semibold text-blue-800 mb-2">
            <a href="{{ route('admin.overview') }}" class="hover:text-blue-600 transition-colors flex items-center">
                <i class="fas fa-chart-bar mr-2"></i> System Overview
            </a>
        </h3> -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-4 border border-gray-200">
                <h4 class="text-sm font-medium text-gray-600 mb-2">Total Products</h4>
                <p class="text-2xl font-bold text-gray-800">{{ isset($totalProducts) ? $totalProducts : 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 border border-gray-200">
                <h4 class="text-sm font-medium text-gray-600 mb-2">Tổng sản phẩm sữa</h4>
                <p class="text-2xl font-bold text-gray-800">{{ isset($totalProducts) ? $totalProducts : 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 border border-gray-200">
                <h4 class="text-sm font-medium text-gray-600 mb-2">Tổng sản phẩm ngũ cốc</h4>
                <p class="text-2xl font-bold text-gray-800">{{ isset($totalProducts) ? $totalProducts : 0 }}</p>
            </div>
        </div>


    </div>

    <!-- Nut tao san pham moi -->
    <div class="mt-4">
        <a href="{{ route('admin.product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
            <i class="fas fa-plus mr-2"></i> Tạo sản phẩm mới
        </a>
    </div>

    <!-- Danh sach san pham -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Danh sách sản phẩm</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Tên sản phẩm</th>
                    <th class="py-2 px-4 border-b">Danh mục</th>
                    <th class="py-2 px-4 border-b">Giá</th>
                    <th class="py-2 px-4 border-b">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($products) && $products->count() > 0)
                @foreach ($products as $product)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->category->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="text-blue-500 hover:underline">Chỉnh sửa</a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="py-2 px-4 border-b text-center">Không có sản phẩm nào.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>