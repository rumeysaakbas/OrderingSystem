<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $current_customer_id = "3";
        $foodItems = $request->input('food_items');

        foreach ($foodItems as $foodItem) {
            $food_id = $foodItem['food_id'];
            $food_quantity = $foodItem['food_quantity'];

            $food = Food::find($food_id);
            //$food_price = Food::where('id', $food_id)->value('price');

            $order = new Order;
            $order->customer_id = $current_customer_id;
            $order->food_id = $food_id;
            $order->store_id = $food->store->id;
            $order->order_quantity = $food_quantity;
            $order->paid_price = $food_quantity*$food->price;
            $order->save();
        }
        return redirect()->route('foods.index');
        
    }

    public function completedOrders()
    {
        $role="1";
        $user = User::find(6);
        if($role === "0"){
            $orders = Order::where('status', 2)->where('customer_id', $user->id)->get();
        }
        elseif( $role === "1")
        {
            $orders = Order::where('status', 2)->where('store_id', $user->store->id)->get();
        }
        else
        {
            $orders = Order::where('status', 2);
        }
        return view('completed_orders', compact('orders'));
    }

    public function ongoingOrders()
    {
        $role = "1";
        $user = User::find(6);
        if($role === "0")
        {
            $orders = Order::whereIn('status', [0, 1])->where('customer_id', $user->id)->get();
            
        }
        elseif($role === "1")
        {
            $orders = Order::whereIn('status', [0, 1])->where('store_id', $user->store->id)->get();

        }
        $order_count = $orders->count();
        session(['order_count' => $order_count]);
        return view('orders', compact('orders'));
    }

    public function updateStatus(Request $request, String $orderId)
    {
        $order = Order::find($orderId);
        $order->update([
            'status' => $request->input('status')
        ]);
        
        return redirect()->route('orders.ongoing');
    }
}
