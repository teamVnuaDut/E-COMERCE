@extends('admin.layouts.admin')

@section('title', 'Thông tin sản phẩm')

@section('content')
@livewire('admin.pages.product.show',['product' => $product])
@endsection
