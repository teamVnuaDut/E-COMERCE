<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $name, $sku, $price, $sale_price, $stock_quantity, $status = 'active';

    protected $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|max:100|unique:products,sku',
        'price' => 'required|numeric|min:0',
        'sale_price' => 'nullable|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'status' => 'required|in:draft,pending,published,archived',
    ];

    public function save()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'stock_quantity' => $this->stock_quantity,
            'status' => $this->status,
        ]);

        session()->flash('success', 'San pham duoc tao thanh cong');
        return redirect()->route('admin.product.index');
    }
    public function render()
    {
        return view('livewire.admin.pages.product.create');
    }
}
