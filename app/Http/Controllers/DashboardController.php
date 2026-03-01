<?php

namespace App\Http\Controllers;

use App\Support\DashboardApps;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'apps' => DashboardApps::all(),
        ]);
    }
}

