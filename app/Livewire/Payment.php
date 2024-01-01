<?php

namespace App\Livewire;

use Livewire\Component;

class Payment extends Component
{

    public $typeCard = 'master';
    public $name = '';
    public $cardNumber = '';
    public $month = '';
    public $year = '';
    public $code = '';
    public $idPayment = '';

    public $layout_payment = 1;

    public function transfer()
    {
        $this->layout_payment = 1;
    }

    public function creditCard()
    {
        $this->layout_payment = 2;
    }

    public function pay()
    {
        
    }

    public function render()
    {
        return view('livewire.payment');
    }
}
