<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use Livewire\Component;

class Edit extends Component
{
    public $productId;
    public $name, $sku, $price, $sale_price, $stock_quantity, $status;

    protected $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|max:100|unique:products,sku,{{productId}}',
        'price' => 'required|numeric|min:0',
        'sale_price' => 'nullable|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'status' => 'required|in:active,inactive',
    ];

    public function mount($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->sale_price = $product->sale_price;
        $this->stock_quantity = $product->stock_quantity;
        $this->status = $product->status;
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
        return view('livewire.admin.pages.product.edit');
    }
}
