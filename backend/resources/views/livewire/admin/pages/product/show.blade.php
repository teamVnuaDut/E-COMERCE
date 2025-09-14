<div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">📋 Chi tiết sản phẩm</h2>
        <a href="{{ route('admin.product.edit', $product->id) }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            ✏️ Chỉnh sửa
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div><strong>📛 Tên:</strong> {{ $product->name }}</div>
            <div><strong>🔗 Slug:</strong> {{ $product->slug }}</div>
            <div><strong>🧾 SKU:</strong> {{ $product->sku }}</div>
            <div><strong>📂 Danh mục:</strong> {{ optional($product->category)->name }}</div>
            <div><strong>🏷️ Thương hiệu:</strong> {{ optional($product->brand)->name ?? '—' }}</div>
            <div><strong>🚚 Nhà cung cấp:</strong> {{ optional($product->supplier)->name ?? '—' }}</div>
        </div>

        <div class="space-y-4">
            <div><strong>💰 Giá bán:</strong> {{ number_format($product->price, 0, ',', '.') }}₫</div>
            <div><strong>📦 Giá nhập:</strong> {{ number_format($product->cost_price, 0, ',', '.') }}₫</div>
            <div><strong>🔥 Giá khuyến mãi:</strong> {{ number_format($product->sale_price, 0, ',', '.') }}₫</div>
            <div><strong>📦 Tồn kho:</strong> {{ $product->stock_quantity }}</div>
            <div><strong>⚠️ Ngưỡng cảnh báo:</strong> {{ $product->low_stock_threshold }}</div>
            <div><strong>📌 Trạng thái:</strong>
                <span class="inline-block px-2 py-1 text-xs rounded-full
          @switch($product->status)
            @case('published') bg-green-100 text-green-700 @break
            @case('draft') bg-gray-100 text-gray-600 @break
            @case('pending') bg-yellow-100 text-yellow-800 @break
            @case('archived') bg-red-100 text-red-700 @break
          @endswitch">
                    {{ ucfirst($product->status) }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">📦 Kích thước & trọng lượng</h3>
            <div class="space-y-1 text-sm text-gray-700">
                <div>Dài: {{ $product->length }} cm</div>
                <div>Rộng: {{ $product->width }} cm</div>
                <div>Cao: {{ $product->height }} cm</div>
                <div>Trọng lượng: {{ $product->weight }} gram</div>
                <div>Sản phẩm ảo: {{ $product->is_virtual ? '✅ Có' : '❌ Không' }}</div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">🔍 SEO</h3>
            <div class="space-y-1 text-sm text-gray-700">
                <div><strong>Meta Title:</strong> {{ $product->meta_title }}</div>
                <div><strong>Meta Description:</strong> {{ $product->meta_description }}</div>
                <div><strong>Meta Keywords:</strong> {{ $product->meta_keywords }}</div>
            </div>
        </div>
    </div>

    <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">📝 Mô tả ngắn</h3>
        <p class="text-gray-600 italic">{{ $product->short_description }}</p>
    </div>

    <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">📄 Mô tả chi tiết</h3>
        <div class="prose max-w-none text-gray-800">
            {!! nl2br(e($product->description)) !!}
        </div>
    </div>
</div>
