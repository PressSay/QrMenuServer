<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Customer;
use App\Models\CustomerDishCrossRef;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // protected $customer;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        // careful $this->customerId not $this->$customerId
        // $this->customer = $customer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('channel-order'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'order-notification';
    }

    public function broadcastWith(): array
    {
        // $model = Customer::find($this->customer->customerId);
        // $customerDishCrossRef = CustomerDishCrossRef::where('customerId', '=', $model->customerId)->get();
        // $order = Order::where('customerId', '=', $model->customerId)->first();
        // $model->orderId = $order->customerId;
        // $model->status = $order->status;
        // $model->promotion = $order->promotion;
        // $model->payments = $order->payments;
        // $model->tableId = $order->nameTable;
        // $model->customerDishCrossRefs = $customerDishCrossRef;
        
        // return $model->toArray();
        return ["hi"];
    }
}
