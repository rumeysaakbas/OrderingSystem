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
        ],
        [
            "email.required" => "Email alanı boş bırakılamaz",
            "email.email" => "Email uygun formatta olmalıdır",
            "password.required" => "Şifre boş bırakılamaz",
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
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email', 'max:200', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:11'],
            'address' => ['required', 'string', 'max:250'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:15'],
        ],
        [
            "name.required" => "Ad soyad alanı boş bırakılamaz",
            "name.max" => "Ad soyad 250 karakterden fazla olamaz",
            "name.string" => "Ad soyad yazı tipinde olmalı",

            "email.required" => "Email adresi alanı boş bırakılamaz",
            "email.unique" => "Bu email adresi alımmıştır",
            "email.max" => "Email 200 karakterden fazla olamaz",
            "email.email" => "Email uygun formatta yazılmalıdır",

            "phone_number.required" => "Telefon numarası boş bırakılamaz",
            "phone_number.max" => "Telefon numarası 11 karakterden fazla olamaz",

            "address.required" => "Adres alanı boş bırakılamaz",
            "address.max" => "Adres 250 karakterden fazla olamaz",

            "password.required" => "Şifre boş bırakılamaz",
            "password.min" => "Şifre 8 karakterden az olamaz",
            "password.max" => "Şifre 15 karakterden fazla olamaz",
            "password.confirmed" => "Şifre doğrulanmadı",
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
                'store_name' => ['required', 'string', 'max:250'],
                'store_address' => ['required', 'string', 'max:250'],
                'store_phone_number' => ['required', 'string', 'max:11'],
                'store_email' => ['nullable', 'email', 'max:250'],
                'explanation' => ['nullable', 'string', 'max:250'],
            ],
            [
                "store_name.required" => "Restorant adı alanı boş bırakılamaz",
                "store_name.max" => "Restorant adı 250 karakterden fazla olamaz",

                "store_address.required" => "Restorant adresi alanı boş bırakılamaz",
                "store_address.max" => "Restorant adresi 250 karakterden fazla olamaz",

                "store_phone_number.required" => "Restorant telefon numarası alanı boş bırakılamaz",
                "store_phone_number.max" => "Restorant telefon numarası 11 karakterden fazla olamaz",

                "store.email" => "Restorant email adresi email tipinde olmalıdır",
                "store.max" => "Restorant email 200 karakterden fazla olamaz",

                "store_explanation.max" => "Restorant açıklaması 250 karakterden fazla olamaz",
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
