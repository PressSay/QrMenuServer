<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Image;
use App\Models\Category;
use App\Models\ImageDish;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function findAll(Request $request)
    {
        $categoryBuilder = Category::where('name', 'like', '%' . $request->name . '%');
        $categories = $categoryBuilder->get();

        return $categories;
    }

    public function findOne(string $id, Request $request)
    {
        $category = Category::where('categoryId', '=', $id)->first();
        if (!$category) {
            abort(404, 'category does not exist');
        }
        return $category;
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'menuId' => 'required'
        ]);
        $menu = Menu::where('menuId', '=', $request->menuId)->first();

        if ($menu == null) {
            abort(404, 'menu does not exist');
        }

        $category = ($request->categoryId == null) ? [
            'name' => $request->name,
            'menuId' => $menu->menuId
        ] : [
            'categoryId' => $request->categoryId,
            'name' => $request->name,
            'menuId' => $menu->menuId
        ];
        Category::create($category);

        return "success";
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'newName' => 'required'
        ]);
        $categoryBuilder = Category::where('categoryId', '=', $id);
        $category = $categoryBuilder->first();

        if (!$category) {
            abort(404, 'category does not exist');
        }

        $category->update(['name' => $request->newName]);

        return "success";
    }

    public function delete(string $id)
    {
        $category = Category::where('categoryId', '=', $id)->first();
        if (!$category) {
            abort(404, 'category does not exist');
        }
        $category->delete();
        $dishBuilder = Dish::where('categoryId', '=', $id);
        $imageDishBuilder = ImageDish::whereIn('dishId', $dishBuilder->pluck('dishId'));
        $imageBuilder = Image::whereIn('imageId', $imageDishBuilder->pluck('imageId'));

        $imageBuilder->delete();
        $dishBuilder->delete();
        return "success";
    }
}