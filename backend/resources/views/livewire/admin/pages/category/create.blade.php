<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">➕ Tạo danh mục mới</h2>

    <form wire:submit.prevent="createCategory" class="space-y-4" enctype="multipart/form-data">
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


        <div class="flex justify-end">
            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                💾 Lưu danh mục
            </button>
        </div>
    </form>
</div>
