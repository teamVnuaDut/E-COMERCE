<?php

namespace App\Livewire\Pages\Product;

use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Categories;

class Edit extends Component
{
    use WithFileUploads;

    public $productId;
    public $name;
    public $description;
    public $price;
    public $stock_quantity;
    public $category_id;
    public $status = 'active';
    public $image;
    public $image_url;
    public $existingImage;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'name.required' => 'Tên sản phẩm là bắt buộc.',
        'name.min' => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
        'description.required' => 'Mô tả sản phẩm là bắt buộc.',
        'description.min' => 'Mô tả phải có ít nhất 10 ký tự.',
        'price.required' => 'Giá sản phẩm là bắt buộc.',
        'price.numeric' => 'Giá phải là số.',
        'stock_quantity.required' => 'Số lượng tồn kho là bắt buộc.',
        'stock_quantity.integer' => 'Số lượng phải là số nguyên.',
        'category_id.required' => 'Danh mục là bắt buộc.',
        'category_id.exists' => 'Danh mục không hợp lệ.',
        'image.image' => 'File phải là hình ảnh.',
        'image.max' => 'Hình ảnh không được vượt quá 2MB.',
    ];

    public function mount($id)
    {
        $product = Products::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock_quantity = $product->stock_quantity;
        $this->category_id = $product->category_id;
        $this->status = $product->status;
        $this->image_url = $product->image_url;
        $this->existingImage = $product->image_url;
    }

    public function render()
    {
        $categories = Categories::all();
        return view('livewire.product-edit', compact('categories'));
    }

    public function update()
    {
        $this->validate();

        $product = Products::findOrFail($this->productId);

        // xu ly upload anh
        if ($this->image) {
            if ($product->image_url) {
                $oldImagePath = str_replace('/storage/', '', $product->image_url);
                Storage::disk('public')->delete($oldImagePath);
            }

            $imageName = Str::random(20) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('products', $imageName, 'public');
            $this->image_url = Storage::url($imagePath);
        }

        // cap nhat san pham
        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'image_url' => $this->image_url ?? $product->image_url,
        ]);

        session()->flash('message', 'Sản phẩm đã được cập nhật thành công!');
        return redirect()->route('admin.products');
    }

    public function removeImage()
    {
        $product = Products::findOrFail($this->productId);

        // xoa anh tu storage
        if ($product->image_url) {
            $imagePath = str_replace('/storage/', '', $product->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        // update database
        $product->update(['image_url' => null]);

        $this->image_url = null;
        $this->existingImage = null;

        session()->flash('message', 'Ảnh đã được xóa thành công!');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function cancel()
    {
        return redirect()->route('admin.products');
    }
}
