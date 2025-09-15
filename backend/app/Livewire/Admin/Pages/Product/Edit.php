<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public Product $product;

    public $requires_shipping = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->requires_shipping = $product->weight || $product->length || $product->width || $product->height;
    }

    public function rules()
    {
        return [
            'product.name' => 'required|string|max:255',
            'product.slug' => 'required|string|unique:products,slug,' . $this->product->id,
            'product.sku' => 'required|string|unique:products,sku,' . $this->product->id,
            'product.category_id' => 'required|exists:categories,id',
            'product.brand_id' => 'nullable|exists:brands,id',
            'product.supplier_id' => 'nullable|exists:suppliers,id',
            'product.price' => 'required|numeric|min:0',
            'product.cost_price' => 'nullable|numeric|min:0',
            'product.sale_price' => 'nullable|numeric|min:0',
            'product.stock_quantity' => 'required|integer|min:0',
            'product.low_stock_threshold' => 'required|integer|min:0',
            'product.manage_stock' => 'boolean',
            'product.in_stock' => 'boolean',
            'product.weight' => 'nullable|numeric|min:0',
            'product.length' => 'nullable|numeric|min:0',
            'product.width' => 'nullable|numeric|min:0',
            'product.height' => 'nullable|numeric|min:0',
            'product.meta_title' => 'nullable|string|max:255',
            'product.meta_description' => 'nullable|string',
            'product.meta_keywords' => 'nullable|string|max:255',
            'product.status' => 'required|in:draft,pending,published,archived',
            'product.is_featured' => 'boolean',
            'product.is_virtual' => 'boolean',
            'product.is_active' => 'boolean',
            'product.short_description' => 'nullable|string',
            'product.description' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        if (!$this->requires_shipping) {
            $this->product->weight = null;
            $this->product->length = null;
            $this->product->width = null;
            $this->product->height = null;
        }

        $this->product->save();

        session()->flash('success', '✅ Sản phẩm đã được cập nhật!');
        return redirect()->route('admin.product.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.product.edit', [
            'categories' => Category::pluck('name', 'id'),
            'brands' => Brand::pluck('name', 'id'),
            'suppliers' => Supplier::pluck('name', 'id'),
        ]);
    }
}
