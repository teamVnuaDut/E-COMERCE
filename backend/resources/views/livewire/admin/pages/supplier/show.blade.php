<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow space-y-8">
    <!-- Tiêu đề + nút -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">📋 Chi tiết nhà cung cấp</h2>

        <div class="space-x-2">
            <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm">
                ✏️ Chỉnh sửa
            </a>
            <a href="{{ route('admin.supplier.index') }}"
                class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 transition text-sm">
                🔙 Quay về danh sách
            </a>
        </div>
    </div>

    <!-- Nhóm thông tin có thể thu gọn -->
    <div class="space-y-4">
        <!-- Thông tin liên hệ -->
        <div class="border rounded-lg shadow-sm">
            <button onclick="toggleSection('contact-info')" class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 font-medium text-sm">
                📞 Thông tin liên hệ
            </button>
            <div id="contact-info" class="px-6 py-4 space-y-2 text-sm">
                <div><strong>📛 Tên:</strong> {{ $supplier->name }}</div>
                <div><strong>🔢 Mã:</strong> {{ $supplier->code }}</div>
                <div><strong>👤 Người liên hệ:</strong> {{ $supplier->contact_person ?? '—' }}</div>
                <div><strong>📧 Email:</strong> {{ $supplier->email ?? '—' }}</div>
                <div><strong>📞 Điện thoại:</strong> {{ $supplier->formatted_phone ?? $supplier->phone ?? '—' }}</div>
            </div>
        </div>

        <!-- Địa chỉ & thuế -->
        <div class="border rounded-lg shadow-sm">
            <button onclick="toggleSection('address-info')" class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 font-medium text-sm">
                🏠 Địa chỉ & Thuế
            </button>
            <div id="address-info" class="px-6 py-4 space-y-2 text-sm">
                <div><strong>🏠 Địa chỉ:</strong> {{ $supplier->address ?? '—' }}</div>
                <div><strong>💼 Mã số thuế:</strong> {{ $supplier->tax_code ?? '—' }}</div>
            </div>
        </div>

        <!-- Thanh toán -->
        <div class="border rounded-lg shadow-sm">
            <button onclick="toggleSection('payment-info')" class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 font-medium text-sm">
                💳 Thông tin thanh toán
            </button>
            <div id="payment-info" class="px-6 py-4 space-y-2 text-sm">
                <div><strong>🏦 Ngân hàng:</strong> {{ $supplier->bank_name ?? '—' }}</div>
                <div><strong>🔢 Số tài khoản:</strong> {{ $supplier->bank_account_number ?? '—' }}</div>
                <div><strong>👤 Chủ tài khoản:</strong> {{ $supplier->bank_account_name ?? '—' }}</div>
            </div>
        </div>

        <!-- Trạng thái & ghi chú -->
        <div class="border rounded-lg shadow-sm">
            <button onclick="toggleSection('status-info')" class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 font-medium text-sm">
                📌 Trạng thái & Ghi chú
            </button>
            <div id="status-info" class="px-6 py-4 space-y-2 text-sm">
                <div>
                    <strong>📌 Trạng thái:</strong>
                    <span class="inline-block px-2 py-1 text-xs rounded-full
            {{ $supplier->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $supplier->status === 'active' ? 'Hoạt động' : 'Ngừng hoạt động' }}
                    </span>
                </div>
                <div>
                    <strong>📝 Ghi chú:</strong>
                    <p class="text-gray-600 italic mt-1">{{ $supplier->notes ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
