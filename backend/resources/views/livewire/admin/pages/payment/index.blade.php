<div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">💳 Danh sách thanh toán</h2>

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
        <input type="text" wire:model.debounce.500ms="search"
            placeholder="🔍 Tìm theo mã thanh toán hoặc giao dịch..."
            class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <a href="{{ route('admin.payment.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            ➕ Tạo thanh toán
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="p-4">🔢 Mã thanh toán</th>
                    <th class="p-4">👤 Người dùng</th>
                    <th class="p-4">💰 Số tiền</th>
                    <th class="p-4">📌 Phương thức</th>
                    <th class="p-4">📊 Trạng thái</th>
                    <th class="p-4">🕒 Thời gian</th>
                    <th class="p-4 text-center">⚙️ Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-900">{{ $payment->payment_number }}</td>
                    <td class="p-4 text-gray-700">{{ $payment->user->name ?? '—' }}</td>
                    <td class="p-4 text-gray-900">{{ number_format($payment->amount, 0, ',', '.') }}₫</td>
                    <td class="p-4 text-gray-600">{{ strtoupper($payment->payment_method) }}</td>
                    <td class="p-4">
                        <span class="inline-block px-2 py-1 text-xs rounded-full
                                @switch($payment->payment_status)
                                    @case('completed') bg-green-100 text-green-700 @break
                                    @case('failed') bg-red-100 text-red-700 @break
                                    @case('refunded') bg-yellow-100 text-yellow-800 @break
                                    @default bg-gray-100 text-gray-600
                                @endswitch">
                            {{ ucfirst($payment->payment_status) }}
                        </span>
                    </td>
                    <td class="p-4 text-sm text-gray-600">
                        {{ $payment->paid_at ? $payment->paid_at->format('d/m/Y H:i') : '—' }}
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-3 text-sm">
                            <a href="{{ route('admin.payment.show', $payment->id) }}"
                                class="text-gray-600 hover:text-indigo-600 transition">👁️</a>
                            <a href="{{ route('admin.payment.edit', $payment->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition">✏️</a>
                            <button wire:click="confirmDelete({{ $payment->id }})"
                                class="text-red-600 hover:text-red-800 transition">🗑️</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-500">Không có bản ghi thanh toán nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $payments->links() }}
    </div>
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">⚠️ Xác nhận xoá</h3>
            <p class="text-sm text-gray-600 mb-6">Bạn có chắc muốn xoá chức năng thanh toán này không?</p>
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
