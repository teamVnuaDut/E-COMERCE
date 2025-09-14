<?php

namespace App\Livewire\Admin\Pages\Product;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $category_id = '';
    public $price_min;
    public $price_max;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query();

        // Tìm kiếm đa trường
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('short_description', 'like', '%' . $this->search . '%');
            });
        }

        // Lọc theo trạng thái
        if ($this->status) {
            $query->where('status', $this->status);
        }

        // Lọc theo danh mục
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        // Lọc theo khoảng giá
        if ($this->price_min !== null) {
            $query->where('price', '>=', $this->price_min);
        }

        if ($this->price_max !== null) {
            $query->where('price', '<=', $this->price_max);
        }

        $products = $query->orderByDesc('created_at')->paginate(10);
        $categories = Category::pluck('name', 'id');

        return view('livewire.admin.pages.product.index', compact('products', 'categories'));
    }

    public function confirmDelete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('success', '✅ Đã xóa sản phẩm!');
    }
}
