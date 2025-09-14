<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">➕ Tạo nhà cung cấp mới</h2>

    <form wire:submit.prevent="save" class="space-y-6">

        <!-- Thông tin cơ bản -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📛 Tên nhà cung cấp</label>
                <input type="text" wire:model="form.name" class="w-full border rounded px-4 py-2">
                @error('form.name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🔢 Mã nhà cung cấp</label>
                <input type="text" wire:model="form.code" class="w-full border rounded px-4 py-2">
                @error('form.name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Liên hệ -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">👤 Người liên hệ</label>
                <input type="text" wire:model="form.contact_person" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📧 Email</label>
                <input type="email" wire:model="form.email" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📞 Điện thoại</label>
                <input type="text" wire:model="form.phone" class="w-full border rounded px-4 py-2">
            </div>
        </div>

        <!-- Địa chỉ & thuế -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🏠 Địa chỉ</label>
                <textarea wire:model="form.address" rows="2" class="w-full border rounded px-4 py-2 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">💼 Mã số thuế</label>
                <input type="text" wire:model="form.tax_code" class="w-full border rounded px-4 py-2">
            </div>
        </div>

        <!-- Thanh toán -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🏦 Ngân hàng</label>
                <input type="text" wire:model="form.bank_name" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🔢 Số tài khoản</label>
                <input type="text" wire:model="form.bank_account_number" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">👤 Chủ tài khoản</label>
                <input type="text" wire:model="form.bank_account_name" class="w-full border rounded px-4 py-2">
            </div>
        </div>

        <!-- Trạng thái & ghi chú -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📌 Trạng thái</label>
                <select wire:model="form.status" class="w-full border rounded px-4 py-2">
                    <option value="">— Chọn trạng thái —</option>
                    <option value="active">Hoạt động</option>
                    <option value="inactive">Ngừng hoạt động</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📝 Ghi chú</label>
                <textarea wire:model="form.notes" rows="2" class="w-full border rounded px-4 py-2 resize-none"></textarea>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="flex justify-end gap-3 pt-6 border-t">
            <a href="{{ route('admin.supplier.index') }}"
                class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 transition">
                🔙 Quay về danh sách
            </a>
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                💾 Lưu nhà cung cấp
            </button>
        </div>
    </form>
</div>
