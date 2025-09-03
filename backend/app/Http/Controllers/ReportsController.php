<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function reports()
    {
        return view('admin.pages.reports.reports');
    }
}
