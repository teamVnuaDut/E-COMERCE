<div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow space-y-8">
    <!-- Tiêu đề + nút tạo -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            📦 <span>Danh sách nhà cung cấp</span>
        </h2>

        <a href="{{ route('admin.supplier.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition">
            ➕ Tạo mới
        </a>
    </div>

    <!-- Thông báo sau khi xoá -->
    @if (session()->has('success'))
    <div class="px-4 py-3 bg-green-100 text-green-800 rounded-md text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <!-- Bộ lọc -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="text" wire:model.debounce.500ms="search"
            placeholder="🔍 Tìm theo tên, mã, người liên hệ..."
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">

        <select wire:model="status"
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
            <option value="">— Tất cả trạng thái —</option>
            <option value="active">Hoạt động</option>
            <option value="inactive">Ngừng hoạt động</option>
        </select>
    </div>

    <!-- Bảng dữ liệu -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Tên</th>
                    <th class="px-4 py-3 text-left">Mã</th>
                    <th class="px-4 py-3 text-left">Người liên hệ</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Điện thoại</th>
                    <th class="px-4 py-3 text-left">Trạng thái</th>
                    <th class="px-4 py-3 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($suppliers as $supplier)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-medium">{{ $supplier->name }}</td>
                    <td class="px-4 py-3">{{ $supplier->code }}</td>
                    <td class="px-4 py-3">{{ $supplier->contact_person ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $supplier->email ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $supplier->phone ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                {{ $supplier->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $supplier->status === 'active' ? 'Hoạt động' : 'Ngừng' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.supplier.show', $supplier->id) }}"
                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-medium">
                            👁️ Xem
                        </a>
                        <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                            class="inline-flex items-center gap-1 text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                            ✏️ Sửa
                        </a>
                        <button wire:click="confirmDelete({{ $supplier->id }})"
                            class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 text-sm font-medium">
                            🗑️ Xoá
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-500 italic">Không có nhà cung cấp nào phù hợp.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="pt-4">
        {{ $suppliers->links() }}
    </div>
    <!-- Modal xác nhận xoá -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">⚠️ Xác nhận xoá</h3>
            <p class="text-sm text-gray-600 mb-6">Bạn có chắc muốn xoá nhà cung cấp này không?</p>
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
