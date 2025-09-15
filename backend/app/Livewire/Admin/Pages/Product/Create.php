<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $name, $slug, $sku;
    public $short_description, $description;
    public $category_id, $brand_id, $supplier_id;
    public $price = 0, $cost_price, $sale_price;
    public $sale_start, $sale_end;
    public $stock_quantity = 0, $low_stock_threshold = 5;
    public $manage_stock = true, $in_stock = true;
    public $weight, $length, $width, $height;
    public $meta_title, $meta_description, $meta_keywords;
    public $status = 'draft', $is_featured = false, $is_virtual = false, $is_active = true;
    // public $requires_shipping = false;

    public function rules()
    {
        return array_merge([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sale_start' => 'nullable|date',
            'sale_end' => 'nullable|date|after_or_equal:sale_start',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
            'manage_stock' => 'boolean',
            'in_stock' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,pending,published,archived',
            'is_featured' => 'boolean',
            'is_virtual' => 'boolean',
            'is_active' => 'boolean',
        ], $this->is_virtual ? [] : [
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
        ]);
    }

    public function save()
    {
        $this->validate();

        Product::create($this->only(array_keys($this->rules())));

        session()->flash('success', '✅ Sản phẩm đã được tạo!');
        return redirect()->route('admin.product.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.product.create', [
            'categories' => Category::pluck('name', 'id'),
            'brands' => Brand::pluck('name', 'id'),
            'suppliers' => Supplier::pluck('name', 'id'),
        ]);
    }
}
