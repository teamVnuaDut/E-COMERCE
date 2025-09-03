<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">Quản lý danh mục</h2>
        <a href="{{ route('admin.category.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Thêm danh mục</a>
    </div>
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Danh mục sản phẩm</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Tên danh mục</th>
                    <th class="py-2 px-4 border-b">Danh mục cha</th>
                    <th class="py-2 px-4 border-b">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($categories) && $categories->count() > 0)
                @foreach ($categories as $category)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->parent ? $category->parent->name : 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="text-blue-500 hover:underline">Chỉnh sửa</a>
                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="py-2 px-4 border-b text-center">Không có sản phẩm nào.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>