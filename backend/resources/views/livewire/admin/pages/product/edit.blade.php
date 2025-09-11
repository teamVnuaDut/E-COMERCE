<div class="bg-white p-6 rounded-2xl shadow">
    <h2 class="text-xl font-semibold mb-4">✏️ Chỉnh sửa sản phẩm</h2>

    @if (session()->has('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label class="block font-medium">Tên sản phẩm</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">SKU</label>
            <input type="text" wire:model="sku" class="w-full border rounded p-2">
            @error('sku') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Giá</label>
                <input type="number" wire:model="price" class="w-full border rounded p-2">
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium">Giá Sale</label>
                <input type="number" wire:model="sale_price" class="w-full border rounded p-2">
                @error('sale_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block font-medium">Số lượng tồn kho</label>
            <input type="number" wire:model="stock_quantity" class="w-full border rounded p-2">
            @error('stock_quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Trạng thái</label>
            <select wire:model="status" class="w-full border rounded p-2">
                <option value="active">Hoạt động</option>
                <option value="inactive">Ngừng kinh doanh</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.product.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Hủy</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Cập nhật</button>
        </div>
    </form>
</div>
