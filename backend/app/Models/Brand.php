<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'website',
        'contact_email',
        'contact_phone',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'sort_order'
    ];

    // Quan hệ: Sản phẩm thuộc thương hiệu
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Scope: Chỉ lấy thương hiệu active
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessor: URL logo đầy đủ
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/brands/' . $this->logo);
        }
        return asset('images/default-brand.png');
    }
}
