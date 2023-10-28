<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function findAll(Request $request)
    {
        $categoryBuilder = Category::where('name', 'like', '%' . $request->name . '%');
        $categories = $categoryBuilder->get();

        return ['categories' => $categories];
    }

    public function findOne(string $id, Request $request)
    {
        $category = Category::where('categoryId', '=', $id)->first();
        if (!$category) {
            return ['message' => 'category does not exist'];
        }
        return ['category' => $category];
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'menuId' => 'required'
        ]);
        $menu = Menu::where('menuId', '=', $request->menuId)->first();

        if ($menu == null) {
            return ['message' => 'menu does not exist'];
        }

        $category = Category::create([
            'name' => $request->name,
            'menuId' => $menu->menuId
        ]);

        return ['category' => $category];
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'newName' => 'required'
        ]);
        $categoryBuilder = Category::where('categoryId', '=', $id);
        $category = $categoryBuilder->first();

        $category->update(['name' => $request->newName]);

        return ['category' => $category];
    }

    public function delete(string $id)
    {
        $category = Category::where('categoryId', '=', $id)->first();
        $category->delete();
        $dishBuilder = Dish::where('categoryId', '=', $id);
        $dishBuilder->delete();
        return ['category' => $category];
    }
}