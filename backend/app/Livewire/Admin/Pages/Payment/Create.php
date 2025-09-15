<?php

namespace App\Livewire\Admin\Pages\Payment;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $order_id;
    public $user_id;
    public $payment_number;
    public $payment_method = 'cod';
    public $payment_status = 'pending';
    public $amount = 0;
    public $amount_refunded = 0;

    public $transaction_id;
    public $transaction_code;
    public $transaction_data;

    public $bank_name;
    public $bank_account_number;
    public $bank_account_name;
    public $bank_transfer_content;

    public $card_number;
    public $card_holder_name;
    public $card_expiry_date;
    public $card_cvv;

    public $paid_at;
    public $refunded_at;
    public $failed_at;

    public $payment_notes;
    public $admin_notes;

    public function rules()
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'user_id' => 'required|exists:users,id',
            'payment_number' => 'required|string|unique:payments,payment_number',
            'payment_method' => 'required|in:cod,bank_transfer,momo,vnpay,credit_card',
            'payment_status' => 'required|in:pending,processing,completed,failed,refunded',
            'amount' => 'required|numeric|min:0',
            'amount_refunded' => 'nullable|numeric|min:0',
            'transaction_id' => 'nullable|string',
            'transaction_code' => 'nullable|string',
            'transaction_data' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'bank_account_name' => 'nullable|string',
            'bank_transfer_content' => 'nullable|string',
            'card_number' => 'nullable|string',
            'card_holder_name' => 'nullable|string',
            'card_expiry_date' => 'nullable|string',
            'card_cvv' => 'nullable|string',
            'paid_at' => 'nullable|date',
            'refunded_at' => 'nullable|date',
            'failed_at' => 'nullable|date',
            'payment_notes' => 'nullable|string',
            'admin_notes' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();
        Payment::create($this->only(array_keys($this->rules)));

        session()->flash('Success', '✅ Đã tạo phương thức thanh toán mới!');
        return redirect()->route('admin.payment.index');
    }

    public function render()
    {
        $orders = Order::pluck('id', 'id');
        $users = User::pluck('name', 'id');
        return view('livewire.admin.pages.payment.create', compact('orders', 'users'));
    }
}
