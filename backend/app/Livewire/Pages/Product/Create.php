<?php

namespace App\Livewire\Pages\Product;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{

    use WithFileUploads;

    public $name;
    public $description;
    public $image;
    public $price;
    public $category_id;
    public $image_url;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'image' => 'required|image|max:1024',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
    ];

    protected $messages = [
        'name.required' => 'Tên sản phẩm là bắt buộc.',
        'description.required' => 'Mô tả sản phẩm là bắt buộc.',
        'image.required' => 'Hình ảnh sản phẩm là bắt buộc.',
        'price.required' => 'Giá sản phẩm là bắt buộc.',
        'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
    ];

    public function render()
    {
        $categories = Categories::all();
        return view('livewire.pages.product.create', compact('categories'));
    }

    public function save()
    {
        $this->validate();

        //xu ly up image
        if ($this->image) {
            $imageName = Str::random(20) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('images', $imageName, 'public');
            $this->image_url = Storage::url($imagePath);
        }

        //tao san pham
        Products::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image_url,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);

        session()->flash('success', 'Tạo sản phẩm thành công.');
        return redirect()->route('admin.products');
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
