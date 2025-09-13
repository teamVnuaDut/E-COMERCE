@extends('admin.layouts.admin')

@section('title', 'Thông tin danh mục hiện tại')

@section('content')
@livewire('admin.pages.category.show', ['category'=>$category])
@endsection
