<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Image;
use App\Models\Order;
use App\Models\Category;
use App\Models\CategoryAndFood;
use App\Models\NutritionalValue;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index()
    {
        
        if(Auth::user()->role === "seller")
        {
            $store_id = Auth::user()->store->id;
            $foods = Food::where('store_id', $store_id)->get();
            $categories = Category::where('store_id', $store_id)->get();
            return view('index', compact('foods', 'categories'));
        }
        else
        {
            $foods = Food::where('stock', '>', 0)->get();
            return view('index', compact('foods'));
        }
        
    }

    // create food object
    public function create()
    {
        $categories = Category::where('store_id', Auth::user()->store->id)->get();
        return view('create_food', compact('categories'));
    }


    // save the food object
    public function store(Request $request)
    {        
        $request->validate([
            "name" => "required|string|max:250",
            "category" => ["required",
                function ($attribute, $value, $fail) {
                    $store_id = Auth::user()->store->id;
                    if (Category::where('id', $value)->where('store_id', $store_id)->doesntExist())
                    {
                        $fail('Kategori geçersiz');
                    }
                },
            ],
            "stock" => "required|int|max:250|min:0",
            "explanation" => "nullable|string|max:250",
            "price" => "required|numeric|min:0",
            "images" => "nullable|array|max:5",
            "images.*" => "image|max:2048",
            "nutritional_type" => [
                'nullable', 'json',
                function ($attribute, $value, $fail) {
                    $data = json_decode($value, true);
                    if (!is_array($data)) {
                        $fail('Besin değerleri dosya türü yanlış');
                        return;
                    }
                    foreach ($data as $key => $val) {
                        if (!in_array($key, ['1', '2', '3', '4']))
                        {
                            $fail('Besin değerlerinin türü belirtilen değerler dışında olamaz');
                            return;
                        }
                        if(!is_numeric($val))
                        {
                            $fail('Besin değerleri sayısal veri olmalıdır');
                            return;
                        }
                    }
                },
            ],
        ],
        [
            "name.required" => "Yemek adı alanı boş bırakılamaz",
            "name.max" => "Yemek adı 250 karakterden fazla olamaz",

            "category.required" => "Kategori boş bırakılamaz",

            "stock.required" => "Stok bilgisi boş bırakılamaz",
            "stock.int" => "Stok sayı tipinde olmalı",
            "stock.max" => "Stok 250'den fazla olamaz",
            "stock.min" => "Stok 0'dan az olamaz",

            "explanation.max" => "Açıklama 250 karakterden fazla olamaz",

            "price.required" => "Fiyat bilgisi boş bırakılamaz",
            "price.numeric" => "Fiyat sayı tipinde olmalıdır",
            "price.min" => "Fiyat 0'dan az olamaz",

            "images.max" => "En fazla 5 resim yükleyebilirsiniz",
            "images.*.image" => "Sadece resim formatında dosya yükleyebilirsiniz",
            "images.*.max" => "En fazla 2 MB boyutunda resim yükleyebilirsiniz",
        ]);

        // save the food
        $food = new Food;
        $food->store_id = Auth::user()->store->id;
        $food->name = $request->name;
        $food->stock = $request->stock;
        $food->explanation = $request->explanation;
        $food->price = $request->price;
        $food->save();

        $food_id = $food->id;
        // save the category
        CategoryAndFood::create([
            'category_id' => $request->category,
            'food_id' => $food_id,
        ]);

        // save the images
        $counter = 0;
        $images = $request->file('images');
        if($images){
            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = 'file_' . $counter . time() . '.' . $extension;
                $image->storeAs('public/photos', $fileNameToStore);

                $new_image = new Image;
                $new_image->image_path = '/storage/photos/'.$fileNameToStore;
                $new_image->product_id= $food_id;
                $new_image->save();
                $counter++;
            }
        }

        // save the nutritional values
        $nutritionalTypes = json_decode($request->input('nutritional_type'), true);
        // 1->calory  2->protein  3->carbohydrate  4->fat
        if($nutritionalTypes)
        {
            foreach($nutritionalTypes as $type => $value)
            {
                $nutritional_value = new NutritionalValue;
                $nutritional_value->food_id = $food_id;
                $nutritional_value->value = $value;
                switch($type){
                    case "1":
                        $nutritional_value->type = "calory";
                        break;
                    case "2":
                        $nutritional_value->type = "protein";
                        break;
                    case "3":
                        $nutritional_value->type = "carbohydrate";
                        break;
                    case "4":
                        $nutritional_value->type = "fat";
                        break;
                }
                $nutritional_value->save();
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
        ],
        [
            "edit_food_name.required" => "Yemek adı alanı boş bırakılamaz",
            "edit_food_name.string" => "Yemek adı yazı tipinde olmalı",
            "edit_food_name.max" => "Yemek adı 250 karakterden fazla olamaz",

            "edit_food_stock.required" => "Stok bilgisi boş bırakılamaz",
            "edit_food_stock.int" => "Stok sayı tipinde olmalıdır",
            "edit_food_stock.max" => "Stok 250'den fazla olamaz",
            "edit_food_stock.min" => "Stok 0'dan az olamaz",

            "edit_food_explanation.max" => "Açıklama 250 karakterden fazla olamaz",

            "edit_food_price.required" => "Fiyat bilgisi boş bırakılamaz",
            "edit_food_price.numeric" => "Fiyat sayı tipinde olmalı",
            "edit_food_price.min" => "Fiyat 0'dan az olamaz",
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
        foreach($images as $image)
        {
            $image->delete();
        }

        $nutritionalValues = $food->nutritionalValues;
        foreach($nutritionalValues as $nv)
        {
            $nv->delete();
        }

        $food_raw_materials = $food->foodRawMaterials;
        foreach($food_raw_materials as $food_raw_material)
        {
            $food_raw_material->delete();
        }

        CategoryAndFood::where('food_id', $food->id)->delete();
        $food->delete();

        return redirect()->route('foods.index');
    }

}
