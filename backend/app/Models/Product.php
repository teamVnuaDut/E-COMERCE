<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'category_id',
        'brand_id',
        'supplier_id',
        'price',
        'cost_price',
        'sale_price',
        'sale_start',
        'sale_end',
        'stock_quantity',
        'low_stock_threshold',
        'manage_stock',
        'in_stock',
        'weight',
        'length',
        'width',
        'height',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'is_featured',
        'is_virtual',
        'is_active',
        'view_count',
        'sold_count',
        'rating_count',
        'average_rating'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_featured' => 'boolean',
        'is_virtual' => 'boolean',
        'is_active' => 'boolean',
        'average_rating' => 'decimal:2'
    ];

    // Quan hệ: Danh mục
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ: Thương hiệu
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    // Quan hệ: Nhà cung cấp
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    // Quan hệ: Thuộc tính sản phẩm
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->withPivot('value')
            ->withTimestamps();
    }

    // Quan hệ: Ảnh sản phẩm
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    // Thêm method để lấy ảnh chính
    public function getMainImageAttribute()
    {
        return $this->images()->main()->first() ?? $this->images()->first();
    }

    // Thêm method để lấy ảnh thumbnail
    public function getThumbnailImageAttribute()
    {
        return $this->images()->thumbnail()->first() ?? $this->images()->first();
    }

    // Kiểm tra có đang giảm giá
    public function isOnSale(): bool
    {
        if (!$this->sale_price) {
            return false;
        }

        $now = Carbon::now();
        if ($this->sale_start && $now->lt($this->sale_start)) {
            return false;
        }

        if ($this->sale_end && $now->gt($this->sale_end)) {
            return false;
        }

        return true;
    }

    // Lấy giá hiện tại (giá gốc hoặc giá sale)
    public function getCurrentPriceAttribute(): float
    {
        return $this->isOnSale() ? $this->sale_price : $this->price;
    }

    // Kiểm tra còn hàng
    public function checkStock(): void
    {
        if ($this->manage_stock) {
            $this->in_stock = $this->stock_quantity > 0;
            $this->save();
        }
    }

    // Giảm số lượng tồn kho
    public function decreaseStock(int $quantity = 1): bool
    {
        if (!$this->manage_stock) {
            return true;
        }

        if ($this->stock_quantity < $quantity) {
            return false;
        }

        $this->decrement('stock_quantity', $quantity);
        $this->checkStock();

        return true;
    }

    // Tăng số lượng tồn kho
    public function increaseStock(int $quantity = 1): void
    {
        if ($this->manage_stock) {
            $this->increment('stock_quantity', $quantity);
            $this->checkStock();
        }
    }

    // Kiểm tra tồn kho thấp
    public function isLowStock(): bool
    {
        return $this->manage_stock &&
            $this->stock_quantity <= $this->low_stock_threshold &&
            $this->stock_quantity > 0;
    }

    // Kiểm tra hết hàng
    public function isOutOfStock(): bool
    {
        return $this->manage_stock && $this->stock_quantity <= 0;
    }

    // Scope: Sản phẩm published
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where('is_active', true);
    }

    // Scope: Sản phẩm đang sale
    public function scopeOnSale($query)
    {
        $now = Carbon::now();
        return $query->whereNotNull('sale_price')
            ->where(function ($q) use ($now) {
                $q->whereNull('sale_start')->orWhere('sale_start', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('sale_end')->orWhere('sale_end', '>=', $now);
            });
    }

    // Scope: Sản phẩm featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope: Sản phẩm còn hàng
    public function scopeInStock($query)
    {
        return $query->where('in_stock', true);
    }
}
