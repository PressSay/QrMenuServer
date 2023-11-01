<?php

namespace App\Http\Controllers;


use App\Models\Dish;
use App\Models\Menu;
use App\Models\Image;
use App\Models\Review;
use App\Models\Category;
use App\Models\ImageDish;
use Illuminate\Http\Request;
use App\Models\ReviewDishCrossRef;

class MenuController extends Controller
{
    public function findAll(Request $request)
    {
        $menuBuilder = Menu::where('name', 'like','%'. $request->name .'%');
        $menus = $menuBuilder->get();

        return $menus;
    }

    public function findOne(string $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            abort(404, 'menu does not exist');
        }

        return $menu;
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'isUsed' => 'required',
        ]);

        $isUsed = ($request->isUsed == 'true') ? true : false;

        $menu = Menu::where('name', '=', $request->name)->first();

        if ($menu != null) {
            abort(404, 'menu already exists');
        }

        $menu = Menu::create([
            'name' => $request->name,
            'isUsed' => $isUsed
        ]);

        return "success";
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'newName' => 'required',
            'isUsed' => 'required'
        ]);

        $menu = Menu::where('menuId', $id)->first();

        if ($menu == null) {
            abort(404, 'menu does not exist');
        }
        
        $menu->update([
            'name' => $request->newName,
            'isUsed' => $request->isUsed
        ]);

        return "success";
    }

    public function delete(string $id)
    {
        $menuBuilder = Menu::where('menuId', '=', $id);
        $menu = $menuBuilder->first();

        if (!$menu) {
            abort(404, 'menu does not exist');
        }

        $categoryBuilder = Category::where('menuId', '=', $id);
        $dishBuilder = Dish::whereIn("categoryId", $categoryBuilder->pluck('categoryId'));
        $imageDishBuilder = ImageDish::whereIn('dishId', $dishBuilder->pluck('dishId'));
        $imageBuilder = Image::whereIn('imageId', $imageDishBuilder->pluck('imageId'));
        $reviewDishCrossRefBuilder = ReviewDishCrossRef::whereIn('dishId', $dishBuilder->pluck('dishId'));
        $reviewBuilder = Review::whereIn('reviewId', $reviewDishCrossRefBuilder->pluck('reviewId'));
        
        $menuBuilder->delete();
        $categoryBuilder->delete();
        $dishBuilder->delete();
        $imageBuilder->delete();
        $reviewBuilder->delete();

        return "success";
    }
}
