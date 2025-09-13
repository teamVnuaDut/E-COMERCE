<div class="p-6 bg-white rounded-xl shadow">
    <!-- Thanh bar điều hướng -->
    <div class="flex justify-between items-center">
        <nav class="text-sm text-gray-600 space-x-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:underline text-indigo-600">Trang chủ</a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">Danh mục</span>
        </nav>
        <a href="{{ route('admin.category.create') }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            ➕ Tạo danh mục mới
        </a>
    </div>

    <!-- Tìm kiếm -->
    <input type="text" wire:model.debounce.500ms="search"
        placeholder="🔍 Tìm danh mục..."
        class="w-full px-4 py-2 border rounded-lg shadow-sm">

    <!-- Thông báo -->
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded">
        {{ session('success') }}
    </div>
    @endif

    <!-- Bảng 1: Tất cả danh mục -->
    <h3 class="text-lg font-bold text-gray-800">📋 Tất cả danh mục</h3>
    <table class="w-full table-auto border-collapse rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                <thead class="bg-gray-100 text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="p-3 text-left w-1/6">📛 Tên</th>
                        <th class="p-3 text-left w-1/6">🔗 Slug</th>
                        <th class="p-3 text-left w-1/6">📌 Trạng thái</th>
                        <th class="p-3 text-left w-1/6">🕒 Được tạo lúc</th>
                        <th class="p-3 text-center w-1/6">⚙️ Hành động</th>
                    </tr>
                </thead>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $category->name }}</td>
                <td class="p-3 text-sm text-gray-500">{{ $category->slug }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded-full text-xs
                            {{ $category->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
                <td class="p-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs bg-green-100 text-green-800 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $category->created_at->format('d/m/Y H:i') }}
                    </span>
                </td>


                <td class="p-3 text-center">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('admin.category.show', $category->id) }}"
                            class="text-gray-700 hover:underline text-sm">👁️ Xem</a>

                        <a href="{{ route('admin.category.edit', $category->id) }}"
                            class="text-blue-600 hover:underline text-sm">✏️ Sửa</a>

                        <button wire:click="confirmDelete({{ $category->id }})"
                            class="text-red-600 hover:underline text-sm">🗑️ Xóa</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-gray-500 text-center">Không có danh mục nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->links() }}

    <!-- Bảng 2: Danh mục cha -->
    <h3 class="text-lg font-bold text-gray-800">📁 Danh mục cha</h3>
    <table class="w-full table-auto border-collapse rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                <thead class="bg-gray-100 text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="p-3 text-left w-1/6">📛 Tên</th>
                        <th class="p-3 text-left w-1/6">🔗 Slug</th>
                        <th class="p-3 text-left w-1/6">📌 Trạng thái</th>
                        <th class="p-3 text-left w-1/6">🕒 Được tạo lúc</th>
                        <th class="p-3 text-center w-1/6">⚙️ Hành động</th>
                    </tr>
                </thead>
            </tr>
        </thead>
        <tbody>
            @forelse ($parentCategories as $category)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $category->name }}</td>
                <td class="p-3 text-sm text-gray-500">{{ $category->slug }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded-full text-xs
                            {{ $category->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
                <td class="p-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs bg-green-100 text-green-800 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $category->created_at->format('d/m/Y H:i') }}
                    </span>
                </td>
                <td class="p-3 text-center">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('admin.category.edit', $category->id) }}"
                            class="text-blue-600 hover:underline text-sm">✏️ Sửa</a>
                        <button wire:click="confirmDelete({{ $category->id }})"
                            class="text-red-600 hover:underline text-sm">🗑️ Xóa</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-3 text-gray-500 text-center">Không có danh mục cha.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Bảng 3: Danh mục con -->
    <h3 class="text-lg font-bold text-gray-800">📂 Danh mục con</h3>
    <table class="w-full table-auto border-collapse rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                <thead class="bg-gray-100 text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="p-3 text-left w-1/7">📛 Tên</th>
                        <th class="p-3 text-left w-1/7">🔗 Slug</th>
                        <th class="p-3 text-left w-1/7">📂 Danh mục cha</th>
                        <th class="p-3 text-left w-1/7">📌 Trạng thái</th>
                        <th class="p-3 text-left w-1/7">🕒 Được tạo lúc</th>
                        <th class="p-3 text-center w-1/7">⚙️ Hành động</th>
                    </tr>
                </thead>
            </tr>
        </thead>
        <tbody>
            @forelse ($childCategories as $category)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $category->name }}</td>
                <td class="p-3 text-sm text-gray-500">{{ $category->slug }}</td>
                <td class="p-3 text-sm text-gray-700">{{ $category->parent->name ?? '—' }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded-full text-xs
                            {{ $category->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
                <td class="p-3">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs bg-green-100 text-green-800 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $category->created_at->format('d/m/Y H:i') }}
                    </span>
                </td>
                <td class="p-3 text-center">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('admin.category.edit', $category->id) }}"
                            class="text-blue-600 hover:underline text-sm">✏️ Sửa</a>
                        <button wire:click="confirmDelete({{ $category->id }})"
                            class="text-red-600 hover:underline text-sm">🗑️ Xóa</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-gray-500 text-center">Không có danh mục con.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal xác nhận xóa -->
    @if ($deleteId)
    <div class=" fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg space-y-4 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-800">Xác nhận xóa</h3>
            <p class="text-gray-600">Bạn có chắc muốn xóa danh mục này không? Hành động này không thể hoàn tác.</p>
            <div class="flex justify-end gap-2">
                <button wire:click="$set('deleteId', null)"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Hủy
                </button>
                <button wire:click="deleteCategory"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Xóa
                </button>
            </div>
        </div>
    </div>
    @endif
