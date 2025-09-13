<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Cột trái: Form chỉnh sửa --}}
    <div class="bg-white p-6 rounded-xl shadow space-y-6">
        <h2 class="text-2xl font-bold text-gray-800">✏️ Chỉnh sửa thuộc tính</h2>

        <form wire:submit.prevent="save" class="space-y-4">
            <div>
                <label class="block font-medium">Tên thuộc tính</label>
                <input type="text" wire:model="attribute.name" class="w-full border rounded px-4 py-2">
                @error('attribute.name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Slug</label>
                <input type="text" wire:model="attribute.slug" class="w-full border rounded px-4 py-2">
                @error('attribute.slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Loại</label>
                <select wire:model="attribute.type" class="w-full border rounded px-4 py-2">
                    <option value="select">Select</option>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="color">Color</option>
                </select>
                @error('attribute.type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Mô tả</label>
                <textarea wire:model="attribute.description" rows="3" class="w-full border rounded px-4 py-2"></textarea>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="attribute.is_filterable">
                    <span>Lọc sản phẩm</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="attribute.is_visible">
                    <span>Hiển thị</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="attribute.is_required">
                    <span>Bắt buộc</span>
                </label>
            </div>

            <div>
                <label class="block font-medium">Thứ tự hiển thị</label>
                <input type="number" wire:model="attribute.sort_order" class="w-full border rounded px-4 py-2">
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.attribute.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                    🔙 Quay về danh sách
                </a>
                <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    💾 Cập nhật
                </button>
            </div>
        </form>
    </div>

    {{-- Cột phải: Bảng đối chiếu thông tin gốc --}}
    <div class="bg-gray-50 p-6 rounded-xl shadow space-y-4">
        <h2 class="text-xl font-bold text-gray-700">📋 Thông tin gốc</h2>
        <table class="w-full text-sm text-gray-700">
            <tr>
                <td class="font-medium w-1/3">Tên:</td>
                <td>{{ $attribute->getOriginal('name') }}</td>
            </tr>
            <tr>
                <td class="font-medium">Slug:</td>
                <td>{{ $attribute->getOriginal('slug') }}</td>
            </tr>
            <tr>
                <td class="font-medium">Loại:</td>
                <td>{{ ucfirst($attribute->getOriginal('type')) }}</td>
            </tr>
            <tr>
                <td class="font-medium">Mô tả:</td>
                <td>{{ $attribute->getOriginal('description') ?? '—' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Thứ tự:</td>
                <td>{{ $attribute->getOriginal('sort_order') }}</td>
            </tr>
            <tr>
                <td class="font-medium">Lọc:</td>
                <td>{{ $attribute->getOriginal('is_filterable') ? '✅' : '❌' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Hiển thị:</td>
                <td>{{ $attribute->getOriginal('is_visible') ? '✅' : '❌' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Bắt buộc:</td>
                <td>{{ $attribute->getOriginal('is_required') ? '✅' : '❌' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Tạo lúc:</td>
                <td>
                    <span class="px-2 py-1 rounded-full text-xs bg-gray-200 text-gray-800">
                        {{ $attribute->created_at->format('d/m/Y H:i') }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>
