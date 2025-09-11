<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('admin.layouts.admin')]
class Index extends Component
{
    public $products;
    public $deleteId;

    public function mount()
    {
        $this->products = Product::all();
        // dd($this);
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        Product::findOrFail($this->deleteId)->delete();
        $this->deleteId = null;
        $this->products = Product::all();
        session()->flash('success', 'Xoa san pham thanh cong');
    }
    public function render()
    {
        return view('livewire.admin.pages.product.index');
    }
}
