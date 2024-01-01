<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" search="true"/>
    <div class="block relative w-full mt-14">
        @foreach ($customers as $item)
            @if ($columnRun == 0)
                @php
                    echo '<div class="flex xl:flex-row flex-col justify-evenly items-center w-full">';
                @endphp
            @endif
            <x-item-select-code customerId="{{ $item->customerId }}" status="{{ $item->code }}" />
            @if ($columnRun == 1)
                @php
                    echo '</div>';
                @endphp
            @endif
            @php
                $columnRun = ($columnRun + 1) % 2;
                $hasQuantityMoreThanZero = true;
            @endphp
            @if ($columnRun == 1 && $customers->last()->customerId == $item->customerId && $hasQuantityMoreThanZero)
                <div class="my-2 w-11/12 sm:w-96">
                    <div class="hidden md:block visible"></div>
                </div>
                @php
                    echo '</div>';
                @endphp
            @endif
        @endforeach
    </div>

    <div class="flex flex-col mt-16 mb-6 items-center mx-3">
        <button class="btn w-full sm:w-80 h-14" wire:click="$dispatch('backPrevious')">{{ __('back') }}</button>
    </div>
</div>
