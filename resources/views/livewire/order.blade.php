<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
    
    <div class="flex flex-col items-center h-96 mx-2" style="overflow: auto;">
        @foreach ($customers as $customer)
            @php
                $order = App\Models\Order::where('customerId', $customer->customerId)->first();
                $status = $order->status;
                $payments = $order->payments;
                $customerId = $order->customerId;
            @endphp
            <x-item-my-order status="{{ $status }}" customerId="{{ $customerId }}" payments="{{ $payments }}"/>
        @endforeach
    </div>

    {{-- padding --}}
    <div class="h-40 bottom-0 mt-10 bg-base-100"> 
    </div>
</div>
