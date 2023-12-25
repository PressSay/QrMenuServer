<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Select extends Component
{
    public $hasQuantityMoreThanZero = false;

    public $columnRun = 0;

    public function render()
    {
        $user = Auth::user();
        if ($user == null) {
            $user = User::find(1);
        }
        $customers = Customer::where('userId', $user->id)->get();
        return view('livewire.select', ['customers' => $customers]);
    }
}
