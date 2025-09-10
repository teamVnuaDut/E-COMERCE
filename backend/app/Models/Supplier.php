<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'contact_person',
        'email',
        'phone',
        'address',
        'tax_code',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'notes'
    ];

    // Quan hệ: Sản phẩm từ nhà cung cấp
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Quan hệ: Đơn nhập hàng
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    // Scope: Chỉ lấy nhà cung cấp active
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessor: Định dạng số điện thoại
    public function getFormattedPhoneAttribute()
    {
        if (!$this->phone) return null;

        $phone = preg_replace('/[^0-9]/', '', $this->phone);
        if (strlen($phone) === 10) {
            return preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', $phone);
        }

        return $this->phone;
    }
}
