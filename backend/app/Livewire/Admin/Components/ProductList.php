<?php

namespace App\Livewire\Admin\Components;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
            session()->flash('success', 'Product has been delete');
            $this->products = Product::all();
        }
    }
    public function render()
    {
        return view('livewire.admin.components.product-list');
    }
}
