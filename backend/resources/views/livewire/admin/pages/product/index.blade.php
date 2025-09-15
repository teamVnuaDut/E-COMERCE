<div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
        <h2 class="text-2xl font-bold text-gray-800">🛒 Danh sách sản phẩm</h2>

        <a href="{{ route('admin.product.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            ➕ Thêm sản phẩm
        </a>
    </div>


    {{-- Bộ lọc nâng cao --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input type="text" wire:model.debounce.500ms="search"
            placeholder="🔍 Tên, SKU, slug, mô tả..."
            class="border border-gray-300 rounded px-4 py-2 w-full focus:ring-indigo-500">

        <select wire:model="status" class="border border-gray-300 rounded px-4 py-2 w-full">
            <option value="">— Trạng thái —</option>
            <option value="draft">Nháp</option>
            <option value="pending">Chờ duyệt</option>
            <option value="published">Công khai</option>
            <option value="archived">Lưu trữ</option>
        </select>

        <select wire:model="category_id" class="border border-gray-300 rounded px-4 py-2 w-full">
            <option value="">— Danh mục —</option>
            @foreach ($categories as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <input type="number" wire:model="price_min" placeholder="Giá từ"
                class="w-1/2 border border-gray-300 rounded px-2 py-2">
            <input type="number" wire:model="price_max" placeholder="Đến"
                class="w-1/2 border border-gray-300 rounded px-2 py-2">
        </div>
    </div>

    {{-- Bảng sản phẩm --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="p-4">📛 Tên</th>
                    <th class="p-4">🧾 SKU</th>
                    <th class="p-4">💰 Giá</th>
                    <th class="p-4">📦 Tồn kho</th>
                    <th class="p-4">📌 Trạng thái</th>
                    <th class="p-4">🕒 Tạo lúc</th>
                    <th class="p-4 text-center">⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-900">{{ $product->name }}</td>
                    <td class="p-4 text-gray-600">{{ $product->sku }}</td>
                    <td class="p-4 text-gray-900">{{ number_format($product->price, 0, ',', '.') }}₫</td>
                    <td class="p-4 text-gray-700">
                        <span class="{{ $product->stock_quantity <= $product->low_stock_threshold ? 'text-red-600 font-semibold' : '' }}">
                            {{ $product->stock_quantity }}
                        </span>
                    </td>
                    <td class="p-4">
                        <span class="inline-block px-2 py-1 text-xs rounded-full
                                @switch($product->status)
                                    @case('published') bg-green-100 text-green-700 @break
                                    @case('draft') bg-gray-100 text-gray-600 @break
                                    @case('pending') bg-yellow-100 text-yellow-800 @break
                                    @case('archived') bg-red-100 text-red-700 @break
                                @endswitch">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-sm text-gray-600">
                        {{ $product->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-3 text-sm">
                            <a href="{{ route('admin.product.show', $product->id) }}"
                                class="text-gray-600 hover:text-indigo-600 transition">👁️</a>
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition">✏️</a>
                            <button wire:click="confirmDelete({{ $product->id }})"
                                class="text-red-600 hover:text-red-800 transition">🗑️</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-500">Không có sản phẩm nào phù hợp.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">⚠️ Xác nhận xoá</h3>
            <p class="text-sm text-gray-600 mb-6">Bạn có chắc muốn xoá sản phẩm này không?</p>
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 text-sm">Huỷ</button>
                <button onclick="confirmDelete()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">Xoá</button>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
    <div class="px-4 py-3 bg-green-100 text-green-800 rounded-md text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif
</div>
