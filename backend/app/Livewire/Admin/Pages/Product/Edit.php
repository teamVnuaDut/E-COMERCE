<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public $productId;
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

    public function mount($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->slug = $product->slug;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->supplier_id = $product->supplier_id;
        $this->price = $product->price;
        $this->sale_price = $product->sale_price;
        $this->stock_quantity = $product->stock_quantity;
        $this->status = $product->status;
        $this->is_featured = $product->is_featured;
        $this->is_virtual  = $product->is_virtual;
    }

    public function update()
    {
        $this->validate([
            'sku' => 'required|string|max:100|unique:products,sku,' . $this->productId,
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $product = Product::findOrFail($this->productId);
        $product->update([
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'stock_quantity' => $this->stock_quantity,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Sản phẩm đã được cập nhật thành công!');
        return redirect()->route('admin.product.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.product.edit', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'suppliers' => Supplier::all(),
        ]);
    }
}
