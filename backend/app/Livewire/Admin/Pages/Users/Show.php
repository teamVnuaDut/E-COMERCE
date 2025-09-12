<?php

namespace App\Livewire\Admin\Pages\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

class Show extends Component
{
    #[Url]
    public int $id;

    public User $user;

    #[Layout('admin.layouts.admin')]
    public function render()
    {
        // dd('Component đã chạy', $this->id);

        $this->user = User::findOrFail($this->id);

        return view('livewire.admin.pages.users.show');
    }
}
