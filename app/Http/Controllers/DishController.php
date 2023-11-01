<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Image;
use App\Models\Review;
use App\Models\Category;
use App\Models\ImageDish;
use Illuminate\Http\Request;
use App\Models\ReviewDishCrossRef;

class DishController extends Controller
{
    public function findAll(Request $request)
    {
        $dishBuilder = Dish::where('name', 'like', '%' . $request->name . '%');
        $dishes = $dishBuilder->get();
        $arrDishImg = [];
        foreach ($dishes as $dish) {
            $images = Image::whereIn('imageId', $dish->imageDish()->pluck('imageId'))->first();
            $dish['imageDish'] = $images;
            $arrDishImg[] = $dish;
        }
        return $arrDishImg;
    }

    public function findOne(string $id) {
        $dish = Dish::find($id);
        if (!$dish) {
            abort(404, 'dish does not exist');
        }
        return $dish;
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
            abort(404, 'category does not exist');
        }
        $dish = ($request->dishId) ? [
            'dishId' => $request->dishId,
            'name' => $request->name,
            'description' => $request->description,
            'cost' => $request->cost,
            'numberOfTimesCalled' => $request->numberOfTimesCalled,
            'categoryId' => $request->categoryId
        ] : [
            'name' => $request->name,
            'description' => $request->description,
            'cost' => $request->cost,
            'numberOfTimesCalled' => $request->numberOfTimesCalled,
            'categoryId' => $request->categoryId
        ];
        Dish::create($dish);

        return "success";
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
                abort(404, 'category does not exist');
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

        return "success";
    }

    public function delete(string $id)
    {
        $imageDishBuilder = ImageDish::where('dishId', '=', $id);
        $imageBuilder = Image::whereIn('imageId', $imageDishBuilder->pluck('imageId'));
        $reviewDishCrossRefBuilder = ReviewDishCrossRef::where('dishId', '=', $id);
        $reviewBuilder = Review::whereIn('reviewId', $reviewDishCrossRefBuilder->pluck('reviewId'));


        $dish = Dish::where('dishId', '=', $id)->first();
        if (!$dish) {
            abort(404, 'dish does not exist');
        }

        $dish->delete();
        $reviewBuilder->delete();
        $imageBuilder->delete();

        return "success";
    }
}
