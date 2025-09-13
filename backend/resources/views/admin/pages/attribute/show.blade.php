@extends('admin.layouts.admin')

@section('title', 'Thuộc tính hiện tại')

@section('content')
@livewire('admin.pages.attribute.show', ['attribute' => $attribute])
@endsection
