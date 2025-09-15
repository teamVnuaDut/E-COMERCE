<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">➕ Tạo thanh toán mới</h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">📦 Đơn hàng</label>
                <select wire:model="order_id" class="w-full border rounded px-4 py-2">
                    <option value="">— Chọn đơn hàng —</option>
                    @foreach ($orders as $id => $label)
                    <option value="{{ $id }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('order_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">👤 Người dùng</label>
                <select wire:model="user_id" class="w-full border rounded px-4 py-2">
                    <option value="">— Chọn người dùng —</option>
                    @foreach ($users as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block font-medium">🔢 Mã thanh toán</label>
            <input type="text" wire:model="payment_number" class="w-full border rounded px-4 py-2">
            @error('payment_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">📌 Phương thức</label>
                <select wire:model="payment_method" class="w-full border rounded px-4 py-2">
                    <option value="cod">COD</option>
                    <option value="bank_transfer">Chuyển khoản</option>
                    <option value="momo">Momo</option>
                    <option value="vnpay">VNPAY</option>
                    <option value="credit_card">Thẻ tín dụng</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">📊 Trạng thái</label>
                <select wire:model="payment_status" class="w-full border rounded px-4 py-2">
                    <option value="pending">Chờ xử lý</option>
                    <option value="processing">Đang xử lý</option>
                    <option value="completed">Hoàn tất</option>
                    <option value="failed">Thất bại</option>
                    <option value="refunded">Đã hoàn trả</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">💰 Số tiền</label>
                <input type="number" wire:model="amount" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block font-medium">💸 Đã hoàn trả</label>
                <input type="number" wire:model="amount_refunded" class="w-full border rounded px-4 py-2">
            </div>
        </div>

        <div>
            <label class="block font-medium">📝 Ghi chú thanh toán</label>
            <textarea wire:model="payment_notes" rows="3" class="w-full border rounded px-4 py-2"></textarea>
        </div>

        <div>
            <label class="block font-medium">🛠️ Ghi chú quản trị viên</label>
            <textarea wire:model="admin_notes" rows="3" class="w-full border rounded px-4 py-2"></textarea>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.payment.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                🔙 Quay về danh sách
            </a>
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                💾 Lưu thanh toán
            </button>
        </div>
    </form>
</div>
