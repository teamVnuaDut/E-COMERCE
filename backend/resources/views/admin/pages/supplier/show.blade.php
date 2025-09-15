@extends('admin.layouts.admin')

@section('title', 'Thông tin nhà cung cấp')

@section('content')
@livewire('admin.pages.supplier.show', ['supplier' => $supplier])
@endsection
