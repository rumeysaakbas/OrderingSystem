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
            $store_id = "2";//user->store->id //2
            $foods = Food::where('store_id', $store_id)->get();
        }
        else
        {
            $foods = Food::where('stock', '>', 0)->get();
        }
        return view('index', compact('foods'));
    }

    // create food object
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:250",
            "stock" => "required|int|max:250|min:0",
            "explanation" => "nullable|string|max:250",
            "price" => "required|numeric|min:0",
            "images" => "nullable|array|max:5",
            "images.*" => "image|max:2048",
        ]);
        $store_id="2";
        $food = new Food;
        $food->store_id = $store_id;
        $food->name = $request->name;
        $food->stock = $request->stock;
        $food->explanation = $request->explanation;
        $food->price = $request->price;
        $food->save();

        $product_id = $food->id;
        $counter = 0;
        $images = $request->file('images');
        if($images){
            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = 'file_' . $counter . time() . '.' . $extension;
                $image->storeAs('public/photos', $fileNameToStore);

                $new_image = new Image;
                $new_image->image_path = '/storage/photos/'.$fileNameToStore;
                $new_image->product_id= $product_id;
                $new_image->save();
                $counter++;
            }
        }

        return redirect()->route('foods.index');
    }


        // update food
    public function update(Request $request, String $foodId)
    {
        $request->validate([
            "edit_food_name" => "required|string|max:250",
            "edit_food_stock" => "required|int|max:250|min:0",
            "edit_food_explanation" => "nullable|string|max:250",
            "edit_food_price" => "required|numeric|min:0",
        ]);

        $food = Food::find($foodId);
        $food->update([
            'name' => $request->input('edit_food_name'),
            'stock' => $request->input('edit_food_stock'),
            'explanation' => $request->input('edit_food_explanation'),
            'price' => $request->input('edit_food_price'),
        ]);
        return redirect()->route('foods.index');
    }


    // delete food object
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
