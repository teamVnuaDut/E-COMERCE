<div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto p-6 bg-white rounded-xl shadow">
    <div class="space-y-6">
        <h2 class="text-2xl font-bold text-gray-800">Sửa danh mục</h2>

        <form wire:submit.prevent="updateCategory" class="space-y-4" enctype="multipart/form-data">
            <div class="space-y-1">
                <label class="block font-medium text-gray-700">Tên danh mục</label>
                <input type="text" wire:model.defer="name" class="w-full border rounded px-4 py-2">
            </div>

            <div class="space-y-1">
                <label class="block font-medium text-gray-700">Slug</label>
                <input type="text" wire:model.defer="slug" class="w-full border rounded px-4 py-2">
            </div>


            <div>
                <label class="block font-medium mb-1">Mô tả</label>
                <textarea wire:model.defer="description" rows="3" class="w-full border rounded px-4 py-2"></textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Danh mục cha</label>
                <select wire:model.defer="parent_id" class="w-full border rounded px-4 py-2">
                    <option value="">— Không có —</option>
                    @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1">
                <label class="block font-medium text-gray-700">Thứ tự hiển thị</label>
                <input type="number" wire:model.defer="sort_order" class="w-full border rounded px-4 py-2">
            </div>


            <div>
                <label class="block font-medium mb-1">Trạng thái</label>
                <select wire:model.defer="status" class="w-full border rounded px-4 py-2">
                    <option value="active">Hoạt động</option>
                    <option value="inactive">Tạm ẩn</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Hình ảnh</label>
                <input type="file" wire:model="image" class="w-full border rounded px-4 py-2">
                @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded">
                @endif
            </div>

            <hr class="my-4">
            <h3 class="text-lg font-semibold text-gray-700">🔍 Metadata SEO</h3>
            <div class="space-y-1">
                <label class="block font-medium text-gray-700">Meta Title</label>
                <input type="text" wire:model.defer="meta_title" class="w-full border rounded px-4 py-2">
            </div>

            <div>
                <label class="block font-medium mb-1">Meta Description</label>
                <textarea wire:model.defer="meta_description" rows="2" class="w-full border rounded px-4 py-2"></textarea>
            </div>
            <div class="space-y-1">
                <label class="block font-medium text-gray-700">Meta Keywords</label>
                <input type="text" wire:model.defer="meta_keywords" class="w-full border rounded px-4 py-2">
            </div>


            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.category.index') }}"
                    class="px-5 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                    🔙 Quay về danh sách
                </a>

                <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    💾 Lưu danh mục
                </button>
            </div>
        </form>
    </div>

    <div class="bg-gray-50 p-4 rounded-lg shadow space-y-4">
        <h3 class="text-lg font-semibold text-gray-700">📋 Thông tin hiện tại</h3>
        <table class="w-full text-sm text-gray-700">
            <tr>
                <td class="font-medium w-1/3">Tên:</td>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <td class="font-medium">Slug:</td>
                <td>{{ $category->slug }}</td>
            </tr>
            <tr>
                <td class="font-medium">Mô tả:</td>
                <td>{{ $category->description ?? '—' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Danh mục cha:</td>
                <td>{{ $category->parent->name ?? '—' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Thứ tự:</td>
                <td>{{ $category->sort_order }}</td>
            </tr>
            <tr>
                <td class="font-medium">Trạng thái:</td>
                <td>
                    <span class="px-2 py-1 rounded-full text-xs
                        {{ $category->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="font-medium">Meta Title:</td>
                <td>{{ $category->meta_title ?? '—' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Meta Description:</td>
                <td>{{ $category->meta_description ?? '—' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Meta Keywords:</td>
                <td>{{ $category->meta_keywords ?? '—' }}</td>
            </tr>
            <tr>
                <td class="font-medium">Hình ảnh:</td>
                <td>
                    @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" class="w-24 h-24 object-cover rounded">
                    @else
                    <span class="text-gray-500">Không có</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

</div>
