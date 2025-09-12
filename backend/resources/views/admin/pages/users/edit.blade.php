@extends('admin.layouts.admin')

@section('title', 'Sửa thông tin người dùng')

@section('content')
@livewire('admin.pages.users.edit', ['id' => $id])
@endsection
