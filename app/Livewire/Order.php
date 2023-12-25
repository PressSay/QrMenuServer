<?php

namespace App\Livewire;

use Livewire\Component;

class Order extends Component
{
    public function home()
    {
        $this->dispatch('home');
    }
    
    public function render()
    {
        return view('livewire.order');
    }
}
