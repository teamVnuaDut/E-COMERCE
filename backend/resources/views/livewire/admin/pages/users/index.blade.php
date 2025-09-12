<div class="p-6 bg-white rounded-xl shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800">📋 Danh sách người dùng</h2>
        <a href="{{ route('admin.users.create') }}"
            class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            ➕ Thêm người dùng
        </a>
    </div>

    <div class="mb-4">
        <input type="text" wire:model.debounce.500ms="search"
            placeholder="🔍 Tìm kiếm theo tên hoặc email..."
            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-indigo-300">
    </div>

    @if ($search)
    <div class="text-sm text-gray-600 mb-2">
        🔎 Tìm thấy {{ $users->total() }} kết quả cho "<strong>{{ $search }}</strong>"
    </div>
    @endif
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif


    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-sm border rounded">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Tên</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">SĐT</th>
                    <th class="px-4 py-2 text-left">Vai trò</th>
                    <th class="px-4 py-2 text-left">Trạng thái</th>
                    <th class="px-4 py-2 text-left">Ngày tạo</th>
                    <th class="px-4 py-2 text-left">Avatar</th>
                    <th class="px-4 py-2 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $users->firstItem() + $index }}</td>
                    <td class="px-4 py-2 font-semibold">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->phone ?? '—' }}</td>
                    <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                    <td class="px-4 py-2 capitalize">{{ $user->status }}</td>
                    <td class="px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                        <span class="text-gray-400">Không có</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <a href="{{ route('admin.users.show', $user->id) }}"
                            class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                            👁️ Xem
                        </a>

                        <a href="{{ route('admin.users.edit', $user->id) }}"
                            class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">
                            ✏️ Sửa
                        </a>

                        <button wire:click="confirmDelete({{ $user->id }})"
                            class="inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                            🗑️ Xóa
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-4 text-center text-gray-500">Không có người dùng nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
