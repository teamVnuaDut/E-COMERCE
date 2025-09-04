<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as FacadesCache;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'general' => config('settings.general', []),
            'payment' => config('settings.payment', []),
            'shipping' => config('settings.shipping', []),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email',
            'store_phone' => 'required|string',
            'store_address' => 'required|string',
            'currency' => 'required|string|size:3',
            'timezone' => 'required|timezone',
        ]);

        $this->saveSettings('general', $validated);

        return back()->with('success', 'Cài đặt chung đã được cập nhật.');
    }

    public function updatePayment(Request $request)
    {
        $validated = $request->validate([
            'cash_on_delivery' => 'boolean',
            'bank_transfer' => 'boolean',
            'credit_card' => 'boolean',
            'momo' => 'boolean',
            'vnpay' => 'boolean',
            'default_method' => 'required|in:cash,bank_transfer,credit_card,momo,vnpay',
        ]);

        $this->saveSettings('payment', $validated);

        return back()->with('success', 'Cài đặt thanh toán đã được cập nhật.');
    }

    public function updateShipping(Request $request)
    {
        $validated = $request->validate([
            'free_shipping_min' => 'nullable|numeric|min:0',
            'standard_shipping_fee' => 'required|numeric|min:0',
            'express_shipping_fee' => 'required|numeric|min:0',
            'shipping_time_standard' => 'required|string',
            'shipping_time_express' => 'required|string',
        ]);

        $this->saveSettings('shipping', $validated);

        return back()->with('success', 'Cài đặt vận chuyển đã được cập nhật.');
    }

    private function saveSettings($group, $settings)
    {
        $currentSettings = config('settings.' . $group, []);
        $updatedSettings = array_merge($currentSettings, $settings);

        // Lưu settings vào database hoặc file config
        // Đây là example, bạn cần implement logic lưu thực tế
        FacadesCache::forever('settings.' . $group, $updatedSettings);
    }
}
