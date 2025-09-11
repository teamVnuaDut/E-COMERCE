<div class="bg-white p-6 rounded-2xl shadow">
    <h2 class="text-xl font-semibold mb-4">➕ Tạo mới sản phẩm</h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block font-medium">Tên sản phẩm</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Slug</label>
            <input type="text" wire:model="slug" class="w-full border rounded p-2">
            @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">SKU</label>
            <input type="text" wire:model="sku" class="w-full border rounded p-2">
            @error('sku') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Danh mục</label>
            <select wire:model="category_id" class="w-full border rounded p-2">
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Giá</label>
            <input type="number" wire:model="price" class="w-full border rounded p-2">
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Trạng thái</label>
            <select wire:model="status" class="w-full border rounded p-2">
                <option value="draft">Bản nháp</option>
                <option value="pending">Chờ duyệt</option>
                <option value="published">Đã xuất bản</option>
                <option value="archived">Lưu trữ</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.product.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Hủy</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lưu</button>
        </div>
    </form>
</div>
