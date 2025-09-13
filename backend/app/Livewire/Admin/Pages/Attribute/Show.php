<?php

namespace App\Livewire\Admin\Pages\Attribute;

use App\Models\Attribute;
use Livewire\Component;

class Show extends Component
{
    public Attribute $attribute;

    public function render()
    {
        return view('livewire.admin.pages.attribute.show');
    }
}
