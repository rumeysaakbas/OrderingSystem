<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // create new order
    public function create(Request $request)
    {
        $foodItems = $request->input('food_items');

        // Validate the requested quantities and check stock availability
        $validQuantities = [];

        foreach ($foodItems as $foodItem) {
            $validator = Validator::make($foodItem, [
                'food_id' => 'required|exists:food,id',
                'food_quantity' => ['required','int', 'min:1'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            }

            $food_id = $foodItem['food_id'];
            $food_quantity = $foodItem['food_quantity'];

            $food = Food::find($food_id);
            // Check if there's enough stock
            if ($food->stock < $food_quantity) {
                // Not enough stock, return an error
                $errors = new \Illuminate\Support\MessageBag();
                $errors->add('food_id', 'Yetersiz stok: ' . $food->name);
                return redirect()->back()->withErrors($errors);
            }

            $validQuantities[$food_id] = $food_quantity;
        }

        // All quantities are valid, proceed to create orders
        foreach ($validQuantities as $food_id => $food_quantity) {
            $food = Food::find($food_id);

            $order = new Order;
            $order->customer_id = Auth::user()->id;
            $order->food_id = $food_id;
            $order->store_id = $food->store->id;
            $order->order_quantity = $food_quantity;
            $order->paid_price = $food_quantity * $food->price;
            $order->save();

            // Decrease the stock quantity
            $food->stock -= $food_quantity;
            $food->save();
        }

        return redirect()->route('foods.index');
    }

    
    // all completed orders
    public function completedOrders()
    {
        $user = Auth::user();
        if(Auth::user()->role === 'customer'){
            $orders = Order::where('status', 2)->where('customer_id', $user->id)->get();
        }
        elseif( Auth::user()->role === 'seller')
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
        $user = Auth::user();
        if(Auth::user()->role === 'customer')
        {
            $orders = Order::whereIn('status', [0, 1])->where('customer_id', $user->id)->get();
            
        }
        elseif(Auth::user()->role === 'seller')
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
