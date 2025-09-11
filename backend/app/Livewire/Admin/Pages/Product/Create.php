<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $name, $slug, $sku, $short_description, $description;
    public $category_id, $brand_id, $supplier_id;
    public $price = 0, $cost_price, $sale_price, $sale_start, $sale_end;
    public $stock_quantity = 0, $low_stock_threshold = 5, $manage_stock = true, $in_stock = true;
    public $weight, $lenght, $width, $height;
    public $meta_title, $meta_description, $meta_keywords;
    public $status = 'draft', $is_featured = false, $is_virtual = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug',
        'sku' => 'required|string|max:100|unique:products,sku',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'price' => 'required|numeric|min:0',
        'cost_price' => 'nullable|numeric|min:0',
        'sale_price' => 'nullable|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'low_stock_threshold' => 'nullable|integer|min:0',
        'status' => 'required|in:draft,pending,published,archived',
        'is_featured' => 'boolean',
        'is_virtual' => 'boolean',
    ];


    public function save()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'supplier_id' => $this->supplier_id,
            'price' => $this->price,
            'cost_price' => $this->cost_price,
            'sale_price' => $this->sale_price,
            'sale_start' => $this->sale_start,
            'sale_end' => $this->sale_end,
            'stock_quantity' => $this->stock_quantity,
            'low_stock_threshold' => $this->low_stock_threshold,
            'manage_stock' => $this->manage_stock,
            'in_stock' => $this->in_stock,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
            'is_virtual' => $this->is_virtual,
        ]);


        session()->flash('success', 'San pham duoc tao thanh cong');
        return redirect()->route('admin.product.index');
    }
    public function render()
    {
        return view('livewire.admin.pages.product.create', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'suppliers' => Supplier::all(),
        ]);
    }
}
