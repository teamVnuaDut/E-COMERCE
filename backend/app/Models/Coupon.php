<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'discount_value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'usage_count',
        'usage_per_user',
        'starts_at',
        'ends_at',
        'is_active',
        'is_public',
        'applicable_categories',
        'applicable_products',
        'excluded_products'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
        'is_public' => 'boolean',
        'applicable_categories' => 'array',
        'applicable_products' => 'array',
        'excluded_products' => 'array'
    ];

    // Quan hệ: Lịch sử sử dụng coupon
    public function usages(): HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }

    // Kiểm tra coupon còn hiệu lực
    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = Carbon::now();
        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }

        if ($this->ends_at && $now->gt($this->ends_at)) {
            return false;
        }

        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    // Tính toán số tiền giảm giá
    public function calculateDiscount($orderAmount): float
    {
        if (!$this->isValid()) {
            return 0;
        }

        if ($this->min_order_amount && $orderAmount < $this->min_order_amount) {
            return 0;
        }

        $discount = 0;
        if ($this->type === 'percentage') {
            $discount = $orderAmount * ($this->discount_value / 100);
        } else {
            $discount = $this->discount_value;
        }

        // Giới hạn số tiền giảm tối đa
        if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
            $discount = $this->max_discount_amount;
        }

        return min($discount, $orderAmount);
    }

    // Tăng số lần sử dụng
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }

    // Scope: Lấy coupon active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: Lấy coupon còn hiệu lực
    public function scopeValid($query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')->orWhereRaw('usage_count < usage_limit');
            });
    }
}
