<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Image;

class FoodController extends Controller
{
    public function index()
    {
        $role = "1";
        if($role === "1")
        {
            $store_id = "2";//user->store->id
            $foods = Food::where('store_id', $store_id)->get();
        }
        else
        {
            $foods = Food::all();
        }
        return view('index', compact('foods'));
    }
    public function store(Request $request)
    {
        $store_id="2";
        $food = new Food;
        $food->store_id = $store_id;
        $food->name = $request->name;
        $food->stock = $request->stock;
        $food->explanation = $request->explanation;
        $food->price = $request->price;
        $food->save();

        $product_id = $food->id;

        $images = $request->file('images');
        if($images){
            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = 'file' . time() . '.' . $extension;
                $path = $image->storeAs('public/photos', $fileNameToStore);
        
                $new_image = new Image;
                $new_image->image_path = $path;
                $new_image->product_id= $product_id;
                $new_image->save();
            }
        }
        return redirect()->route('foods.index');
    }

    public function update(Request $request, String $foodId)
    {
        $food = Food::find($foodId);
        $food->update([
            'name' => $request->input('food_name'),
            'stock' => $request->input('stock'),
            'explanation' => $request->input('explanation'),
            'price' => $request->input('price'),
        ]);
        return redirect()->route('foods.index');
    }


    public function destroy(String $foodId)
    {
        $food = Food::find($foodId);
        $images = $food->images;

        foreach($images as $image){
            $image->delete();
        }
        $food->delete();

        return redirect()->route('foods.index');
    }
}
