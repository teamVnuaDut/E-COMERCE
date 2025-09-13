<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">👁️ Chi tiết danh mục</h2>

    <table class="w-full text-sm text-gray-700">
        <tr>
            <td class="font-medium w-1/3">Tên:</td>
            <td>{{ $category->name }}</td>
        </tr>
        <tr>
            <td class="font-medium">Slug:</td>
            <td>{{ $category->slug }}</td>
        </tr>
        <tr>
            <td class="font-medium">Mô tả:</td>
            <td>{{ $category->description ?? '—' }}</td>
        </tr>
        <tr>
            <td class="font-medium">Danh mục cha:</td>
            <td>{{ $category->parent->name ?? '—' }}</td>
        </tr>
        <tr>
            <td class="font-medium">Thứ tự hiển thị:</td>
            <td>{{ $category->sort_order }}</td>
        </tr>
        <tr>
            <td class="font-medium">Trạng thái:</td>
            <td>
                <span class="px-2 py-1 rounded-full text-xs
                    {{ $category->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                    {{ ucfirst($category->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <td class="font-medium">Meta Title:</td>
            <td>{{ $category->meta_title ?? '—' }}</td>
        </tr>
        <tr>
            <td class="font-medium">Meta Description:</td>
            <td>{{ $category->meta_description ?? '—' }}</td>
        </tr>
        <tr>
            <td class="font-medium">Meta Keywords:</td>
            <td>{{ $category->meta_keywords ?? '—' }}</td>
        </tr>
        <tr>
            <td class="font-medium">Hình ảnh:</td>
            <td>
                @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" class="w-32 h-32 object-cover rounded">
                @else
                <span class="text-gray-500">Không có</span>
                @endif
            </td>
        </tr>
    </table>

    <div class="flex justify-end gap-3">
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
