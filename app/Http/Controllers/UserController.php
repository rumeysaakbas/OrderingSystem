<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Store;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role', 0)->get();
        $sellers = User::where('role', 1)->get();
        return view('admin.users', compact('customers', 'sellers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

            $store->name = $request->store_name;
            $store->owner_name = $request->name;
            $store->address = $request->store_address;
            $store->phone_number = $request->store_phone_number;
            $store->email = $request->store_email;
            $store->explanation = $request->store_explanation;
            $store->save();

            $store_id = $store->id;

            $seller->name = $request->name;
            $seller->email = $request->email;
            $seller->phone_number = $request->phone_number;
            $seller->address = $request->address;
            $seller->password = $request->password;
            $seller->role = '1';
            $seller->store_id = $store_id;
            $seller->save();
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
