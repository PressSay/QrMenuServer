<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ReviewDishCrossRef;
use App\Models\Image;

class DishController extends Controller
{
    public function findAll(Request $request)
    {
        $dishBuilder = Dish::where('name', 'like', '%' . $request->name . '%');
        $dishes = $dishBuilder->get();
        $arrDishImg = [];
        foreach ($dishes as $dish) {
            $images = Image::whereIn('imageId', $dish->imageDish()->pluck('imageId'))->first();
            $dish['images'] = $images;
            $arrDishImg[] = $dish;
        }
        return [
            'dishes' => $arrDishImg
        ];
    }

    public function findOne(string $id) {
        $dish = Dish::find($id);
        if (!$dish) {
            return ['message' => 'dish does not exist'];
        }
        return ['dish' => $dish];
    }

    public function create(Request $request)
    {
        $request->validate([
            'categoryId' => 'required',
            'name' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'numberOfTimesCalled' => 'required',
        ]);

        $category = Category::where('categoryId', '=', $request->categoryId)->first();
        if (!$category) {
            return ['message' => 'category does not exist'];
        }

        $dish = Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'cost' => $request->cost,
            'numberOfTimesCalled' => $request->numberOfTimesCalled,
            'categoryId' => $request->categoryId
        ]);

        return ['dish' => $dish];
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'numberOfTimesCalled' => 'required',
        ]);

        if ($request->categoryId) {
            $category = Category::where('categoryId', '=', $request->categoryId)->first();
            if (!$category) {
                return ['message' => 'category does not exist'];
            }
        }

        $dishBuilder = Dish::where('dishId', '=', $id);
        $dish = $dishBuilder->first();
        $dish->update([
                'name' => $request->name,
                'description' => $request->description,
                'cost' => $request->cost,
                'numberOfTimesCalled' => $request['numberOfTimesCalled'],
                'categoryId' => $request->categoryId ?? $dish->categoryId,
            ]);

        return ['dish' => $dish];
    }

    public function delete(string $id)
    {
        $reviewDishCrossRefBuilder = ReviewDishCrossRef::where('dishId', '=', $id);
        $reviewDishCrossRef = $reviewDishCrossRefBuilder->get();

        $dish = Dish::where('dishId', '=', $id)->first();
        $dish->delete();
        $reviewDishCrossRefBuilder->delete();

        return [
            'dish' => $dish,
            'reviewDishCrossRef' => $reviewDishCrossRef
        ];
    }
}
