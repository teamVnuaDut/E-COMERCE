<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Shipping extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'shipping_number',
        'shipping_method',
        'shipping_status',
        'shipping_cost',
        'shipping_weight',
        'carrier_name',
        'carrier_code',
        'tracking_number',
        'tracking_url',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'receiver_city',
        'receiver_district',
        'receiver_ward',
        'receiver_postal_code',
        'estimated_delivery_date',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
        'delivery_notes',
        'carrier_notes',
        'admin_notes'
    ];

    protected $casts = [
        'shipping_cost' => 'decimal:2',
        'shipping_weight' => 'decimal:2',
        'estimated_delivery_date' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];

    // Tạo shipping number tự động
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shipping) {
            if (empty($shipping->shipping_number)) {
                $shipping->shipping_number = static::generateShippingNumber();
            }
        });
    }

    // Generate shipping number
    public static function generateShippingNumber(): string
    {
        $prefix = 'SHIP-' . date('Ymd') . '-';
        $lastShipping = static::where('shipping_number', 'like', $prefix . '%')
            ->orderBy('shipping_number', 'desc')
            ->first();

        if ($lastShipping) {
            $lastNumber = (int) str_replace($prefix, '', $lastShipping->shipping_number);
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

    // Cập nhật trạng thái vận chuyển
    public function updateStatus(string $status, array $data = []): bool
    {
        $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'];

        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $this->shipping_status = $status;

        // Cập nhật timestamps và dữ liệu
        switch ($status) {
            case 'shipped':
                $this->shipped_at = now();
                $this->carrier_name = $data['carrier_name'] ?? $this->carrier_name;
                $this->carrier_code = $data['carrier_code'] ?? $this->carrier_code;
                $this->tracking_number = $data['tracking_number'] ?? $this->tracking_number;
                $this->tracking_url = $data['tracking_url'] ?? $this->tracking_url;
                break;

            case 'delivered':
                $this->delivered_at = now();
                break;

            case 'cancelled':
                $this->cancelled_at = now();
                break;
        }

        return $this->save();
    }

    // Tính ngày dự kiến giao hàng
    public function calculateEstimatedDelivery(): void
    {
        $shippingDays = match ($this->shipping_method) {
            'express' => 1,
            'fast' => 2,
            'standard' => 3,
            'pickup' => 0,
            default => 3
        };

        if ($shippingDays > 0) {
            $this->estimated_delivery_date = now()->addDays($shippingDays);
        } else {
            $this->estimated_delivery_date = now();
        }

        $this->save();
    }

    // Kiểm tra đã giao hàng
    public function isDelivered(): bool
    {
        return $this->shipping_status === 'delivered';
    }

    // Kiểm tra đang vận chuyển
    public function isShipped(): bool
    {
        return $this->shipping_status === 'shipped';
    }

    // Kiểm tra đã hủy
    public function isCancelled(): bool
    {
        return $this->shipping_status === 'cancelled';
    }

    // Kiểm tra trễ hẹn
    public function isDelayed(): bool
    {
        if (!$this->estimated_delivery_date || $this->isDelivered() || $this->isCancelled()) {
            return false;
        }

        return now()->gt($this->estimated_delivery_date);
    }

    // Lấy số ngày trễ
    public function getDelayDaysAttribute(): int
    {
        if (!$this->isDelayed()) {
            return 0;
        }

        return now()->diffInDays($this->estimated_delivery_date);
    }

    // Scope: Vận chuyển theo trạng thái
    public function scopeStatus($query, $status)
    {
        return $query->where('shipping_status', $status);
    }

    // Scope: Vận chuyển đã giao
    public function scopeDelivered($query)
    {
        return $query->where('shipping_status', 'delivered');
    }

    // Scope: Vận chuyển theo phương thức
    public function scopeShippingMethod($query, $method)
    {
        return $query->where('shipping_method', $method);
    }

    // Scope: Vận chuyển trễ hẹn
    public function scopeDelayed($query)
    {
        return $query->where('estimated_delivery_date', '<', now())
            ->whereNotIn('shipping_status', ['delivered', 'cancelled']);
    }
}
