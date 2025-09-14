<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">➕ Thêm thuộc tính</h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block font-medium">Tên thuộc tính</label>
            <input type="text" wire:model="name" class="w-full border rounded px-4 py-2">
        </div>

        <select wire:model="slug" class="w-full border rounded px-4 py-2">
            <option value="">— Chọn slug từ danh mục —</option>
            @foreach ($availableSlugs as $slug)
            <option value="{{ $slug }}">{{ $slug }}</option>
            @endforeach
        </select>

        <div>
            <label class="block font-medium">Loại</label>
            <select wire:model="type" class="w-full border rounded px-4 py-2">
                <option value="select">Select</option>
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="color">Color</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Mô tả</label>
            <textarea wire:model="description" rows="3" class="w-full border rounded px-4 py-2"></textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" wire:model="is_filterable">
                <span>Lọc sản phẩm</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" wire:model="is_visible">
                <span>Hiển thị</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" wire:model="is_required">
                <span>Bắt buộc</span>
            </label>
        </div>

        <div>
            <label class="block font-medium">Thứ tự hiển thị</label>
            <input type="number" wire:model="sort_order" class="w-full border rounded px-4 py-2">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.attribute.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                🔙 Quay về danh sách
            </a>
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                💾 Lưu thuộc tính
            </button>
        </div>
    </form>
</div>
