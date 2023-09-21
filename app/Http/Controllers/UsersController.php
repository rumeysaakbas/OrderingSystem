<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;

class UsersController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 0)->get();
        $sellers = User::where('role', 1)->get();
        return view('admin.users', compact('customers', 'sellers'));

    }

    public function store(Request $request)
    {
        $registration_type = $request->input('registration_type');
        if($registration_type === 'customer'){
            $request->validate([
                "name"=>"required|string",
                "email"=> "required|email|max:200",
                "phone_number"=> "nullable|string",
                "address"=> "nullable|string"
            ]);
            $customer = new User;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone_number = $request->phone_number;
            $customer->address = $request->address;
            $customer->password = $request->password;
            $customer->role = '0';
            $customer->save();
        }
        else if($registration_type ==='seller')
        {
            $request->validate([
                "name"=>"required|string",
                "email"=> "required|email|max:200",
                "phone_number"=> "nullable|string",
                "address"=> "nullable|string"
            ]);
            $seller = new User;
            $store = new Store;

            $seller->name = $request->name;
            $seller->email = $request->email;
            $seller->phone_number = $request->phone_number;
            $seller->address = $request->address;
            $seller->password = $request->password;
            $seller->role = '1';
            $seller->save();
            
            $seller_id = $seller->id;

            $store->user_id = $seller_id;
            $store->name = $request->store_name;
            $store->owner_name = $request->name;
            $store->address = $request->store_address;
            $store->phone_number = $request->store_phone_number;
            $store->email = $request->store_email;
            $store->explanation = $request->store_explanation;
            $store->save();

        }
        return redirect()->route('users.index');
    }

    public function update(Request $request)
    {
        $id = $request->input('user_id');
        $user = User::find($id);
        $registration_type = $request->input('registration_type');
    
        if ($user && $registration_type === "customer" || $registration_type === "0") {
            $user->update([
                'name' => $request->input('customer_name'),
                'email' => $request->input('customer_email'),
                'phone_number' => $request->input('customer_phone_number'),
                'address' => $request->input('customer_address'),
            ]);
        }
        else if($user && $registration_type === "seller" || $registration_type === "1")
        {
            $user->update([
                'name' => $request->input('seller_name'),
                'email' => $request->input('seller_email'),
                'phone_number' => $request->input('seller_phone_number'),
                'address' => $request->input('seller_address'),
            ]);
            $user->store->update([
                'name' => $request->input('store_name'),
                'owner_name' => $request->input('seller_name'),
                'address' => $request->input('store_address'),
                'phone_number' => $request->input('store_phone_number'),
                'email' => $request->input('store_email'),
                'explanation' => $request->input('store_explanation'),
            ]);
        }

        return redirect()->route('users.index');
    }

    public function destroy(String $userId)
    {
        $user = User::find($userId);
        if($user->role == "1")
        {
            $store = $user->store;
            $store->delete();
        }
        $user->delete();
        return redirect()->route('users.index');
    }
}
