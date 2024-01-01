<?php

namespace App\Livewire;

use Livewire\Component;

class Order extends Component
{

    public $customers = [];

    public function render()
    {
        $this->customers = \App\Models\Customer::where('userId', auth()->user()->id)->get();
        return view('livewire.order', ['customers' => $this->customers]);
    }
}
