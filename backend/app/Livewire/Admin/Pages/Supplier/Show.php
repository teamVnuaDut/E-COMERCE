<?php

namespace App\Livewire\Admin\Pages\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class Show extends Component
{
    public Supplier $supplier;
    public function render()
    {
        return view('livewire.admin.pages.supplier.show');
    }
}
