<div class="p-6 bg-white rounded-xl shadow text-gray-800 max-w-xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">✏️ Chỉnh sửa thông tin cá nhân</h2>

    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-4">
        <div>
            <label class="block font-medium mb-1">Tên</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2" disabled>
        </div>

        <div>
            <label class="block font-medium mb-1">Số điện thoại</label>
            <input type="text" wire:model="phone" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Địa chỉ</label>
            <textarea wire:model="address" class="w-full border rounded p-2"></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Ảnh đại diện</label>
            @if ($avatar)
            <img src="{{ asset('storage/' . $avatar) }}" class="w-16 h-16 rounded-full mb-2">
            @endif
            <input type="file" wire:model="newAvatar">
            @error('newAvatar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm bg-gray-50 p-4 rounded">
            <p>Vai trò: <span class="font-semibold capitalize">{{ $role }}</span></p>
            <p>Trạng thái: <span class="font-semibold capitalize">{{ $status }}</span></p>
            <p>Ngày tạo: <span class="font-semibold">{{ $created_at }}</span></p>
            <p>Cập nhật gần nhất: <span class="font-semibold">{{ $updated_at }}</span></p>
        </div>

        <button type="submit" class="px-4 py-2 bg-[#10b981] text-white rounded hover:bg-[#0f9a6d]">
            Lưu thay đổi
        </button>
    </form>
</div>
