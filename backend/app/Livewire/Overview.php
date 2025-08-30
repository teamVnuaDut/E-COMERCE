<?php

namespace App\Livewire;

use App\Models\Orders;
use App\Models\Products;
use App\Models\Revenue;
use Livewire\Component;

class Overview extends Component
{
    public $totalProducts;
    public $totalOrders;
    public $percentageChange;

    public function mount()
    {
        $this->loadProductStats();
        $this->loadOrderStats();
    }

    public function loadProductStats()
    {
        //tong so san pham
        $this->totalProducts = Products::count();

        //tinh phan tram thay doi so voi thang truoc
        $lastMonthCount = Products::where('created_at', '>=', now()->subMonth())
            ->where('created_at', '<', now()->startOfMonth())
            ->count();

        $currentMonthCount = Products::where('created_at', '>=', now()->startOfMonth())
            ->count();

        if ($lastMonthCount > 0) {
            $this->percentageChange = round(($currentMonthCount - $lastMonthCount) / $lastMonthCount * 100, 2);
        } else {
            $this->percentageChange = $currentMonthCount > 0 ? 100 : 0;
        }
    }

    public function loadOrderStats()
    {
        //tong so don hang
        $this->totalOrders = Orders::count();

        //tinh phan tram thay doi so voi thang truoc
        $lastMonthCount = Orders::where('created_at', '>=', now()->subMonth())
            ->where('created_at', '<', now()->startOfMonth())
            ->count();

        $currentMonthCount = Orders::where('created_at', '>=', now()->startOfMonth())
            ->count();

        if ($lastMonthCount > 0) {
            $this->percentageChange = round(($currentMonthCount - $lastMonthCount) / $lastMonthCount * 100, 2);
        } else {
            $this->percentageChange = $currentMonthCount > 0 ? 100 : 0;
        }
    }

    // public function loadRevenueStats()
    // {
    //     //tong so doanh thu
    //     $this->totalRevenue = Revenue::sum('amount');

    //     //tinh phan tram thay doi so voi thang truoc
    //     $lastMonthCount = Revenue::where('created_at', '>=', now()->subMonth())
    //         ->where('created_at', '<', now()->startOfMonth())
    //         ->sum('amount');

    //     $currentMonthCount = Revenue::where('created_at', '>=', now()->startOfMonth())
    //         ->sum('amount');

    //     if ($lastMonthCount > 0) {
    //         $this->percentageChange = round(($currentMonthCount - $lastMonthCount) / $lastMonthCount * 100, 2);
    //     } else {
    //         $this->percentageChange = $currentMonthCount > 0 ? 100 : 0;
    //     }
    // }

    protected $listeners = ['refreshDashboard' => '$refresh'];

    public function render()
    {
        return view('livewire.overview');
    }
}
