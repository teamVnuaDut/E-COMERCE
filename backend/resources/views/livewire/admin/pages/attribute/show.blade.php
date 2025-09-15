<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">👁️ Chi tiết thuộc tính</h2>

    <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
        <div>
            <span class="font-medium">📛 Tên:</span>
            <div class="mt-1 text-gray-900">{{ $attribute->name }}</div>
        </div>

        <div>
            <span class="font-medium">🔗 Slug:</span>
            <div class="mt-1 text-gray-900">{{ $attribute->slug }}</div>
        </div>

        <div>
            <span class="font-medium">📦 Loại:</span>
            <div class="mt-1 text-gray-900">{{ ucfirst($attribute->type) }}</div>
        </div>

        <div>
            <span class="font-medium">🕒 Tạo lúc:</span>
            <div class="mt-1 text-gray-900">{{ $attribute->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div>
            <span class="font-medium">📌 Lọc sản phẩm:</span>
            <div class="mt-1">
                <span class="inline-block px-2 py-1 text-xs rounded-full {{ $attribute->is_filterable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $attribute->is_filterable ? 'Có' : 'Không' }}
                </span>
            </div>
        </div>

        <div>
            <span class="font-medium">👁️ Hiển thị:</span>
            <div class="mt-1">
                <span class="inline-block px-2 py-1 text-xs rounded-full {{ $attribute->is_visible ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $attribute->is_visible ? 'Có' : 'Không' }}
                </span>
            </div>
        </div>

        <div>
            <span class="font-medium">⚠️ Bắt buộc:</span>
            <div class="mt-1">
                <span class="inline-block px-2 py-1 text-xs rounded-full {{ $attribute->is_required ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600' }}">
                    {{ $attribute->is_required ? 'Bắt buộc' : 'Tùy chọn' }}
                </span>
            </div>
        </div>

        <div>
            <span class="font-medium">🔢 Thứ tự hiển thị:</span>
            <div class="mt-1 text-gray-900">{{ $attribute->sort_order }}</div>
        </div>
    </div>

    <div class="mt-6">
        <span class="font-medium text-gray-700">📝 Mô tả:</span>
        <div class="mt-2 text-gray-800 bg-gray-50 p-4 rounded-lg">
            {{ $attribute->description ?? '—' }}
        </div>
    </div>

    <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('admin.attribute.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
            🔙 Quay về danh sách
        </a>
        <a href="{{ route('admin.attribute.edit', $attribute->id) }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            ✏️ Chỉnh sửa
        </a>
    </div>
</div>
