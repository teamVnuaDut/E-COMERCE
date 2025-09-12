@extends('admin.layouts.admin')

@section('title', 'Thông tin người dùng')

@section('content')
@livewire('admin.pages.users.show', ['id' => $id])
@endsection
