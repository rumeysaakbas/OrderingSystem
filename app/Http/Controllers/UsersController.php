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
                "customer_name"=>"required|string",
                "customer_email"=> "unique:users,email|max:200",
                "customer_phone_number"=> "required|string|max:15",
                "customer_address"=> "required|string|max:250",
                "customer_password"=> "required|string|max:15"
            ]);
            $customer = new User;
            $customer->name = $request->customer_name;
            $customer->email = $request->customer_email;
            $customer->phone_number = $request->customer_phone_number;
            $customer->address = $request->customer_address;
            $customer->password = $request->customer_password;
            $customer->role = '0';
            $customer->save();
        }
        else if($registration_type ==='seller')
        {
            $request->validate([
                "seller_name"=>"required|string",
                "seller_email"=> "unique:users,email|max:200",
                "seller_phone_number"=> "required|string|max:15",
                "seller_address"=> "required|string|max:250",
                "seller_password"=> "required|string|max:15",

                "store_name"=>"required|string|max:250",
                "store_address"=>"required|string|max:250",
                "store_phone_number"=>"required|string|max:15",
                "store_email"=> "nullable|email|max:200",
                "store_explanation"=> "nullable|string|max:250"
            ]);
            $seller = new User;
            $store = new Store;

            $seller->name = $request->seller_name;
            $seller->email = $request->seller_email;
            $seller->phone_number = $request->seller_phone_number;
            $seller->address = $request->seller_address;
            $seller->password = $request->seller_password;
            $seller->role = '1';
            $seller->save();
            
            $seller_id = $seller->id;

            $store->user_id = $seller_id;
            $store->name = $request->store_name;
            $store->owner_name = $request->seller_name;
            $store->address = $request->store_address;
            $store->phone_number = $request->store_phone_number;
            $store->email = $request->store_email;
            $store->explanation = $request->store_explanation;
            $store->save();
        }
        return redirect()->route('users.index');
    }


    public function update(Request $request, string $userId)
    {
        $user = User::find($userId);
        $request->validate([
            "edit_name"=>"required|string",
            "edit_email"=> "required|unique:users,email," . $userId . "|max:200",
            "edit_phone_number"=> "required|string|max:15",
            "edit_address"=> "required|string|max:250",
        ]);
        $user->update([
            'name' => $request->input('edit_name'),
            'email' => $request->input('edit_email'),
            'phone_number' => $request->input('edit_phone_number'),
            'address' => $request->input('edit_address'),
        ]);

        if($user->store)
        {
            $request->validate([
                "edit_store_name"=>"required|string|max:250",
                "edit_store_address"=>"required|string|max:250",
                "edit_store_phone_number"=>"required|string|max:15",
                "edit_store_email"=> "nullable|email|max:200",
                "edit_store_explanation"=> "nullable|string|max:250"
            ]);
            $user->store->update([
            'name' => $request->input('edit_store_name'),
            'owner_name' => $request->input('edit_name'),
            'address' => $request->input('edit_store_address'),
            'phone_number' => $request->input('edit_store_phone_number'),
            'email' => $request->input('edit_store_email'),
            'explanation' => $request->input('edit_store_explanation'),
            ]);
        }
        return redirect()->back();
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

    // view profile page
    public function profile()
    {
        return view('profile');
    }
}
