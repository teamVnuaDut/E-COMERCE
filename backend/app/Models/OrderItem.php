<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_sku',
        'price',
        'original_price',
        'discount_amount',
        'quantity',
        'attributes',
        'subtotal',
        'total',
        'image',
        'notes',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
        'attributes' => 'array'
    ];

    // Quan hệ: Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ: Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Tính toán tổng tiền
    public function calculateTotals(): void
    {
        $this->subtotal = $this->price * $this->quantity;
        $this->total = $this->subtotal - ($this->discount_amount * $this->quantity);
        $this->save();
    }

    // Lấy thông tin thuộc tính dạng text
    public function getAttributesTextAttribute(): string
    {
        if (empty($this->attributes)) {
            return '';
        }

        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $attributeName = str_replace('_', ' ', $key);
            $attributes[] = ucfirst($attributeName) . ': ' . $value;
        }

        return implode(', ', $attributes);
    }

    // Kiểm tra có thể hủy
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending']) &&
            in_array($this->order->status, ['pending', 'confirmed']);
    }

    // Kiểm tra có thể trả hàng
    public function canBeReturned(): bool
    {
        return $this->status === 'delivered' &&
            $this->order->delivered_at->diffInDays(now()) <= 7;
    }

    // Cập nhật trạng thái
    public function updateStatus(string $status): bool
    {
        $validStatuses = ['pending', 'shipped', 'delivered', 'cancelled', 'returned'];

        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $this->status = $status;
        return $this->save();
    }

    // Accessor: URL ảnh sản phẩm
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/products/' . $this->image);
        }

        if ($this->product && $this->product->mainImage) {
            return $this->product->mainImage->image_url;
        }

        return asset('images/default-product.png');
    }

    // Scope: Item theo trạng thái
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope: Item đã giao
    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    // Scope: Item có thể trả hàng
    public function scopeReturnable($query)
    {
        return $query->where('status', 'delivered')
            ->whereHas('order', function ($q) {
                $q->where('delivered_at', '>=', now()->subDays(7));
            });
    }
}
