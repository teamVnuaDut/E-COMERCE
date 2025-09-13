<?php

namespace App\Livewire\Admin\Pages\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $deleteId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
    }

    public function deleteCategory(): void
    {
        $category = Category::findOrFail($this->deleteId);
        $category->delete();

        $this->deleteId = null;
        session()->flash('success', '🗑️ Danh mục đã được xóa!');
    }

    public function render()
    {
        $categories = Category::query()
            ->when(
                $this->search,
                fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('slug', 'like', "%{$this->search}%")
            )
            ->orderByDesc('created_at')
            ->paginate(10);

        $parentCategories = Category::whereNull('parent_id')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $childCategories = Category::whereNotNull('parent_id')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->with('parent')
            ->get();

        return view('livewire.admin.pages.category.index', compact(
            'categories',
            'parentCategories',
            'childCategories'
        ));
    }
}
