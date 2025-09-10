<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'total_amount',
        'discount_amount',
        'tax_amount',
        'shipping_amount',
        'grand_total',
        'coupon_id',
        'coupon_code',
        'coupon_discount',
        'is_active',
        'is_guest',
        'abandoned_at'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
        'is_active' => 'boolean',
        'is_guest' => 'boolean',
        'abandoned_at' => 'datetime'
    ];

    // Quan hệ: User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Coupon
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    // Quan hệ: Cart items
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Tính toán lại tổng tiền
    public function calculateTotals(): void
    {
        $totalAmount = 0;
        $discountAmount = 0;

        foreach ($this->items as $item) {
            $totalAmount += $item->quantity * $item->price;
            $discountAmount += $item->quantity * $item->discount_amount;
        }

        $this->total_amount = $totalAmount;
        $this->discount_amount = $discountAmount;

        // Tính grand total
        $this->grand_total = $this->total_amount
            - $this->discount_amount
            - $this->coupon_discount
            + $this->tax_amount
            + $this->shipping_amount;

        $this->save();
    }

    // Áp dụng coupon
    public function applyCoupon(Coupon $coupon): bool
    {
        if (!$coupon->isValid()) {
            return false;
        }

        $discount = $coupon->calculateDiscount($this->total_amount);

        if ($discount > 0) {
            $this->coupon_id = $coupon->id;
            $this->coupon_code = $coupon->code;
            $this->coupon_discount = $discount;
            $this->calculateTotals();
            return true;
        }

        return false;
    }

    // Xóa coupon
    public function removeCoupon(): void
    {
        $this->coupon_id = null;
        $this->coupon_code = null;
        $this->coupon_discount = 0;
        $this->calculateTotals();
    }

    // Kiểm tra giỏ hàng trống
    public function isEmpty(): bool
    {
        return $this->items->count() === 0;
    }

    // Thêm vào class Cart

    // Thêm sản phẩm vào giỏ hàng
    public function addItem(Product $product, int $quantity = 1, array $attributes = null): CartItem
    {
        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $existingItem = $this->items()
            ->where('product_id', $product->id)
            ->where('attributes', $attributes ? json_encode($attributes) : null)
            ->first();

        if ($existingItem) {
            $existingItem->increaseQuantity($quantity);
            return $existingItem;
        }

        // Tạo item mới
        $item = new CartItem([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
            'price' => $product->currentPrice,
            'original_price' => $product->price,
            'quantity' => $quantity,
            'attributes' => $attributes,
            'image' => $product->mainImage->image_path ?? null,
            'max_quantity' => $product->manage_stock ? $product->stock_quantity : null
        ]);

        $item->calculateTotals();
        $this->items()->save($item);

        $this->calculateTotals();

        return $item;
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeItem(int $itemId): bool
    {
        $item = $this->items()->find($itemId);

        if ($item) {
            $item->delete();
            $this->calculateTotals();
            return true;
        }

        return false;
    }

    // Xóa tất cả sản phẩm
    public function clearItems(): void
    {
        $this->items()->delete();
        $this->total_amount = 0;
        $this->discount_amount = 0;
        $this->coupon_discount = 0;
        $this->grand_total = 0;
        $this->save();
    }

    // Kiểm tra giỏ hàng có sản phẩm hết hàng
    public function hasOutOfStockItems(): bool
    {
        return $this->items()->whereHas('product', function ($query) {
            $query->where('manage_stock', true)
                ->whereColumn('cart_items.quantity', '>', 'products.stock_quantity');
        })->exists();
    }

    // Lấy số lượng sản phẩm
    public function getTotalQuantityAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    // Đánh dấu abandoned
    public function markAsAbandoned(): void
    {
        $this->abandoned_at = now();
        $this->is_active = false;
        $this->save();
    }

    // Scope: Giỏ hàng active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: Giỏ hàng abandoned
    public function scopeAbandoned($query)
    {
        return $query->whereNotNull('abandoned_at');
    }

    // Scope: Giỏ hàng của user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope: Giỏ hàng theo session
    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }
}
