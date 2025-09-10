@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1>Quản lý sản phẩm</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>

    <!-- Sử dụng Livewire component -->
    @livewire('admin.components.product-list')
</div>
@endsection
