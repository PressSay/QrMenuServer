<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Select extends Component
{
    public $hasQuantityMoreThanZero = false;
    public $isPaid = 'paid-onl';

    public $columnRun = 0;
    

    public function render()
    {
        $user = Auth::user();
        if ($user == null) {
            $user = User::find(1);
        }
        $orders = Order::where('status', 'like', $this->isPaid)->get();
        $customers = Customer::whereIn('customerId', $orders->pluck('customerId'))
            ->where('userId', $user->id)->where('dateExpireCode', '>', \Carbon\Carbon::now())->get();
        return view('livewire.select', ['customers' => $customers]);
    }
}
