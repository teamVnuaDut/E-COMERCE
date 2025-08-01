@extends('dashboard.layout.master')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Dashboard</h2>
    </div>
    
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-blue-600">Tổng sản phẩm</p>
                        <p class="text-2xl font-semibold text-blue-900">{{ $totalProducts ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-green-600">Tổng đơn hàng</p>
                        <p class="text-2xl font-semibold text-green-900">{{ $totalOrders ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-yellow-600">Tổng khách hàng</p>
                        <p class="text-2xl font-semibold text-yellow-900">{{ $totalCustomers ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-purple-600">Doanh thu</p>
                        <p class="text-2xl font-semibold text-purple-900">{{ number_format($totalRevenue ?? 0) }} VNĐ</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Orders -->
        <div class="bg-white border border-gray-200 rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Đơn hàng gần đây</h3>
            </div>
            <div class="p-6">
                @if(isset($recentOrders) && count($recentOrders) > 0)
                    <div class="space-y-4">
                        @foreach($recentOrders as $order)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">#{{ $order->order_number ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500">{{ $order->customer_name ?? 'N/A' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-900">{{ number_format($order->total_amount ?? 0) }} VNĐ</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at ? $order->created_at->format('d/m/Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Không có đơn hàng nào</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection