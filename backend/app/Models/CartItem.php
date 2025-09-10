<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_name',
        'product_sku',
        'price',
        'original_price',
        'discount_amount',
        'tax_amount',
        'quantity',
        'max_quantity',
        'attributes',
        'subtotal',
        'total',
        'image',
        'notes'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
        'attributes' => 'array',
        'max_quantity' => 'integer'
    ];

    // Quan hệ: Giỏ hàng
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    // Quan hệ: Sản phẩm
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

    // Tăng số lượng
    public function increaseQuantity(int $quantity = 1): bool
    {
        $newQuantity = $this->quantity + $quantity;

        // Kiểm tra số lượng tối đa
        if ($this->max_quantity && $newQuantity > $this->max_quantity) {
            return false;
        }

        // Kiểm tra tồn kho
        if ($this->product->manage_stock && $newQuantity > $this->product->stock_quantity) {
            return false;
        }

        $this->quantity = $newQuantity;
        $this->calculateTotals();

        return true;
    }

    // Giảm số lượng
    public function decreaseQuantity(int $quantity = 1): bool
    {
        $newQuantity = $this->quantity - $quantity;

        if ($newQuantity < 1) {
            return false;
        }

        $this->quantity = $newQuantity;
        $this->calculateTotals();

        return true;
    }

    // Cập nhật số lượng
    public function updateQuantity(int $newQuantity): bool
    {
        if ($newQuantity < 1) {
            return false;
        }

        // Kiểm tra số lượng tối đa
        if ($this->max_quantity && $newQuantity > $this->max_quantity) {
            return false;
        }

        // Kiểm tra tồn kho
        if ($this->product->manage_stock && $newQuantity > $this->product->stock_quantity) {
            return false;
        }

        $this->quantity = $newQuantity;
        $this->calculateTotals();

        return true;
    }

    // Kiểm tra còn hàng
    public function isInStock(): bool
    {
        if (!$this->product->manage_stock) {
            return true;
        }

        return $this->product->stock_quantity >= $this->quantity;
    }

    // Kiểm tra số lượng vượt quá tồn kho
    public function isExceedingStock(): bool
    {
        if (!$this->product->manage_stock) {
            return false;
        }

        return $this->quantity > $this->product->stock_quantity;
    }

    // Lấy thông tin thuộc tính dạng text
    public function getAttributesTextAttribute(): string
    {
        if (empty($this->attributes)) {
            return '';
        }

        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $attributes[] = ucfirst($key) . ': ' . $value;
        }

        return implode(', ', $attributes);
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
}
