<div class="bg-white p-6 rounded-2xl shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">📦 Danh sách sản phẩm</h2>
        <a href="{{ route('admin.product.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            ➕ Tạo mới sản phẩm
        </a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 text-gray-600">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Tên</th>
                <th class="px-4 py-2 border">SKU</th>
                <th class="px-4 py-2 border">Giá</th>
                <th class="px-4 py-2 border">Giá Sale</th>
                <th class="px-4 py-2 border">Lưu kho</th>
                <th class="px-4 py-2 border">Trạng thái</th>
                <th class="px-4 py-2 border">Được tạo lúc</th>
                <th class="px-4 py-2 border">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2 border">{{ $product->id }}</td>
                <td class="px-4 py-2 border">{{ $product->name }}</td>
                <td class="px-4 py-2 border">{{ $product->sku }}</td>
                <td class="px-4 py-2 border">{{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-2 border">{{ $product->sale_price ? number_format($product->sale_price,0,',','.') : '-' }}</td>
                <td class="px-4 py-2 border">{{ $product->stock_quantity }}</td>
                <td class="px-4 py-2 border">{{ ucfirst($product->status) }}</td>
                <td class="px-4 py-2 border">{{ $product->created_at->format('d/m/Y') }}</td>
                <td class="px-4 py-2 border">
                    {{-- Nút sửa / xóa sẽ đặt ở đây sau --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
