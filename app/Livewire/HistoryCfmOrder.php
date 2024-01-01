<?php

namespace App\Livewire;

use Livewire\Component;

class HistoryCfmOrder extends Component
{
    public $customerId = 0;
    public $hasQuantityMoreThanZero = false;
    public $columnRun = 0;
    public $customerDishCrossRefs = [];

    public function mount($customerId)
    {
        $this->customerId = $customerId;
    }

    public function render()
    {
        return view('livewire.history-cfm-order');
    }
}
