<div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tạo Mới Danh Mục</h2>

        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="save">
            <!-- Tên danh mục -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Tên danh mục *</label>
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

            <!-- Danh mục cha -->
            <div class="mb-4">
                <label for="parent_id" class="block text-sm font-medium text-gray-700">Danh mục cha</label>
                <select wire:model="parent_id" id="parent_id"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Không có danh mục cha --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('parent_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Trạng thái -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái *</label>
                <select wire:model="status" id="status"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nút -->
            <div class="flex justify-end space-x-3">
                <button type="button" wire:click="cancel"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                    Hủy
                </button>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    Tạo Danh Mục
                </button>
            </div>
        </form>
    </div>
</div>