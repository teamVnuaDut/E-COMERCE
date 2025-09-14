<div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">📋 Danh sách thuộc tính</h2>

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
        <input type="text" wire:model.debounce.500ms="search"
            placeholder="🔍 Tìm kiếm thuộc tính..."
            class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <a href="{{ route('admin.attribute.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            ➕ Thêm thuộc tính
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 font-semibold text-gray-600">
                <tr>
                    <th class="p-4">📛 Tên</th>
                    <th class="p-4">🔗 Slug</th>
                    <th class="p-4">📦 Loại</th>
                    <th class="p-4 text-center">🔍 Lọc</th>
                    <th class="p-4 text-center">👁️ Hiển thị</th>
                    <th class="p-4 text-center">⚠️ Bắt buộc</th>
                    <th class="p-4 text-center">🕒 Tạo lúc</th>
                    <th class="p-4 text-center">⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attributes as $attribute)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-800">{{ $attribute->name }}</td>
                    <td class="p-4 text-gray-600">{{ $attribute->slug }}</td>
                    <td class="p-4 text-gray-600">{{ ucfirst($attribute->type) }}</td>
                    <td class="p-4 text-center">
                        <span class="inline-block px-2 py-1 text-xs rounded-full {{ $attribute->is_filterable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $attribute->is_filterable ? 'Có' : 'Không' }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-block px-2 py-1 text-xs rounded-full {{ $attribute->is_visible ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $attribute->is_visible ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-block px-2 py-1 text-xs rounded-full {{ $attribute->is_required ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $attribute->is_required ? 'Bắt buộc' : 'Tùy chọn' }}
                        </span>
                    </td>
                    <td class="p-4 text-center text-xs text-gray-500">
                        {{ $attribute->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.attribute.show', $attribute->id) }}"
                                class="text-gray-600 hover:text-indigo-600 transition text-sm">👁️</a>
                            <a href="{{ route('admin.attribute.edit', $attribute->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition text-sm">✏️</a>
                            <button wire:click="confirmDelete({{ $attribute->id }})"
                                class="text-red-600 hover:text-red-800 transition text-sm">
                                🗑️
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-6 text-center text-gray-500">Không có thuộc tính nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $attributes->links() }}
    </div>
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">⚠️ Xác nhận xoá</h3>
            <p class="text-sm text-gray-600 mb-6">Bạn có chắc muốn xoá thuộc tính này không?</p>
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
