<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\Customer;
use App\Models\ReviewBill;
use App\Models\ReviewDish;
use App\Models\CustomerDishCrossRef;

class Review extends Component
{
    public $isBill = true;
    public $reviewChoose = 'a';

    public $reviewDishChoose = 'b';

    public $content = '';
    public $thumpUp = 0;
    public $isContent = 'false';

    public $firstRevChoose;
    public $firstRevDishChoose;

    public function toggleBill()
    {
        $this->isBill = !$this->isBill;
    }

    public function chooseReview($reviewChoose)
    {
        $this->reviewChoose = $reviewChoose;
    }

    public function chooseReviewDish($reviewDishChoose)
    {
        $this->reviewDishChoose = $reviewDishChoose;
    }

    public function submit()
    {
        if ($this->content != '' && $this->thumpUp != 0) {            
            if ($this->isBill) {
                $customerId = $this->reviewChoose;
                if ($customerId == 'a') {
                    $customerId = $this->firstRevChoose;
                }
                ReviewBill::create([
                    'customerId' => $customerId,
                    'description' => $this->content,
                    'star' => $this->thumpUp,
                ]);
            } else {
                $dishId = $this->firstRevDishChoose;
                $customerId = $this->firstRevDishChoose;
                if ($this->reviewDishChoose != 'b') {
                    $arr = explode('-', $this->reviewDishChoose);
                    $dishId = $arr[0];
                    $customerId = $arr[1];
                }
                ReviewDish::create([
                    'customerId' => $customerId,
                    'dishId' => $dishId,
                    'description' => $this->content,
                    'star' => $this->thumpUp,
                ]);
            }
            $this->dispatch('notify', isBill: $this->isBill);
            $this->isContent = 'true';
            $this->content = '';
        }
    }

    public function toggleThump($isThumpUp)
    {
        if ($isThumpUp == true) {
            if ($this->thumpUp != 1) {
                $this->thumpUp = 1;
            } else {
                $this->thumpUp = 0;
            }
        } else {
            if ($this->thumpUp != -1) {
                $this->thumpUp = -1;
            } else {
                $this->thumpUp = 0;
            }
        }
    }


    public function render()
    {
        $user = auth()->user();
        $customers = Customer::where('userId', $user->id)->get();
        $reviews = [];
        $reviewDishes = [];

        foreach ($customers as $customer) {
            $review = ReviewBill::where('customerId', $customer->customerId)->first();
            $order = Order::where('customerId', $customer->customerId)->first();
            $isNotHaveReview = $review == null && $order->status != 'unpaid-onl';
            $customerDishCrossRefs = CustomerDishCrossRef::where('customerId', $customer->customerId)->where('amount', '>', 0)->get();
            if ($isNotHaveReview) {
                $reviews[] = $customer;
            }
            foreach ($customerDishCrossRefs as $crossRef) {
                $reviewDish = ReviewDish::where('customerId', $customer->customerId)
                    ->where('dishId', $crossRef->dishId)
                    ->first();
                $isNotHaveReviewDish = $reviewDish == null && $order->status != 'unpaid-onl';
                if ($isNotHaveReviewDish) {
                    $reviewDishes[] = $crossRef;
                }
            }
        }

        $this->firstRevChoose = count($reviews) > 0 ? $reviews[0]->customerId : 'a';
        $this->firstRevDishChoose = count($reviewDishes) > 0 ? $reviewDishes[0]->dishId : 'b';

        return view('livewire.review', ['user' => $user, 'customers' => $reviews, 'customerDishCrossRefs' => $reviewDishes]);
    }
}
