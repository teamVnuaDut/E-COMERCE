<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $totalUsers;
    public $newUsersThisWeek;

    public function mount()
    {
        $this->totalUsers = User::count(); // SoftDeletes sẽ tự loại bỏ bản ghi đã xóa
        $this->newUsersThisWeek = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
