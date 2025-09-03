<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chart()
    {
        return view('admin.pages.chart');
    }
}
