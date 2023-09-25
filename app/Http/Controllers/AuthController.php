<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Store;

class AuthController extends Controller
{
    // show login page
    public function login()
    {
        return view('auth.login');
    }

    // login operation
    public function loginPost(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt(['email' => $request->email, 'password'=>$request->password], $request->remember)) {
            $request->session()->regenerate();
 
            return redirect()->route('foods.index');
        }
 
        return back()->withErrors(['Email veya şifre hatalı'])->onlyInput('email', 'remember');
    }


    // show customer register page
    public function register()
    {
        return view('auth.register');
    }


    // show seller register page
    public function sellerRegister()
    {
        return view('auth.sellerRegister');
    }

    // registration operation
    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => $request->password,
        ]);
        if($request->registration_type == 'seller')
        {
            $request->validate([
                'store_name' => ['required', 'string', 'max:255'],
                'store_address' => ['required', 'string', 'max:255'],
                'store_phone_number' => ['required', 'string', 'max:15'],
                'store_email' => ['nullable', 'string', 'email', 'max:255'],
                'explanation' => ['nullable', 'string', 'max:255'],
            ]);

            Store::create([
                'user_id' => $user->id,
                'name' => $request->store_name,
                'owner_name' => $request->name,
                'address' => $request->store_address,
                'phone_number' => $request->store_phone_number,
                'email' => $request->store_email,
                'explanation' => $request->explanation, 
            ]);
            $user->update([
                'role' => 1,
            ]);
        }
        return redirect()->route('login');
    }


    // logout operation
    public function logout( Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
