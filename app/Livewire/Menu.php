<?php

namespace App\Livewire;

use Livewire\Component;

class Menu extends Component
{
    // 1 menu, 2 cfm, 3 discount, 4 genre, 5 imageCode, 6 orderList, 7 selectCode, 8 review
    public $layout = 1;

    public $zIndexSecondLayout = "z-0";

    public function chooseMenu()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 1;
    }

    public function chooseCfm()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 2;
    }

    public function chooseDiscount()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 3;
    }

    public function chooseGenre()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 4;
    }

    public function chooseImageCode()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 5;
    }

    public function chooseOrderList()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 6;
    }

    public function chooseSelectCode()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 7;
    }

    public function  chooseReview()
    {
        $this->zIndexSecondLayout = "z-10";
        $this->layout = 8;
    }


    public function render()
    {
        return view('livewire.menu');
    }
}
