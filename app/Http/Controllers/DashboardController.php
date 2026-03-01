<?php

namespace App\Http\Controllers;

use App\Support\DashboardApps;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'apps' => DashboardApps::all(Auth::user()),
        ]);
    }
}
