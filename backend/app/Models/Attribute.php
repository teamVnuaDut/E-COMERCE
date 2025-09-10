<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'is_filterable',
        'is_visible',
        'is_required',
        'sort_order'
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_visible' => 'boolean',
        'is_required' => 'boolean'
    ];

    // Quan hệ: Các giá trị của thuộc tính
    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    // Quan hệ: Sản phẩm có thuộc tính này (through pivot)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
            ->withPivot('value')
            ->withTimestamps();
    }

    // Scope: Thuộc tính có thể lọc được
    public function scopeFilterable($query)
    {
        return $query->where('is_filterable', true);
    }

    // Scope: Thuộc tính hiển thị
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    // Scope: Sắp xếp theo thứ tự
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
