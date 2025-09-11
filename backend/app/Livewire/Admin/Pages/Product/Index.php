<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('admin.layouts.admin')]
class Index extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::all();
        // dd($this);
    }
    public function render()
    {
        return view('livewire.admin.pages.product.index');
    }
}
