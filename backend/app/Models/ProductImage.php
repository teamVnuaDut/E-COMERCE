<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image_path',
        'alt_text',
        'title',
        'sort_order',
        'type',
        'width',
        'height',
        'size'
    ];

    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
        'size' => 'integer'
    ];

    // Quan hệ: Sản phẩm
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor: URL đầy đủ của ảnh
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/products/' . $this->image_path);
        }
        return asset('images/default-product.png');
    }

    // Scope: Ảnh chính
    public function scopeMain($query)
    {
        return $query->where('type', 'main');
    }

    // Scope: Ảnh gallery
    public function scopeGallery($query)
    {
        return $query->where('type', 'gallery');
    }

    // Scope: Ảnh thumbnail
    public function scopeThumbnail($query)
    {
        return $query->where('type', 'thumbnail');
    }

    // Scope: Sắp xếp theo thứ tự
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // Kiểm tra có phải ảnh chính
    public function isMain(): bool
    {
        return $this->type === 'main';
    }

    // Kiểm tra có phải ảnh thumbnail
    public function isThumbnail(): bool
    {
        return $this->type === 'thumbnail';
    }
}
