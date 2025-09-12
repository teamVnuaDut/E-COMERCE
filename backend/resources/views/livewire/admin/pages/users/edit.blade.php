<div class="p-6 bg-white rounded-xl shadow max-w-xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">✏️ Sửa thông tin người dùng</h2>

    <form wire:submit.prevent="updateUser" class="space-y-4">
        @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div>
            <label class="block font-medium mb-1">Tên</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Mật khẩu mới</label>
            <label class="block font-medium mb-1">Password</label>
            <input type="password" wire:model="password" class="w-full border rounded p-2">
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
            <label class="block font-medium mb-1">Vai trò</label>
            <select wire:model="role" class="w-full border rounded p-2">
                <option value="">---------</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="staff">Staff</option>
                <option value="customer">Customer</option>
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Trạng thái</label>
            <select wire:model="status" class="w-full border rounded p-2">
                <option value="">---------</option>
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Ảnh đại diện</label>
            @if ($avatar)
            <img src="{{ asset('storage/' . $avatar) }}" class="w-16 h-16 rounded-full mb-2">
            @endif
            <input type="file" wire:model="newAvatar">
            @error('newAvatar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            💾 Lưu thay đổi
        </button>
    </form>
</div>
