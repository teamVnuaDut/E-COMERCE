<div class="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow">
    <!-- Tiêu đề -->
    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        ✏️ Chỉnh sửa thông tin sản phẩm
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form chỉnh sửa -->
        <form wire:submit.prevent="save" class="space-y-8">
            <!-- Thông tin cơ bản -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📛 Tên sản phẩm</label>
                    <input type="text" wire:model="product.name" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🔗 Slug</label>
                    <input type="text" wire:model="product.slug" class="w-full border border-gray-300 rounded px-4 py-2">
                    @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🧾 SKU</label>
                    <input type="text" wire:model="product.sku" class="w-full border border-gray-300 rounded px-4 py-2">
                    @error('sku') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Danh mục, thương hiệu, nhà cung cấp -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📂 Danh mục</label>
                    <select wire:model="product.category_id" class="w-full border border-gray-300 rounded px-4 py-2">
                        <option value="">— Chọn danh mục —</option>
                        @foreach ($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🏷️ Thương hiệu</label>
                    <select wire:model="product.brand_id" class="w-full border border-gray-300 rounded px-4 py-2">
                        <option value="">— Không chọn —</option>
                        @foreach ($brands as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🚚 Nhà cung cấp</label>
                    <select wire:model="product.supplier_id" class="w-full border border-gray-300 rounded px-4 py-2">
                        <option value="">— Không chọn —</option>
                        @foreach ($suppliers as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Giá cả -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">💰 Giá bán</label>
                    <input type="number" wire:model="product.price" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📦 Giá nhập</label>
                    <input type="number" wire:model="product.cost_price" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🔥 Giá khuyến mãi</label>
                    <input type="number" wire:model="product.sale_price" class="w-full border rounded px-4 py-2">
                </div>
            </div>

            <!-- Tồn kho -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📦 Số lượng tồn</label>
                    <input type="number" wire:model="product.stock_quantity" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">⚠️ Ngưỡng cảnh báo</label>
                    <input type="number" wire:model="product.low_stock_threshold" class="w-full border rounded px-4 py-2">
                </div>
                <div class="flex flex-col gap-2 mt-6">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="product.manage_stock" class="rounded border-gray-300">
                        <span class="text-sm">Theo dõi tồn kho</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="product.in_stock" class="rounded border-gray-300">
                        <span class="text-sm">Còn hàng</span>
                    </label>
                </div>
            </div>

            <!-- Trạng thái -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📌 Trạng thái</label>
                    <select wire:model="product.status" class="w-full border rounded px-4 py-2">
                        <option value="draft">Nháp</option>
                        <option value="pending">Chờ duyệt</option>
                        <option value="published">Công khai</option>
                        <option value="archived">Lưu trữ</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2 mt-6">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="product.is_featured" class="rounded border-gray-300">
                        <span class="text-sm">Nổi bật</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="product.is_virtual" class="rounded border-gray-300">
                        <span class="text-sm">Sản phẩm ảo</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="product.is_active" class="rounded border-gray-300">
                        <span class="text-sm">Đang hoạt động</span>
                    </label>
                </div>
            </div>

            <!-- Vận chuyển -->
            <div class="space-y-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" id="requiresShippingToggle" class="rounded border-gray-300">
                    <span class="text-sm font-medium text-gray-700">📦 Cần đóng gói vận chuyển</span>
                </label>

                <div id="shippingFields" class="grid grid-cols-1 md:grid-cols-4 gap-4 hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">⚖️ Trọng lượng (gram)</label>
                        <input type="number" name="weight" class="w-full border rounded px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">📏 Dài (cm)</label>
                        <input type="number" name="length" class="w-full border rounded px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">📐 Rộng (cm)</label>
                        <input type="number" name="width" class="w-full border rounded px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">📦 Cao (cm)</label>
                        <input type="number" name="height" class="w-full border rounded px-4 py-2">
                    </div>
                </div>
            </div>

            <!-- Mô tả -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📝 Mô tả ngắn</label>
                    <textarea wire:model="product.short_description" rows="2"
                        class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📄 Mô tả chi tiết</label>
                    <textarea wire:model="product.description" rows="5"
                        class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
            </div>

            <!-- SEO -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-700">🔍 Thông tin SEO</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">🔍 Meta Title</label>
                        <input type="text" wire:model="product.meta_title"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">📝 Meta Description</label>
                        <textarea wire:model="product.meta_description" rows="2"
                            class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">🏷️ Meta Keywords</label>
                        <input type="text" wire:model="product.meta_keywords"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.product.index') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 transition">
                    🔙 Quay về danh sách
                </a>
                <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    💾 Lưu sản phẩm
                </button>
            </div>
        </form>

        <!-- Bảng thông tin hiện tại -->
        <div class="bg-gray-50 border rounded-xl p-6 shadow-sm space-y-4">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">📋 Thông tin hiện tại</h3>
            <table class="table-auto w-full text-sm text-gray-700 divide-y divide-gray-200">
                <tbody>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">📛 Tên sản phẩm</td>
                        <td class="py-2">{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">🔗 Slug</td>
                        <td class="py-2">{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">🧾 SKU</td>
                        <td class="py-2">{{ $product->sku }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">💰 Giá bán</td>
                        <td class="py-2">{{ number_format($product->price, 0, ',', '.') }}₫</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">📦 Tồn kho</td>
                        <td class="py-2">{{ $product->stock_quantity }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">📌 Trạng thái</td>
                        <td class="py-2">
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
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">📦 Kích thước</td>
                        <td class="py-2">
                            {{ $product->length }} x {{ $product->width }} x {{ $product->height }} cm<br>
                            Trọng lượng: {{ $product->weight }} gram
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-gray-600">📝 Mô tả ngắn</td>
                        <td class="py-2 text-gray-600 italic">{{ $product->short_description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
