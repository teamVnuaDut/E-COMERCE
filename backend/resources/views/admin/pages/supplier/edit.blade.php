@extends('admin.layouts.admin')

@section('title', 'Chỉnh sửa thông tin nhà cung cấp')

@section('content')
@livewire('admin.pages.supplier.edit', ['supplier' => $supplier])
@endsection
