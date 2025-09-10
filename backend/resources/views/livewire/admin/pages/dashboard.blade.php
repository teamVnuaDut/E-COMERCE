@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Admin Dashboard</h1>
        <p>Xin chào, {{ auth()->user()->name }}!</p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng sản phẩm</h5>
                        <h3>{{ $totalProducts }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng users</h5>
                        <h3>{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quản lý sản phẩm</a>
        </div>
    </div>
</div>
@endsection
