<?php

namespace App\Livewire\Admin\Pages\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $theme;
    public bool $notifications = true;
    public string $language = 'vi';
    public function mount()
    {
        $user = Auth::user();

        $this->theme = $user->theme;
        $this->notifications = $user->notifications;
        $this->language = $user->language ?? 'vi';
    }

    public function save()
    {
        $this->validate([
            'theme' => 'in:light,dark',
            'notifications' => 'boolean',
            'language' => 'in:vi,en',
        ]);

        $user = Auth::user();

        $user->theme = $this->theme;
        $user->notifications = $this->notifications;
        $user->language = $this->language;

        $user->save();

        session()->flash('success', 'Cài đặt đã được lưu!');
    }
    public function render()
    {
        return view('livewire.admin.pages.setting.index');
    }
}
