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
    public $layout = 1;
    public $arrLayout = [];
    public $indexLayout = 0;

    public $zIndexSecondLayout = "z-0";
    // public $isInvisibleHome = "invisible";
    // public $isInvisibleApp = "block";

    public $isInvisibleHome = "visible";
    public $isInvisibleApp = "hidden";


    // public $arrQuantity = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0];

    public $arrQuantity = [];
    public $page = 1;
    public $columnRun = 0;
    public $hasQuantityMoreThanZero = false;

    #[Url]
    public $categoryId = 0;

    public $customerId;


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
        unset($this->arrLayout);
        $this->arrLayout = [];
        $this->indexLayout = 0;
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

    #[On('backToImgQr')]
    public function backToImgQr()
    {
        $this->layout = 5;
    }

    #[On('useCode')]
    public function useCode($index)
    {
        $this->chooseCfm();
        $this->customerId = $index;
    }

    #[On('backPrevious')]
    public function backPrevious()
    {
        $this->layout = $this->popFromArrLayout();
    }

    private function chooseLayout()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->isInvisibleHome = "invisible";
        $this->isInvisibleApp = "block";
        $this->pushToArrLayout($this->layout);
    }

    public function chooseMenu()
    {
        $this->chooseLayout();
        $this->layout = 1;
    }

    public function chooseCfm()
    {
        $this->chooseLayout();
        $this->layout = 2;
    }

    public function chooseDiscount()
    {
        $this->chooseLayout();
        $this->layout = 3;
    }

    public function chooseGenre()
    {
        $this->chooseLayout();
        $this->layout = 4;
    }

    public function chooseImageCode()
    {
        $this->chooseLayout();
        $this->layout = 5;
    }

    public function chooseOrderList()
    {
        $this->chooseLayout();
        $this->layout = 6;
    }

    #[On('chooseSelectCode')]
    public function chooseSelectCode()
    {
        $this->chooseLayout();
        $this->layout = 7;
    }

    public function chooseReview()
    {
        $this->chooseLayout();
        $this->layout = 8;
    }

    public function chooseCategory()
    {
        $this->chooseLayout();
        $this->layout = 9;
    }

}

class Node
{
    public $data;
    public $next;
    public $previous;
}

