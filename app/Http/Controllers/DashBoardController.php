<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;

class DashBoardController extends Controller
{
    public function index()
    {
        $customer_count = User::where('role', 0)->count();
        $seller_count = User::where('role', 1)->count();
        $store_count = Store::all()->count();
        $daily_order = Order::whereDate('created_at', now()->toDateString())->count();

        return view('admin.index', compact('customer_count', 'seller_count', 'store_count', 'daily_order'));
    }
}
