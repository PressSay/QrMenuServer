<?php

namespace App\Http\Controllers;


use App\Models\Menu;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function findAll(Request $request)
    {
        $menuBuilder = Menu::where('name', 'like','%'. $request->name .'%');
        $menus = $menuBuilder->get();

        return ['menus' => $menus];
    }

    public function findOne(string $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return ['message' => 'menu does not exist'];
        }

        return ['menu' => $menu];
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
            return ['message' => 'menu name must unique!!'];
        }

        $menu = Menu::create([
            'name' => $request->name,
            'isUsed' => $isUsed
        ]);

        return ['menu_upload' => $menu];
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'newName' => 'required',
            'isUsed' => 'required'
        ]);

        $menu = Menu::where('menuId', $id)->first();

        if ($menu == null) {
            return ['message' => 'menu does not exist'];
        }
        
        $menu->update([
            'name' => $request->newName,
            'isUsed' => $request->isUsed
        ]);

        return ['menu' => $menu];
    }

    public function delete(string $id)
    {

        $menuBuilder = Menu::where('menuId', '=', $id);
        $menu = $menuBuilder->first();

        if (!$menu) {
            return ['message' => 'menu does not exist'];
        }

        $categoryBuilder = Category::where('menuId', '=', $id);
        $dishBuilder = Dish::whereIn("categoryId", $categoryBuilder->select('categoryId')->get());

        $categories = $categoryBuilder->select('*')->get();
        $dishes = $dishBuilder->get();
        
        $menuBuilder->delete();
        $categoryBuilder->delete();
        $dishBuilder->delete();

        return [
            'menu' => $menu,
            'category' => $categories,
            'dishes' => $dishes
        ];
    }
}
