<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    public Product $product;
    public function render()
    {
        return view('livewire.admin.pages.product.show');
    }
}
