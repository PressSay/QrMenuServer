<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use App\Models\Category as CategoryModel;


class Category extends Component
{
    public $page = 1;
    public $categories = [];

    public function mount()
    {
        $menuModel = Menu::where('isUsed', 1)->first();
        $menuId = ($menuModel) ? $menuModel->menuId : 0;
        $this->categories = CategoryModel::offset($this->page - 1)->limit(6)->get();
    }

    public function home()
    {
        $this->dispatch('home');
    }

    
    public function render()
    {
        return view('livewire.category');
    }
}
