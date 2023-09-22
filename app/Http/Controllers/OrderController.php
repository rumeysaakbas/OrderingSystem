<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{

    // create new order
    public function create(Request $request)
    {
        $current_customer_id = "3";
        $foodItems = $request->input('food_items');

        //if any of the data is incorrect, go back to the index page
        foreach ($foodItems as $foodItem) {
            $validator = Validator::make($foodItem, [
                'food_id' => 'required|exists:food,id',
                'food_quantity' => 'required|int|min:1',
            ]);
    
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            }
        }
        foreach ($foodItems as $foodItem) {
            $food_id = $foodItem['food_id'];
            $food_quantity = $foodItem['food_quantity'];

            $food = Food::find($food_id);

            $order = new Order;
            $order->customer_id = $current_customer_id;
            $order->food_id = $food_id;
            $order->store_id = $food->store->id;
            $order->order_quantity = $food_quantity;
            $order->paid_price = $food_quantity * $food->price;
            $order->save();

            // decrease the stock quantity
            $food->stock -=1;
            $food->save();
        }
        return redirect()->route('foods.index');
    }


    // all completed orders
    public function completedOrders()
    {
        $role="1";
        $user = User::find(2);
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



    // all ongoing orders
    public function ongoingOrders()
    {
        $role = "1";
        $user = User::find(2);
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


    // update order status
    public function updateStatus(Request $request, String $orderId)
    {
        $order = Order::find($orderId);
        $order->update([
            'status' => $request->input('status')
        ]);
        
        return redirect()->route('orders.ongoing');
    }
}
