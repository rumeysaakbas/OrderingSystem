<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Food;
use App\Models\ValueTypes;
use App\Models\FoodRawMaterial;
use Illuminate\Support\Facades\Auth;

class FoodRawMaterialController extends Controller
{
    public function index()
    {
        $store_id = Auth::user()->store->id;
        $totalOrders = Order::where('store_id', $store_id )->sum('order_quantity');
        $foods = Food::where('store_id', $store_id)->with('order')->get();

        foreach ($foods as $food) {
            $food->order_count = $food->order->sum('order_quantity');
        }

        $value_types = ValueTypes::where('store_id', $store_id )->get();
        return view('raw_materials', compact('foods', 'totalOrders', 'value_types'));
    }



    public function create(string $foodId)
    {
        $value_types = ValueTypes::where('store_id', Auth::user()->store->id)->get();
        $food = Food::find($foodId);
        return view('add_raw_materials', compact('food', 'value_types'));
    }



    public function store(Request $request, string $foodId)
    {
        //request ->  material_name[], value_type[], material_quantity[]

        $request->validate([
            'material_name' => 'required|array',
            'material_name.*' => 'required|string|max:250',
            'value_type' => 'required|array',
            'value_type.*' => [
                'required',
                function ($value_type_item, $value, $fail) {
                    $store_id = Auth::user()->store->id;
                    $count = ValueTypes::where('id', $value)->where('store_id', $store_id)->count();
            
                    if ($count === 0) {
                        $fail('Ölçü birimi geçersiz');
                    }
                },
            ],
            'material_quantity' => 'required|array',
            'material_quantity.*' => 'required|numeric|max:100|min:1',
        ],
        [
            'material_name.required' => 'Ürün adı alanı boş bırakılamaz',
            'material_name.array' => 'Ürün adı formatı yanlış',
            'material_name.*.required' => 'Ürün adı alanı boş bırakılamaz',
            'material_name.*.max' => 'Ürün adı en fazla 250 karakter olabilir',
            'material_name.*.string' => 'Ürün adı yazı formatında olmalı',

            'value_type.required' => 'Ölçü birimi boş bırakılamaz',
            'value_type.array' => 'Ölçü birimi formatı yanlış',
            'value_type.*.required' => 'Ölçü birimi seçmelisiniz',

            'material_quantity.required' => 'Ürün miktarı alanı boş bırakılamaz',
            'material_quantity.array' => 'Ürün miktarı formatı yanlış',
            'material_quantity.*.required' => 'Ürün miktarı alanı boş bırakılamaz',
            'material_quantity.*.max' => 'Ürün miktarı en fazla 100 olabilir',
            'material_quantity.*.min' => 'Ürün miktarı en az 1 olabilir',
            'material_quantity.*.numeric' => 'Ürün miktarı sayı formatında olmalı',
        ]);

        for($i=0; $i < count($request->material_name); $i++)
        {
            $foodRawMaterial = FoodRawMaterial::create([
                'food_id' => $foodId,
                'name' => $request->material_name[$i],
                'value' => $request->material_quantity[$i],
                'value_types_id' => $request->value_type[$i],
            ]);
        }

        return redirect()->route('rawMaterial.create', $foodRawMaterial->food->id);
    }



    public function update(Request $request, String $foodRawMaterialId)
    {
        // material_name, material_quantity, value_type
        $request->validate([
            'material_name' => "required|string|max:250",
            'value_type' => ['required',        
                function ($value_type_item, $value, $fail) {
                    $store_id = Auth::user()->store->id;
                    $count = ValueTypes::where('id', $value)->where('store_id', $store_id)->count();
            
                    if ($count === 0) {
                        $fail('Ölçü birimi geçersiz');
                    }
                },
            ],
            'material_quantity' => "required|numeric|max:100|min:1",
        ],
        [
            'material_name.required' => "Ürün adı alanı boş bırakılamaz", 
            'material_name.string' => "Ürün adı yazı formatında olmalı", 
            'material_name.max' => "Ürün adı en fazla 250 karakter olabilir", 

            'value_type.required' => "Ölçü birimi boş bırakılamaz",

            'material_quantity.required' => "Ürün miktarı boş bırakılamaz", 
            'material_quantity.numeric' => "Ürün miktarı sayı formatında olmalı", 
            'material_quantity.max' => "Ürün miktarı en fazla 100 olabilir", 
            'material_quantity.min' => "Ürün miktarı en az 1 olabilir", 
        ]);
        $foodRawMaterial = FoodRawMaterial::find($foodRawMaterialId);
        $foodRawMaterial->update([
            'name' => $request->material_name,
            'value' => $request->material_quantity,
            'value_types_id' => $request->value_type,
        ]);

        return redirect()->route('rawMaterial.create', $foodRawMaterial->food->id);
    }



    public function delete(String $foodRawMaterialId)
    {
        $foodRawMaterial = FoodRawMaterial::find($foodRawMaterialId);
        $foodRawMaterial->delete();

        return redirect()->route('rawMaterial.create', $foodRawMaterial->food->id);
    }



    // value type transactions
    public function valueTypeCreate(Request $request)
    {
        $request->validate([
            "value_type" => "required|string|max:250",
        ],
        [
            "value_type.required" => "Ölçü birimi alanı boş bırakılamaz",
            "value_type.string" => "Ölçü birimi yazı formatında olmalı",
            "value_type.max" => "Ölçü birimi max 250 karakter olabilir",
        ]);

        ValueTypes::create([
            'store_id' => Auth::user()->store->id,
            'name' => $request->value_type,
        ]);

        return redirect()->route('rawMaterial.index');
    }


    public function updateValueType(Request $request, string $valueTypeId)
    {
        $request->validate([
            "edit_value_type_name" => "required|string|max:250", 
        ],
        [
            "edit_value_type_name.required" => "Ölçü birimi alanı boş bırakılamaz",
            "edit_value_type_name.string" => "Ölçü birimi yazı tipinde olmalıdır",
            "edit_value_type_name.max" => "Ölçü birimi 250 karakterden fazla olamaz",
        ]);
        $valueType = ValueTypes::find($valueTypeId);
        $valueType->update(['name' => $request->edit_value_type_name]);

        return redirect()->route('rawMaterial.index');
    }

    public function deleteValueType(string $valueTypeId)
    {
        $valueType = ValueTypes::find($valueTypeId);
        $valueType->delete();

        return redirect()->route('rawMaterial.index');
    }
}
