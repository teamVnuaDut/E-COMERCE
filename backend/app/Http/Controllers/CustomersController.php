<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //index
    public function index()
    {
        $customers = Customer::with('user')->paginate(20);
        return view('admin.customer.index', compact('customer'));
    }

    //create
    public function create()
    {
        return view('admin.customer.create');
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'required|string|unique:customers,phone',
            'address' => 'required|string',
            'type' => 'required|in:individual,business',
            'status' => 'required|in:active,inactive,banned',
        ]);

        Customer::create($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Khách hàng đã được tạo thành công.');
    }

    //show
    public function show(Customer $customer)
    {
        $customer->load('orders.items.product');
        return view('admin.customers.show', compact('customer'));
    }

    //edit customer
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    //update customer
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|unique:customers,phone,' . $customer->id,
            'address' => 'required|string',
            'type' => 'required|in:individual,business',
            'status' => 'required|in:active,inactive,banned',
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Thông tin khách hàng đã được cập nhật.');
    }

    //destroy
    public function destroy(Customer $customer)
    {
        if ($customer->orders()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Không thể xóa khách hàng vì có đơn hàng liên quan.');
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Khách hàng đã được xóa thành công.');
    }

    //orders
    public function orders(Customer $customer)
    {
        $orders = $customer->orders()->with('items.product')->paginate(10);
        return view('admin.customers.orders', compact('customer', 'orders'));
    }

    //updatestatus
    public function updateStatus(Request $request, Customer $customer)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,banned'
        ]);

        $customer->update(['status' => $request->status]);

        return back()->with('success', 'Trạng thái khách hàng đã được cập nhật.');
    }
}
