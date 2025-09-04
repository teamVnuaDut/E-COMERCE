<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //index
    public function index()
    {
        $orders = Orders::with(['customer', 'user'])->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }


    //show
    public function show(Orders $order)
    {
        $order->load(['customer', 'user', 'items.product', 'promotion']);
        return view('admin.orders.show', compact('order'));
    }

    //edit
    public function edit(Orders $order)
    {
        $order->load(['customer', 'items.product']);
        $products = Products::where('status', 'active')->get();
        return view('admin.orders.edit', compact('order', 'products'));
    }

    //update
    public function update(Request $request, Orders $order)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'billing_address' => 'nullable|string',
            'admin_note' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Đơn hàng đã được cập nhật.');
    }

    //destroy
    public function destroy(Orders $order)
    {
        if (!in_array($order->status, ['pending', 'cancelled'])) {
            return redirect()->back()
                ->with('error', 'Chỉ có thể xóa đơn hàng ở trạng thái chờ xử lý hoặc đã hủy.');
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đơn hàng đã được xóa thành công.');
    }

    //update status
    public function updateStatus(Request $request, Orders $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,refunded'
        ]);

        $statusTimestamps = [
            'confirmed' => 'confirmed_at',
            'processing' => 'processing_at',
            'shipped' => 'shipped_at',
            'delivered' => 'delivered_at',
            'cancelled' => 'cancelled_at',
        ];

        $updateData = ['status' => $request->status];
        if (array_key_exists($request->status, $statusTimestamps)) {
            $updateData[$statusTimestamps[$request->status]] = now();
        }

        $order->update($updateData);

        return back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    //update payment
    public function updatePaymentStatus(Request $request, Orders $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $order->update(['payment_status' => $request->payment_status]);

        return back()->with('success', 'Trạng thái thanh toán đã được cập nhật.');
    }
}
