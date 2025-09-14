<div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow space-y-8">
    <h2 class="text-3xl font-bold text-gray-800">➕ Tạo sản phẩm mới</h2>

    <form wire:submit.prevent="save" class="space-y-8">

        <!-- Thông tin cơ bản -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📛 Tên sản phẩm</label>
                <input type="text" wire:model="name" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🔗 Slug</label>
                <input type="text" wire:model="slug" class="w-full border border-gray-300 rounded px-4 py-2">
                @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🧾 SKU</label>
                <input type="text" wire:model="sku" class="w-full border border-gray-300 rounded px-4 py-2">
                @error('sku') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Danh mục, thương hiệu, nhà cung cấp -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📂 Danh mục</label>
                <select wire:model="category_id" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">— Chọn danh mục —</option>
                    @foreach ($categories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🏷️ Thương hiệu</label>
                <select wire:model="brand_id" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">— Không chọn —</option>
                    @foreach ($brands as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🚚 Nhà cung cấp</label>
                <select wire:model="supplier_id" class="w-full border border-gray-300 rounded px-4 py-2">
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
                <input type="number" wire:model="price" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📦 Giá nhập</label>
                <input type="number" wire:model="cost_price" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🔥 Giá khuyến mãi</label>
                <input type="number" wire:model="sale_price" class="w-full border rounded px-4 py-2">
            </div>
        </div>

        <!-- Tồn kho -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📦 Số lượng tồn</label>
                <input type="number" wire:model="stock_quantity" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">⚠️ Ngưỡng cảnh báo</label>
                <input type="number" wire:model="low_stock_threshold" class="w-full border rounded px-4 py-2">
            </div>
            <div class="flex flex-col gap-2 mt-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="manage_stock" class="rounded border-gray-300">
                    <span class="text-sm">Theo dõi tồn kho</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="in_stock" class="rounded border-gray-300">
                    <span class="text-sm">Còn hàng</span>
                </label>
            </div>
        </div>

        <!-- Trạng thái -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📌 Trạng thái</label>
                <select wire:model="status" class="w-full border rounded px-4 py-2">
                    <option value="draft">Nháp</option>
                    <option value="pending">Chờ duyệt</option>
                    <option value="published">Công khai</option>
                    <option value="archived">Lưu trữ</option>
                </select>
            </div>
            <div class="flex flex-col gap-2 mt-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_featured" class="rounded border-gray-300">
                    <span class="text-sm">Nổi bật</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_virtual" class="rounded border-gray-300">
                    <span class="text-sm">Sản phẩm ảo</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_active" class="rounded border-gray-300">
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
                <textarea wire:model="short_description" rows="2"
                    class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📄 Mô tả chi tiết</label>
                <textarea wire:model="description" rows="5"
                    class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>
        </div>

        <!-- SEO -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-700">🔍 Thông tin SEO</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🔍 Meta Title</label>
                    <input type="text" wire:model="meta_title"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📝 Meta Description</label>
                    <textarea wire:model="meta_description" rows="2"
                        class="w-full border border-gray-300 rounded px-4 py-2 resize-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🏷️ Meta Keywords</label>
                    <input type="text" wire:model="meta_keywords"
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
