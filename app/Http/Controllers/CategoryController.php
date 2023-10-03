<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            "category_name" => "required|string|max:250", 
        ],
        [
            "category_name.required" => "Kategori adı alanı boş bırakılamaz",
            "category_name.string" => "Kategori adı yazı tipinde olmalıdır",
            "category_name.max" => "Kategori adı 250 karakterden fazla olamaz",
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'store_id' => Auth::user()->store->id,
        ]);

        return redirect()->route('foods.index');
    }


    public function update(Request $request, String $categoryId)
    {
        $request->validate([
            "edit_category_name" => "required|string|max:250", 
        ],
        [
            "edit_category_name.required" => "Kategori adı alanı boş bırakılamaz",
            "edit_category_name.string" => "Kategori adı yazı tipinde olmalıdır",
            "edit_category_name.max" => "Kategori adı 250 karakterden fazla olamaz",
        ]);
        $category = Category::find($categoryId);
        $category->update(['category_name' => $request->edit_category_name]);

        return redirect()->route('foods.index');
    }


    public function delete(String $categoryId)
    {
        $category = Category::find($categoryId);
        $category->delete();
        return redirect()->route('foods.index');
    }


}
