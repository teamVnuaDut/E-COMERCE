<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::with('user')->get();

        foreach ($orders as $order) {
            $paymentStatus = $order->payment_status;
            $paymentMethod = $order->payment_method;

            $paidAt = null;
            $failedAt = null;

            if ($paymentStatus === 'paid') {
                $paidAt = $order->paid_at ?? now()->subDays(rand(1, 10));
            } elseif ($paymentStatus === 'failed') {
                $failedAt = now()->subDays(rand(1, 5));
            }

            Payment::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'payment_number' => Payment::generatePaymentNumber(),
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus === 'paid' ? 'completed' : ($paymentStatus === 'failed' ? 'failed' : 'pending'),
                'amount' => $order->grand_total,
                'transaction_id' => $paymentStatus === 'paid' ? 'TXN' . Str::random(10) : null,
                'transaction_code' => 'TC' . Str::random(12),
                'paid_at' => $paidAt,
                'failed_at' => $failedAt,
                'bank_name' => in_array($paymentMethod, ['bank_transfer', 'credit_card']) ? 'Vietcombank' : null,
                'bank_account_number' => in_array($paymentMethod, ['bank_transfer', 'credit_card']) ? '1234567890' : null,
                'bank_account_name' => in_array($paymentMethod, ['bank_transfer', 'credit_card']) ? $order->customer_name : null,
            ]);
        }
    }
}
