<div>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price) }} VNĐ</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <button wire:click="deleteProduct({{ $product->id }})" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
