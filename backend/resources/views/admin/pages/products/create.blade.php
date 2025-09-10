@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1>Thêm sản phẩm mới</h1>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
