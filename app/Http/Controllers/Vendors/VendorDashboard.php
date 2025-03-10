<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Route;

class VendorDashboard extends Controller
{
    public function index()
    {
        return view('dashboard.vendors.home');
    }

    public function logout()
    {
        Auth::guard('Vendor')->logout();
        return redirect( Route('vendors.login'));
    }
}
