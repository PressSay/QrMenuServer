<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Dish;
use Illuminate\Http\Request;
use App\Models\ReviewDishCrossRef;
use App\Models\ReviewBill;
use App\Models\ReviewDish;
use App\Models\ReviewCustomerCrossRef;

class ReviewController extends Controller
{
    public function findAllRevBill()
    {
        $reviews = ReviewBill::all();
        return $reviews;
    }

    public function findAllRevDish() {
        $reviews = ReviewDish::all();
        $models = [];
        foreach ($reviews as $review) {
            $models[] = [
                'customerId' => $review->customerId,
                'dishId' => $review->dishId,
                'star' => $review->star,
                'description' => $review->description,
                'revDeleted_at' => $review->revDeleted_at ?? 'NULL'
            ];
        }
        return $models;
    }

    public function findOneRevDish(string $dishId, string $customerId, Request $request)
    {
        $customer = CustomerDishCrossRef::where('dishId', '=', $dishId)->where('customerId', '=', $customerId)
            ->where('star','<>', 'NULL')->where('description', '<>', 'NULL')->first();
        if (!$customer) {
            abort(404, 'review does not exist');
        }

        $review = [
            'customerId' => $customer->customerId,
            'dishId' => $customer->dishId,
            'star' => $customer->star,
            'description' => $customer->description,
            'revDeleted_at' => $customer->revDeleted_at ?? 'NULL'
        ];

        return $review;
    }

    public function findOneRevBill(string $customerId)
    {
        $review = ReviewBill::where('customerId', '=', $customerId)->first();
        if (!$review) {
            abort(404, 'review does not exist');
        }

        return $review;
    }

    public function createRevBill(Request $request)
    {
        $request->validate([
            'customerId' => 'required',
            'isGood' => 'required',
            'description' => 'required'
        ]);

        $review = ReviewBill::create([
            'customerId' => $request->customerId,
            'star' => $request->isGood,
            'description' => $request->description
        ]);

        return "success";
    }

    public function createRevDish(Request $request)
    {
        $request->validate([
            'customerId' => 'required',
            'dishId' => 'required',
            'isGood' => 'required',
            'description' => 'required'
        ]);

        ReviewDish::create([
            'customerId' => $request->customerId,
            'dishId' => $request->dishId,
            'star' => $request->isGood,
            'description' => $request->description
        ]);

        return 'success';
    }

    public function updateRevBill(string $customerId, Request $request)
    {
        $request->validate([
            'description' => 'required',
            'isGood' => 'required',
        ]);
        // $review = Review::where('reviewId', '=', $id)->first();
        $review = ReviewBill::where('customerId', '=', $customerId)->first();
        if (!$review) {
            abort(404, 'review does not exist');
        }

        $review->update([
            'description' => $request->description,
            'star' => $request->isGood
        ]);

        return "success";
    }

    public function updateRevDish(string $dishId, string $customerId, Request $request)
    {
        $request->validate([
            'description' => 'required',
            'isGood' => 'required',
        ]);

        $reviewBuilder = CustomerDishCrossRef::where('dishId', '=', $dishId)->where('customerId', '=', $customerId);
        $review = $reviewBuilder->first();

        if (!$review) {
            abort(404, 'review does not exist');
        }

        $reviewBuilder->update([
            'description' => $request->description,
            'star' => $request->isGood,
        ]);

        return "success";
    }

    public function deleteRevDish(string $dishId, string $customerId) {
        $reviewBuilder = ReviewDish::where('dishId', '=', $dishId)->where('customerId', '=', $customerId);
        $review = $reviewBuilder->first();
        if (!$review) {
            abort(404, 'review does not exist');
        }

        $reviewBuilder->delete();

        return "success";
    }

    public function deleteRevBill(string $id) {
        $review = ReviewBill::where('customerId', '=', $id)->first();
        if (!$review) {
            abort(404, 'review does not exist');
        }

        $review->delete();

        return "success";
    }
}