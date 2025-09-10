<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'cart_id',
        'coupon_id',
        'order_number',
        'status',
        'subtotal',
        'discount_amount',
        'coupon_discount',
        'tax_amount',
        'shipping_amount',
        'grand_total',
        'coupon_code',
        'customer_email',
        'customer_phone',
        'customer_name',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_district',
        'shipping_ward',
        'payment_method',
        'payment_status',
        'paid_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
        'customer_notes',
        'admin_notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];

    // Tạo order number tự động
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    // Generate order number
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD-' . date('Ymd') . '-';
        $lastOrder = static::where('order_number', 'like', $prefix . '%')
            ->orderBy('order_number', 'desc')
            ->first();

        if ($lastOrder) {
            $lastNumber = (int) str_replace($prefix, '', $lastOrder->order_number);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return $prefix . $nextNumber;
    }

    // Quan hệ: User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Cart
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    // Quan hệ: Coupon
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    // Quan hệ: Order items
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Thêm vào class Order

    // Thêm item vào đơn hàng
    public function addItem(array $itemData): OrderItem
    {
        $item = new OrderItem($itemData);
        $this->items()->save($item);

        $this->calculateTotals();

        return $item;
    }

    // Tính toán lại tổng tiền đơn hàng
    public function calculateTotals(): void
    {
        $subtotal = 0;
        $discountAmount = 0;

        foreach ($this->items as $item) {
            $subtotal += $item->subtotal;
            $discountAmount += $item->discount_amount * $item->quantity;
        }

        $this->subtotal = $subtotal;
        $this->discount_amount = $discountAmount;

        // Tính grand total
        $this->grand_total = $this->subtotal
            - $this->discount_amount
            - $this->coupon_discount
            + $this->tax_amount
            + $this->shipping_amount;

        $this->save();
    }

    // Lấy tổng số lượng sản phẩm
    public function getTotalQuantityAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    // Kiểm tra tất cả items đã được giao
    public function allItemsDelivered(): bool
    {
        return $this->items()->where('status', '!=', 'delivered')->doesntExist();
    }

    // Kiểm tra có items nào bị hủy
    public function hasCancelledItems(): bool
    {
        return $this->items()->where('status', 'cancelled')->exists();
    }

    // Kiểm tra có items nào được trả hàng
    public function hasReturnedItems(): bool
    {
        return $this->items()->where('status', 'returned')->exists();
    }

    // Quan hệ: Payment
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    // Quan hệ: Shipping
    public function shipping(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }

    // Kiểm tra có thể hủy đơn
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed']) &&
            $this->payment_status !== 'paid';
    }

    // Kiểm tra có thể trả hàng
    public function canBeRefunded(): bool
    {
        return $this->status === 'delivered' &&
            $this->payment_status === 'paid' &&
            $this->delivered_at->diffInDays(now()) <= 7; // Trong vòng 7 ngày
    }

    // Cập nhật trạng thái
    public function updateStatus(string $status): bool
    {
        $validStatuses = [
            'pending',
            'confirmed',
            'processing',
            'shipped',
            'delivered',
            'cancelled',
            'refunded'
        ];

        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $this->status = $status;

        // Cập nhật timestamps
        switch ($status) {
            case 'shipped':
                $this->shipped_at = now();
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

    // Tính tổng số lượng sản phẩm
    public function getTotalQuantityAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    // Kiểm tra đã thanh toán
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    // Kiểm tra đã giao hàng
    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }

    // Kiểm tra đã hủy
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    // Scope: Đơn hàng theo trạng thái
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope: Đơn hàng chưa xử lý
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope: Đơn hàng đã thanh toán
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    // Scope: Đơn hàng theo user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
