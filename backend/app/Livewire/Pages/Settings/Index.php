<?php

namespace App\Livewire\Pages\Settings;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Index extends Component
{

    public $theme = 'light';
    public $notification = true;
    public $language = 'vi';
    public $pageSize = 10;

    protected $rules = [
        'theme' => 'required|in:light,dark',
        'notification' => 'boolean',
        'language' => 'required|in:vi,en',
        'pageSize' => 'required|integer|min:5|max:100',
    ];

    protected $fillable = [
        'theme',
        'notification',
        'language',
        'pageSize',
    ];

    protected $messages = [
        'theme.required' => 'Chủ đề là bắt buộc.',
        'theme.in' => 'Chủ đề không hợp lệ.',
        'notification.boolean' => 'Thông báo phải là đúng hoặc sai.',
        'language.required' => 'Ngôn ngữ là bắt buộc.',
        'language.in' => 'Ngôn ngữ không hợp lệ.',
        'pageSize.required' => 'Kích thước trang là bắt buộc.',
        'pageSize.integer' => 'Kích thước trang phải là số nguyên.',
        'pageSize.min' => 'Kích thước trang phải lớn hơn hoặc bằng 5.',
        'pageSize.max' => 'Kích thước trang phải nhỏ hơn hoặc bằng 100.',
    ];

    public function mount()
    {
        //load settings tu database
        $this->theme = Cookie::get('theme', 'light');
        $this->notification = Cookie::get('notification', true) === 'true';
        $this->language = Cookie::get('language', 'vi');
        $this->pageSize = Cookie::get('pageSize', 10);
    }

    public function render()
    {
        return view('livewire.pages.settings.index');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        //auto save khi thay doi
        if (in_array($propertyName, ['theme', 'notification', 'language', 'pageSize'])) {
            $this->saveSettings();
        }
    }

    public function saveSettings()
    {
        $this->validate();

        //luu settings vao cookie
        Cookie::queue('theme', $this->theme, 60 * 24 * 30); //30 ngay
        Cookie::queue('notification', $this->notification ? 'true' : 'false', 60 * 24 * 30);
        Cookie::queue('language', $this->language, 60 * 24 * 30);
        Cookie::queue('pageSize', $this->pageSize, 60 * 24 * 30);

        //dong bo theme voi session
        session(['theme' => $this->theme]);

        session()->flash('message', 'Cài đặt đã được lưu thành công.');
    }

    public function toggleTheme()
    {
        $this->theme = $this->theme === 'light' ? 'dark' : 'light';
        $this->saveSettings();
    }

    public function resetToDefault()
    {
        $this->theme = 'light';
        $this->notification = true;
        $this->language = 'vi';
        $this->pageSize = 10;

        $this->saveSettings();
    }
}
