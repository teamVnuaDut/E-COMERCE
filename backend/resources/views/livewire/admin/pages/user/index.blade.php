<div class="p-6 rounded-xl shadow bg-gradient-to-br from-[#3e2723] to-[#5d4037] text-white">
    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition.duration.500ms
        class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded shadow">
        {{ session('success') }}
        <button @click="show = false" class="float-right text-sm text-green-600 hover:underline">Đóng</button>
    </div>
    @endif

    <h2 class="text-2xl font-bold mb-4">👋 Xin chào, {{ $user->name }}</h2>

    <div class="flex items-center gap-4 mb-4">
        @if ($user->avatar)
        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-16 h-16 rounded-full object-cover border-2 border-white">
        @else
        <div class="w-16 h-16 rounded-full bg-white text-[#3e2723] flex items-center justify-center font-bold">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        @endif
        <div>
            <p class="text-sm">Email: <span class="font-medium">{{ $user->email }}</span></p>
            <p class="text-sm">Số điện thoại: <span class="font-medium">{{ $user->phone ?? 'Chưa cập nhật' }}</span></p>
            <p class="text-sm">Xác thực email:
                <span class="font-medium">
                    {{ $user->email_verified_at ? '✅ Đã xác thực' : '❌ Chưa xác thực' }}
                </span>
            </p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
        <p>Vai trò: <span class="font-semibold capitalize">{{ $user->role }}</span></p>
        <p>Trạng thái: <span class="font-semibold capitalize">{{ $user->status }}</span></p>
        <p>Quyền hạn: <span class="font-semibold">{{ $user->role }}</span></p>
        <p>Địa chỉ: <span class="font-semibold">{{ $user->address ?? 'Chưa cập nhật' }}</span></p>
        <p>Ngày tạo: <span class="font-semibold">{{ $user->created_at->format('d/m/Y H:i') }}</span></p>
        <p>Cập nhật gần nhất: <span class="font-semibold">{{ $user->updated_at->format('d/m/Y H:i') }}</span></p>
        @if ($user->deleted_at)
        <p class="col-span-2 text-red-300">⚠️ Tài khoản đã bị xóa mềm lúc {{ $user->deleted_at->format('d/m/Y H:i') }}</p>
        @endif
    </div>

    <a href="{{ route('admin.user.edit') }}"
        class="inline-block px-4 py-2 bg-[#10b981] text-white font-semibold rounded hover:bg-[#0f9a6d] transition">
        ✏️ Chỉnh sửa thông tin
    </a>
</div>
