<x-qrmenu-layout>
    <x-nav-talwin-off close="{{ __('nav.close') }}" search="{{ __('nav.search') }}" home="{{ __('nav.home') }}"
            register="{{ __('nav.register') }}" category="{{ __('nav.category') }}" tableId="{{ $tableId }}"
            categoryId="{{ $categoryId }}" />

    @for ($i = 0; $i < $dishes->count(); $i += 6)
        @if ($i + 6 < $dishes->count())
            <div class="flex flex-col md:flex-row xl:flex-col md:justify-evenly sm:items-center container mx-auto">
                <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full">
                    @for ($j = 0; $j < 3; $j++)
                        <x-order-btn-dsh mx="0" title="{{ $dishes[$i + $j]->name }}"
                            description="{{ __('dish.description') }}" messDscript="{{ $dishes[$i + $j]->description }}"
                            price="{{ __('dish.price', ['cur' => number_format($dishes[$i + $j]->cost, 0)]) }}"
                            quantity="00" />
                    @endfor
                </div>
                <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full">
                    @for ($j = 3; $j < 6; $j++)
                        <x-order-btn-dsh mx="0" title="{{ $dishes[$i + $j]->name }}"
                            description="{{ __('dish.description') }}"
                            messDscript="{{ $dishes[$i + $j]->description }}"
                            price="{{ __('dish.price', ['cur' => number_format($dishes[$i + $j]->cost, 0)]) }}"
                            quantity="00" />
                    @endfor
                </div>
            </div>
        @else
            <div class="flex flex-col md:flex-row xl:flex-col md:justify-evenly sm:items-center container mx-auto">
                @if ($dishes->count() % 6 >= 3)
                    <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full">
                        @for ($j = 0; $j < 3; $j++)
                            <x-order-btn-dsh mx="0" title="{{ $dishes[$i + $j]->name }}"
                                description="{{ __('dish.description') }}"
                                messDscript="{{ $dishes[$i + $j]->description }}"
                                price="{{ __('dish.price', ['cur' => number_format($dishes[$i + $j]->cost, 0)]) }}"
                                quantity="00" />
                        @endfor
                    </div>
                    <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full">
                        @for ($j = 3; $j < $dishes->count() % 6; $j++)
                            <x-order-btn-dsh mx="0" title="{{ $dishes[$i + $j]->name }}"
                                description="{{ __('dish.description') }}"
                                messDscript="{{ $dishes[$i + $j]->description }}"
                                price="{{ __('dish.price', ['cur' => number_format($dishes[$i + $j]->cost, 0)]) }}"
                                quantity="00" />
                        @endfor
                        @for ($j = 0; $j < 3 - (($dishes->count() % 6) % 3); $j++)
                            <div class="sm:w-96 h-44 mx-2 my-4 hidden md:block"></div>
                        @endfor
                    </div>
                @else
                    <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full">
                        @for ($j = 0; $j < $dishes->count() % 6; $j++)
                            <x-order-btn-dsh mx="0" title="{{ $dishes[$i + $j]->name }}"
                                description="{{ __('dish.description') }}"
                                messDscript="{{ $dishes[$i + $j]->description }}"
                                price="{{ __('dish.price', ['cur' => number_format($dishes[$i + $j]->cost, 0)]) }}"
                                quantity="00" />
                        @endfor
                        @for ($j = 0; $j < 3 - ($dishes->count() % 6); $j++)
                            <div class="sm:w-96 h-44 mx-2 my-4 hidden xl:block"></div>
                        @endfor
                    </div>
                @endif
            </div>
        @endif
    @endfor

    <x-pay-btn order="Order" genre="Category" tableId="{{ $tableId }}" categoryId="{{ $categoryId }}" />
</x-qrmenu-layout>
