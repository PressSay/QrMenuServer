<div class="block relative w-full">
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
    @php
        $customerDishCrossRefs = App\Models\customerDishCrossRef::where('customerId', $customerId)->get();
        $total = 0;
    @endphp
    <div class="flex justify-center">
        <div class="mb-8 flex flex-col items-center w-11/12" style="overflow: auto; height: fit;">
            @php
                $crossRefLast = $customerDishCrossRefs->last();
            @endphp
            @foreach ($customerDishCrossRefs as $crossRef)
                @if ($crossRef->amount > 0)
                    @if ($columnRun == 0)
                        @php
                            echo '<div class="flex xl:flex-row flex-col justify-evenly items-center w-full">';
                        @endphp
                    @endif
                    @php
                        $dish = App\Models\Dish::find($crossRef->dishId);
                        $total = $total + $dish->cost * $crossRef->amount;
                    @endphp
                    <x-order-cfm-dsh mx=0 title="{{ $dish->name }}" price="{{ $dish->cost }}"
                        quantity="{{ $crossRef->amount }}"
                        onClick="" />
                    @if ($columnRun == 1)
                        @php
                            echo '</div>';
                        @endphp
                    @endif
                    @php
                        $columnRun = ($columnRun + 1) % 2;
                        $hasQuantityMoreThanZero = true;
                    @endphp
                @endif
                @php
                    $isLast = $crossRef->customerId == $crossRefLast->customerId && $crossRef->dishId == $crossRefLast->dishId;
                @endphp
                @if ($columnRun == 1 && $isLast && $hasQuantityMoreThanZero)
                    <div class="sm:w-96 rounded-tr-xlarge rounded-bl-xlarge relative mx-2 invisible">
                        <div class="hidden md:block visible"></div>
                    </div>
                    @php
                        echo '</div>';
                    @endphp
                @endif
            @endforeach
        </div>
    </div>
    @php
        $order = App\Models\Order::find($crossRefLast->customerId);
        $discount = $order->promotion;
        $discount = ($total * $discount) / 100;
        $total = $total - $discount;
    @endphp
    <div class="flex flex-col mx-2 container mx-auto mt-6">
        <div class="flex">
            <p class="font-bold text-lg mr-1">{{ __('dish.discount') }}</p>
            <p class="font-bold text-lg summary">{{ $discount }} đ</p>
        </div>
        <div class="flex">
            <p class="font-bold text-lg mr-1">{{ __('dish.tax') }}(5%): </p>
            <p class="font-bold text-lg summary">{{ $total * 0.05 }} đ</p>
        </div>
        <div class="flex">
            <p class="font-bold text-lg mr-1">{{ __('dish.total') }}</p>
            <p class="font-bold text-lg summary">{{ $total }}</p>
        </div>
    </div>
</div>
