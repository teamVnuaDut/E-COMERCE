<div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Chỉnh Sửa Sản Phẩm</h2>

        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="update">
            <!-- Tên sản phẩm -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm *</label>
                <input type="text" wire:model="name" id="name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Mô tả *</label>
                <textarea wire:model="description" id="description" rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Giá và Số lượng -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Giá (VND) *</label>
                    <input type="number" wire:model="price" id="price" step="0.01"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Số lượng *</label>
                    <input type="number" wire:model="stock_quantity" id="stock_quantity"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('stock_quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Danh mục và Trạng thái -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục *</label>
                    <select wire:model="category_id" id="category_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái *</label>
                    <select wire:model="status" id="status"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Hình ảnh -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh mới</label>
                <input type="file" wire:model="image" id="image"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if ($image)
                <div class="mt-2">
                    <p class="text-sm text-gray-500">Ảnh xem trước:</p>
                    <img src="{{ $image->temporaryUrl() }}" class="w-32 h-32 object-cover rounded mt-2">
                </div>
                @endif

                <!-- Hiển thị ảnh hiện tại -->
                @if ($existingImage)
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Ảnh hiện tại:</p>
                    <div class="flex items-center mt-2">
                        <img src="{{ $existingImage }}" class="w-32 h-32 object-cover rounded">
                        <button type="button" wire:click="removeImage"
                            class="ml-4 bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                            Xóa ảnh
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Nút -->
            <div class="flex justify-end space-x-3">
                <button type="button" wire:click="cancel"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                    Hủy
                </button>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    Cập Nhật Sản Phẩm
                </button>
            </div>
        </form>
    </div>

    <!-- Loading Indicator -->
    <div wire:loading wire:target="image" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-4 rounded-lg">
            <p>Đang tải lên hình ảnh...</p>
        </div>
    </div>
</div>