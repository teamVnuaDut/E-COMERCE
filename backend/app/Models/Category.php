<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'sort_order'
    ];

    // Quan hệ: Danh mục cha
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Quan hệ: Các danh mục con
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Quan hệ: Sản phẩm thuộc danh mục
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Scope: Chỉ lấy danh mục active
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope: Danh mục gốc (không có parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}
