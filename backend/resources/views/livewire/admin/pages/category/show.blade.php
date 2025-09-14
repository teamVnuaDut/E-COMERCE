<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        👁️ Chi tiết danh mục
        <span class="text-sm px-2 py-1 rounded-full {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ ucfirst($category->status) }}
        </span>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
        <div>
            <div class="font-medium text-gray-600">📛 Tên</div>
            <div class="mt-1 text-gray-900">{{ $category->name }}</div>
        </div>

        <div>
            <div class="font-medium text-gray-600">🔗 Slug</div>
            <div class="mt-1 text-gray-900">{{ $category->slug }}</div>
        </div>

        <div>
            <div class="font-medium text-gray-600">📂 Danh mục cha</div>
            <div class="mt-1 text-gray-900">{{ $category->parent->name ?? '—' }}</div>
        </div>

        <div>
            <div class="font-medium text-gray-600">🔢 Thứ tự hiển thị</div>
            <div class="mt-1 text-gray-900">{{ $category->sort_order }}</div>
        </div>

        <div class="md:col-span-2">
            <div class="font-medium text-gray-600">📝 Mô tả</div>
            <div class="mt-1 text-gray-800 bg-gray-50 p-3 rounded-lg">
                {{ $category->description ?? '—' }}
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="font-medium text-gray-600">🖼️ Hình ảnh</div>
            <div class="mt-2">
                @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" class="w-40 h-40 object-cover rounded-lg border">
                @else
                <span class="text-gray-500">Không có hình ảnh</span>
                @endif
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="font-medium text-gray-600">🔍 Meta Title</div>
            <div class="mt-1 text-gray-800">{{ $category->meta_title ?? '—' }}</div>
        </div>

        <div class="md:col-span-2">
            <div class="font-medium text-gray-600">📝 Meta Description</div>
            <div class="mt-1 text-gray-800">{{ $category->meta_description ?? '—' }}</div>
        </div>

        <div class="md:col-span-2">
            <div class="font-medium text-gray-600">🏷️ Meta Keywords</div>
            <div class="mt-1 text-gray-800">{{ $category->meta_keywords ?? '—' }}</div>
        </div>
    </div>

    <div class="flex justify-end gap-3 mt-6">
        <a href="{{ route('admin.category.edit', $category->id) }}"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            ✏️ Sửa
        </a>
        <a href="{{ route('admin.category.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
            🔙 Quay về danh sách
        </a>
    </div>
</div>
