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
    <h3 class="text-xl font-bold text-gray-800 mb-4">📋 Tất cả danh mục</h3>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="p-4 w-1/5">📛 Tên</th>
                    <th class="p-4 w-1/5">🔗 Slug</th>
                    <th class="p-4 w-1/6">📌 Trạng thái</th>
                    <th class="p-4 w-1/4">🕒 Được tạo lúc</th>
                    <th class="p-4 w-1/6 text-center">⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-900">{{ $category->name }}</td>
                    <td class="p-4 text-gray-500">{{ $category->slug }}</td>
                    <td class="p-4">
                        <span class="inline-block px-2 py-1 text-xs rounded-full
                            {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($category->status) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-700 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $category->created_at->format('d/m/Y H:i') }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-3 text-sm">
                            <a href="{{ route('admin.category.show', $category->id) }}"
                                class="text-gray-600 hover:text-indigo-600 transition">👁️</a>
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition">✏️</a>
                            <button wire:click="confirmDelete({{ $category->id }})"
                                class="text-red-600 hover:text-red-800 transition">🗑️</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Không có danh mục nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>

    <!-- Bảng 2: Danh mục cha -->
    <h3 class="text-xl font-bold text-gray-800 mb-4">📁 Danh mục cha</h3>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow mb-8">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="p-4 w-1/5">📛 Tên</th>
                    <th class="p-4 w-1/5">🔗 Slug</th>
                    <th class="p-4 w-1/6">📌 Trạng thái</th>
                    <th class="p-4 w-1/4">🕒 Được tạo lúc</th>
                    <th class="p-4 w-1/6 text-center">⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($parentCategories as $category)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-900">{{ $category->name }}</td>
                    <td class="p-4 text-gray-500">{{ $category->slug }}</td>
                    <td class="p-4">
                        <span class="inline-block px-2 py-1 text-xs rounded-full
                            {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($category->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-sm text-gray-600">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 text-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $category->created_at->format('d/m/Y H:i') }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-3 text-sm">
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition">✏️</a>
                            <button wire:click="confirmDelete({{ $category->id }})"
                                class="text-red-600 hover:text-red-800 transition">🗑️</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Không có danh mục cha.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-bold text-gray-800 mb-4">📂 Danh mục con</h3>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="p-4 w-1/6">📛 Tên</th>
                    <th class="p-4 w-1/6">🔗 Slug</th>
                    <th class="p-4 w-1/6">📂 Danh mục cha</th>
                    <th class="p-4 w-1/6">📌 Trạng thái</th>
                    <th class="p-4 w-1/6">🕒 Được tạo lúc</th>
                    <th class="p-4 w-1/6 text-center">⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($childCategories as $category)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-900">{{ $category->name }}</td>
                    <td class="p-4 text-gray-500">{{ $category->slug }}</td>
                    <td class="p-4 text-gray-700">{{ $category->parent->name ?? '—' }}</td>
                    <td class="p-4">
                        <span class="inline-block px-2 py-1 text-xs rounded-full
                            {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($category->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-sm text-gray-600">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 text-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $category->created_at->format('d/m/Y H:i') }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-3 text-sm">
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition">✏️</a>
                            <button wire:click="confirmDelete({{ $category->id }})"
                                class="text-red-600 hover:text-red-800 transition">🗑️</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">Không có danh mục con.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

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
