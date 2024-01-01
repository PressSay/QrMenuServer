<?php

namespace App\Livewire;


use App\Models\Dish;
use Livewire\Component;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Models\Menu as MenuModel;
use App\Models\CustomerDishCrossRef;


class Menu extends Component
{
    // 1 menu, 2 cfm, 3 history-cfm, 4 review-thanks, 5 imageCode, 6 orderList, 7 selectCode, 8 review, 9 category, 10 payment, 11 profile
    // public $layout = 1;
    public $layout = 4;
    public $arrLayout = [];
    public $indexLayout = 0;

    public $zIndexSecondLayout = "z-0";
    public $isInvisibleHome = "invisible";
    public $isInvisibleApp = "block";

    // public $isInvisibleHome = "visible";
    // public $isInvisibleApp = "hidden";

    public $arrQuantity = [];
    public $page = 1;
    public $isMaxPage = false;
    public $columnRun = 0;
    public $hasQuantityMoreThanZero = false;

    #[Url]
    public $categoryId = 0;

    public $customerId = 0; // for discount
    public $oldCustomerId = 0; // for edit
    public $revCustomerId = 0; // for review

    public $changeDishes = false;

    public $dishes = [];

    public $user;

    public $payment = 'crash';

    public $isBill = true;


    private function pushToArrLayout($layout)
    {
        $this->arrLayout[$this->indexLayout] = $layout;
        $this->indexLayout++;
    }

    private function popFromArrLayout()
    {
        if ($this->indexLayout > 0) {
            $this->indexLayout--;
            return $this->arrLayout[$this->indexLayout];
        }
        return 1;
    }

    public function render()
    {
        $menuModel = MenuModel::where('isUsed', 1)->first();
        $menuId = ($menuModel) ? $menuModel->menuId : 0;
        $category = Category::where('menuId', $menuId)->first();
        $categoryIdL = ($category) ? $category->categoryId : $this->categoryId;
        if ($this->categoryId != 0) {
            $categoryIdL = $this->categoryId;
        }
        $this->dishes = Dish::where('categoryId', $categoryIdL)->offset(($this->page - 1) * 6)->limit(6)->get();
        $nextDishes = Dish::where('categoryId', $categoryIdL)->offset(($this->page) * 6)->limit(6)->get();
        if ($nextDishes->isEmpty()) {
            $this->isMaxPage = true;
        } else {
            $this->isMaxPage = false;
        }
        foreach ($this->dishes as $dish) {
            if (!isset($this->arrQuantity[$dish->dishId])) {
                $this->arrQuantity[$dish->dishId] = 0;
            }
        }
        $this->user = auth()->user();

        $order = Order::where('status', 'unpaid-onl')->first();
        $this->currentCustomerId = $this->oldCustomerId;
        $this->oldCustomerId = ($order) ? $order->customerId : 0;

        
        if ($this->oldCustomerId != 0) {
            $customerDishCrossRef = CustomerDishCrossRef::where('customerId', $this->oldCustomerId)->get();
            foreach ($customerDishCrossRef as $crossRef) {
                $this->arrQuantity[$crossRef->dishId] = $crossRef->amount;
            }
        } else if ($this->oldCustomerId == 0) {
            $customerDishCrossRef = CustomerDishCrossRef::where('customerId', $this->currentCustomerId)->get();
            foreach ($customerDishCrossRef as $crossRef) {
                $this->arrQuantity[$crossRef->dishId] = 0;
            }
        }
        return view('livewire.menu', [
            'dishes' => $this->dishes,
            'user' => $this->user,
            'oldCustomerId' => $this->oldCustomerId,
        ]);
    }

    #[On('home')]
    public function home()
    {
        $this->zIndexSecondLayout = "z-0";
        $this->isInvisibleHome = "visible";
        $this->isInvisibleApp = "hidden";
        unset($this->arrLayout);
        $this->arrLayout = [];
        $this->indexLayout = 0;
        $this->layout = 1;
    }

    #[On('minusFunc')]
    public function minusFunc($index)
    {
        $dish = $this->dishes[$index];
        if ($this->arrQuantity[$dish->dishId] > 0) {
            if ($this->oldCustomerId != 0) {
                CustomerDishCrossRef::where('customerId', $this->oldCustomerId)->where('dishId', $dish->dishId)->update([
                    'amount' => $this->arrQuantity[$dish->dishId] - 1,
                ]);
            }
            $this->arrQuantity[$dish->dishId] -= 1;
        }
    }

    #[On('plusFunc')]
    public function plusFunc($index)
    {
        $dish = $this->dishes[$index];
        if ($this->arrQuantity[$dish->dishId] < 99) {
            if ($this->oldCustomerId != 0) {
                CustomerDishCrossRef::where('customerId', $this->oldCustomerId)->where('dishId', $dish->dishId)->update([
                    'amount' => $this->arrQuantity[$dish->dishId] + 1,
                ]);
            }
            $this->arrQuantity[$dish->dishId] += 1;
        }
    }

    #[On('changeCategoryId')]
    public function changeCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->page = 1;
        $this->layout = 1;
    }

    #[On('trashCfm')]
    public function trashCfm($dishId)
    {
        CustomerDishCrossRef::where('customerId', $this->oldCustomerId)->where('dishId', $dishId)->update([
            'amount' => 0,
        ]);
        $this->arrQuantity[$dishId] = 0;
    }

    #[On('backToImgQr')]
    public function backToImgQr()
    {
        $this->layout = 5;
    }

    #[On('useCode')]
    public function useCode($index)
    {
        $this->chooseLayout(2);
        $this->customerId = $index;
    }

    #[On('backPrevious')]
    public function backPrevious()
    {
        $this->layout = $this->popFromArrLayout();
    }

    public function nextPage()
    {
        if (!$this->isMaxPage) {
            $this->page++;
            $this->changeDishes = true;
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->changeDishes = true;
        }

    }

    #[On('chooseLayout')]
    public function chooseLayout($layout)
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return;
        }
        $this->pushToArrLayout($this->layout);
        $this->layout = $layout;
    }


    public function payCfm()
    {
        if ($this->user == null) {
            return;
        }

        $oldCustomer = Customer::find($this->customerId);
        if ($this->oldCustomerId != 0) {
            $order = Order::where('customerId', $this->oldCustomerId)->where('status', 'unpaid-onl')->first();
            if ($oldCustomer) {
                $order->update([
                    'promotion' => env('DISCOUNT'),
                ]);
                $oldCustomer->update([
                    'dateExpireCode' => date('Y-m-d H:i:s'),
                ]);
                $this->customerId = 0;
            }
            if (!$order) {
                $customerDishCrossRef = CustomerDishCrossRef::where('customerId', $this->oldCustomerId)->get();
                foreach ($customerDishCrossRef as $crossRef) {
                    $this->arrQuantity[$crossRef->dishId] = 0;
                }
                $this->oldCustomerId = 0;
                $this->home();
                return;
            }
            foreach ($this->arrQuantity as $dishId => $amount) {
                if ($amount > 0) {
                    $customerDishCrossRef = CustomerDishCrossRef::where('customerId', $this->oldCustomerId)->where('dishId', $dishId)->first();
                    if ($customerDishCrossRef) {
                        $customerDishCrossRef->update([
                            'amount' => $amount,
                        ]);
                    } else {
                        CustomerDishCrossRef::create([
                            'customerId' => $this->oldCustomerId,
                            'dishId' => $dishId,
                            'amount' => $amount,
                        ]);
                    }
                }
            }
            $this->home();
            return;
        }

        
        $newCustomer = Customer::create([
            'userId' => $this->user->id,
            'dateExpireCode' => date('y-m-d', strtotime("+3 day", time() - 86400)),
            'name' => $this->user->name,
            'code' => md5(microtime()),
            'phoneNumber' => $this->user->phoneNumber,
            'address' => $this->user->address,
        ]);
        $order = Order::create([
            'customerId' => $newCustomer->customerId,
            'status' => 'unpaid-onl',
            'payments' => $this->payment,
            'nameTable' => 0,
        ]);
        if ($oldCustomer) {
            $order->update([
                'promotion' => env('DISCOUNT'),
            ]);
            $oldCustomer->update([
                'dateExpireCode' => date('Y-m-d H:i:s'),
            ]);
            $this->customerId = 0;
        }
        foreach ($this->arrQuantity as $dishId => $amount) {
            if ($amount > 0) {
                CustomerDishCrossRef::create([
                    'customerId' => $newCustomer->customerId,
                    'dishId' => $dishId,
                    'amount' => $amount,
                ]);
                $this->arrQuantity[$dishId] = 0;
            }
        }

        $this->oldCustomerId = $newCustomer->customerId;
        $this->home();

        if ($this->payment != 'crash') {
            $this->chooseLayout(10);
        }
    }

    #[On('viewHistoryOrder')]
    public function viewHistoryOrder($customerId)
    {
        $this->chooseLayout(3);
        $this->revCustomerId = $customerId;
    }
    
    #[On('notify')]
    public function notify($isBill)
    {
        $this->chooseLayout(4);
        $this->isBill = $isBill;
    }
}

