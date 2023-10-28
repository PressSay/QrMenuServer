<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Dish;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\ReviewDishCrossRef;
use App\Models\ReviewCustomerCrossRef;

class ReviewController extends Controller
{
    public function findAll(Request $request)
    {
        $models = [];

        if ($request->dish) {
            $primaryModels = ReviewDishCrossRef::all();


            foreach ($primaryModels as $primaryModel) {
                $review = Review::find($primaryModel->reviewId);
                $dish = Dish::find($primaryModel->dishId);

                $models[] = [
                    'review' => $review,
                    'dish' => $dish
                ];
            }
        } else if ($request->customer) {
            $primaryModels = ReviewCustomerCrossRef::all();

            foreach ($primaryModels as $primaryModel) {
                $review = Review::find($primaryModel->reviewId);
                $customer = Customer::find($primaryModel->customerId);

                $models[] = [
                    'review' => $review,
                    'customer' => $customer
                ];
            }
        }

        return $models;
    }
    public function findOne($id)
    {
        $review = Review::find($id);
        $reviewDishCrossRef = ReviewDishCrossRef::where('reviewId', '=', $id)->first();
        $reviewCustomerCrossRef = ReviewCustomerCrossRef::where('reviewId', '=', $id)->first();

        if ($reviewDishCrossRef != null) {
            $dish = Dish::find($reviewDishCrossRef->dishId);
            return [
                'review' => $review,
                'dish' => $dish
            ];
        } else if ($reviewCustomerCrossRef != null) {
            $customer = Customer::find($reviewCustomerCrossRef->customerId);
            return [
                'review' => $review,
                'customer' => $customer
            ];
        }

        return ['message' => 'invalid'];
    }
    public function create(Request $request)
    {
        $request->validate([
            'forDish' => 'required',
            'dishId' => 'required',
            'customerId' => 'required',
            'isGood' => 'required',
            'description' => 'required'
        ]);

        $isGood = ($request->isGood == "true") ? true : false;
        $review = Review::create([
            'star' => $isGood,
            'description' => $request->description
        ]);

        $cross = ($request->forDish == 0) ? [
            'reviewId' => $review->reviewId,
            'customerId' => $request->customerId
        ] : [
            'reviewId' => $review->reviewId,
            'dishId' => $request->dishId,
            'customerId' => $request->customerId
        ];

        if ($request->forDish != 0) {
            ReviewDishCrossRef::create($cross);
        } else {
            ReviewCustomerCrossRef::create($cross);
        }

        return [
            'review' => $review,
            'cross' => $cross
        ];
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'description' => 'required',
            'isGood' => 'required',
        ]);

        $isGood = ($request->isGood == "true") ? true : false;
        $review = Review::where('reviewId', '=', $id)->first();

        $review->update([
            'description' => $request->description,
            'star' => $isGood
        ]);

        return ['review' => $review];
    }

    public function delete(string $id)
    {
        $reviewBuilder = Review::where('reviewId', '=', $id);
        $reviewDishCrossRefBuilder = ReviewDishCrossRef::where('reviewId', '=', $id);
        $reviewCustomerCrossRefBuilder = ReviewCustomerCrossRef::where('reviewId', '=', $id);

        $review = $reviewBuilder->first();
        $reviewDishCrossRef = $reviewDishCrossRefBuilder->first();
        $reviewCustomerCrossRef = $reviewCustomerCrossRefBuilder->first();
        $cross = ($reviewDishCrossRef != null) ? $reviewDishCrossRef : $reviewCustomerCrossRef;

        $review->delete();
        $cross->delete();

        return [
            'review' => $review,
            'cross' => $cross
        ];
    }

    public function deleteAll(Request $request)
    {
        $request->validate([
            'dishId' => 'required',
            'customerId' => 'required',
            'forDish' => 'required'
        ]);

        $crossBuilder = ($request->forDish == 0) ?
            ReviewCustomerCrossRef::where('customerId', '=', $request->customerId) :
            ReviewDishCrossRef::where('dishId', '=', $request->dishId);
            
        $reviewBuilder = Review::whereIn('reviewId', $crossBuilder->select('reviewId')->get());

        $cross = $crossBuilder->get();
        $review = $reviewBuilder->get();
        $reviewBuilder->delete();
        $crossBuilder->delete();

        return [
            'review' => $review,
            'cross' => $cross
        ];
    }
}