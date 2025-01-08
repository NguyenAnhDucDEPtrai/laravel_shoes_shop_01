<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();

        $totalUsers = User::count();

        $totalRevenue = Order::sum('total_amount');
        return view('admin.dashboard', compact('totalOrders', 'totalUsers', 'totalRevenue'));
    }
}
