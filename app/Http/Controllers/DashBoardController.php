<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;
use Illuminate\Support\Carbon;

class DashBoardController extends Controller
{
    public function index()
    {
        $customer_count = User::where('role', 0)->count();
        $seller_count = User::where('role', 1)->count();
        $store_count = Store::all()->count();
        $daily_order = Order::whereDate('created_at', now()->toDateString())->sum('order_quantity');

        $currentDate = Carbon::now()->toDateString();
        $oneWeekAgo = Carbon::now()->subWeek()->toDateString();

        $orderData = Order::whereDate('created_at', '>=', $oneWeekAgo)
        ->whereDate('created_at', '<=', $currentDate)
        ->groupBy('date')
        ->selectRaw('DATE(created_at) as date, SUM(order_quantity) as total_orders')
        ->pluck('total_orders', 'date')
        ->toArray();
        
        $labels = [];
        $datas = [];

        while ($oneWeekAgo <= $currentDate) {
            $formattedDate = $oneWeekAgo;
            $labels[] = date('d F', strtotime($formattedDate));
            $datas[] = isset($orderData[$formattedDate]) ? $orderData[$formattedDate] : 0;
            $oneWeekAgo = Carbon::parse($oneWeekAgo)->addDay()->toDateString();
        }

        $order_datas = [
            'labels' => $labels,
            'datas' => $datas,
        ];

        
        return view('admin.index', compact('customer_count', 'seller_count', 'store_count', 'daily_order', 'order_datas'));
    }
}
