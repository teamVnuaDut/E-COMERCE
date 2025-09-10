<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'payment_number',
        'payment_method',
        'payment_status',
        'amount',
        'amount_refunded',
        'transaction_id',
        'transaction_code',
        'transaction_data',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'bank_transfer_content',
        'card_number',
        'card_holder_name',
        'card_expiry_date',
        'card_cvv',
        'paid_at',
        'refunded_at',
        'failed_at',
        'payment_notes',
        'admin_notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'amount_refunded' => 'decimal:2',
        'transaction_data' => 'array',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
        'failed_at' => 'datetime'
    ];

    // Tạo payment number tự động
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->payment_number)) {
                $payment->payment_number = static::generatePaymentNumber();
            }

            if (empty($payment->transaction_code)) {
                $payment->transaction_code = Str::random(16);
            }
        });
    }

    // Generate payment number
    public static function generatePaymentNumber(): string
    {
        $prefix = 'PAY-' . date('Ymd') . '-';
        $lastPayment = static::where('payment_number', 'like', $prefix . '%')
            ->orderBy('payment_number', 'desc')
            ->first();

        if ($lastPayment) {
            $lastNumber = (int) str_replace($prefix, '', $lastPayment->payment_number);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return $prefix . $nextNumber;
    }

    // Quan hệ: Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ: User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Cập nhật trạng thái thanh toán
    public function updateStatus(string $status, array $data = []): bool
    {
        $validStatuses = ['pending', 'processing', 'completed', 'failed', 'refunded'];

        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $this->payment_status = $status;

        // Cập nhật timestamps và dữ liệu
        switch ($status) {
            case 'completed':
                $this->paid_at = now();
                $this->transaction_id = $data['transaction_id'] ?? $this->transaction_id;
                $this->transaction_data = $data['transaction_data'] ?? $this->transaction_data;
                break;

            case 'failed':
                $this->failed_at = now();
                $this->transaction_data = $data['transaction_data'] ?? $this->transaction_data;
                break;

            case 'refunded':
                $this->refunded_at = now();
                $this->amount_refunded = $data['amount_refunded'] ?? $this->amount;
                break;
        }

        return $this->save();
    }

    // Hoàn tiền
    public function refund(float $amount = null): bool
    {
        if ($this->payment_status !== 'completed') {
            return false;
        }

        $refundAmount = $amount ?? $this->amount;

        if ($refundAmount > $this->amount - $this->amount_refunded) {
            return false;
        }

        $this->amount_refunded += $refundAmount;

        if ($this->amount_refunded >= $this->amount) {
            $this->payment_status = 'refunded';
            $this->refunded_at = now();
        }

        return $this->save();
    }

    // Kiểm tra đã thanh toán
    public function isPaid(): bool
    {
        return $this->payment_status === 'completed';
    }

    // Kiểm tra đã hoàn tiền
    public function isRefunded(): bool
    {
        return $this->payment_status === 'refunded';
    }

    // Kiểm tra thất bại
    public function isFailed(): bool
    {
        return $this->payment_status === 'failed';
    }

    // Kiểm tra có thể hoàn tiền
    public function canBeRefunded(): bool
    {
        return $this->isPaid() &&
            $this->amount_refunded < $this->amount &&
            $this->paid_at->diffInDays(now()) <= 30; // Trong vòng 30 ngày
    }

    // Lấy số tiền còn lại có thể hoàn
    public function getRefundableAmountAttribute(): float
    {
        return $this->amount - $this->amount_refunded;
    }

    // Scope: Thanh toán theo trạng thái
    public function scopeStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    // Scope: Thanh toán đã hoàn thành
    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }

    // Scope: Thanh toán theo phương thức
    public function scopePaymentMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }
}
