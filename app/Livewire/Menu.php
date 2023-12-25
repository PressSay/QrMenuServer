<?php

namespace App\Livewire;


use App\Models\Dish;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Models\Menu as MenuModel;

class Menu extends Component
{
    // 1 menu, 2 cfm, 3 discount, 4 genre, 5 imageCode, 6 orderList, 7 selectCode, 8 review, 9 category
    public $layout = 5;
    public $zIndexSecondLayout = "z-0";
    public $isInvisibleHome = "visible";
    public $isInvisibleApp = "hidden";
    
    // public $arrQuantity = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0];

    public $arrQuantity = [];
    public $page = 1;
    public $columnRun = 0;
    public $hasQuantityMoreThanZero = false;

    #[Url]
    public $categoryId = 0;


    public function render()
    {
        $menuModel = MenuModel::where('isUsed', 1)->first();
        $menuId = ($menuModel) ? $menuModel->menuId : 0;
        $category = Category::where('menuId', $menuId)->first();
        $categoryIdL = ($category) ? $category->categoryId : $this->categoryId;
        if ($this->categoryId != 0) {
            $categoryIdL = $this->categoryId;
        }
        $dishes = Dish::where('categoryId', $categoryIdL)->offset($this->page - 1)->limit(6)->get();
        foreach ($dishes as $dish) {
            if (!isset($this->arrQuantity[$dish->dishId]))
                $this->arrQuantity[$dish->dishId] = 0;
        }
        return view('livewire.menu', ['dishes' => $dishes]);
    }

    #[On('home')]
    public function home()
    {
        $this->zIndexSecondLayout = "z-0";
        $this->isInvisibleHome = "visible";
        $this->isInvisibleApp = "hidden";
        $this->layout = 1;
    }

    #[On('minusFunc')]
    public function minusFunc($index)
    {   
        if ($this->arrQuantity[$index] > 0)
            $this->arrQuantity[$index] -= 1;
    }

    #[On('plusFunc')]
    public function plusFunc($index)
    {
        if ($this->arrQuantity[$index] < 99)
            $this->arrQuantity[$index] += 1;
    }

    #[On('changeCategoryId')]
    public function changeCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->page = 1;
        $this->layout = 1;
    }

    #[On('trashCfm')]
    public function tranhCfm($index)
    {
        $this->arrQuantity[$index] = 0;
    }

    #[On('backToCfm')]
    public function backToCfm()
    {
        $this->layout = 2;
    }

    public function chooseMenu()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 1;
    }

    public function chooseCfm()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 2;
    }

    public function chooseDiscount()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 3;
    }

    public function chooseGenre()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 4;
    }

    public function chooseImageCode()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 5;
    }

    public function chooseOrderList()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 6;
    }

    #[On('chooseSelectCode')]
    public function chooseSelectCode()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 7;
    }

    public function  chooseReview()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 8;
    }

    public function chooseCategory()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->layout = 9;
    }

}
