<div class="p-6 bg-white rounded-xl shadow max-w-xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">👤 Thông tin người dùng</h2>

    <div class="space-y-4">
        @if ($user->avatar)
        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-24 h-24 rounded-full mx-auto mb-4">
        @endif

        <div><strong>Tên:</strong> {{ $user->name }}</div>
        <div><strong>Email:</strong> {{ $user->email }}</div>
        <div><strong>Số điện thoại:</strong> {{ $user->phone ?? '—' }}</div>
        <div><strong>Địa chỉ:</strong> {{ $user->address ?? '—' }}</div>
        <div><strong>Vai trò:</strong> <span class="uppercase">{{ $user->role }}</span></div>
        <div><strong>Trạng thái:</strong>
            <span class="{{ $user->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                {{ $user->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
            </span>
        </div>
        <div><strong>Ngày tạo:</strong> {{ optional($user->created_at)->format('d/m/Y H:i') }}</div>
        <div><strong>Cập nhật gần nhất:</strong> {{ optional($user->updated_at)->format('d/m/Y H:i') }}</div>
    </div>

    <div class="mt-6 flex justify-end space-x-2">
        <a href="{{ route('admin.users.edit', $user->id) }}"
            class="px-4 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm">
            ✏️ Sửa
        </a>
        <a href="{{ route('admin.users.index') }}"
            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 text-sm">
            ⬅️ Quay lại
        </a>
    </div>
</div>
