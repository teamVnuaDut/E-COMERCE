<div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">➕ Tạo người dùng mới</h2>

    <form wire:submit.prevent="createUser" class="space-y-4" autocomplete="off">
        <div>
            <label class="block font-medium">Tên</label>
            <input type="text" wire:model.defer="name" class="w-full border px-4 py-2 rounded">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" wire:model.defer="email" name="new-email" class="w-full border px-4 py-2 rounded" autocomplete="off">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Mật khẩu</label>
            <input type="password" wire:model.defer="password" name="new-password" class="w-full border px-4 py-2 rounded" autocomplete="off">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">SĐT</label>
            <input type="text" wire:model.defer="phone" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Địa chỉ</label>
            <input type="text" wire:model.defer="address" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Vai trò</label>
            <select wire:model.defer="role" class="w-full border px-4 py-2 rounded">
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Trạng thái</label>
            <select wire:model.defer="status" class="w-full border px-4 py-2 rounded">
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Avatar</label>
            <input type="file" wire:model="avatar" class="w-full">
            @error('avatar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($avatar)
            <img src="{{ $avatar->temporaryUrl() }}" class="w-16 h-16 rounded-full mt-2">
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                ✅ Tạo người dùng
            </button>
        </div>
    </form>
</div>
