<div class="container mx-auto">
    <div class="md:flex md:flex-row-reverse relative">
        <div id="app-container"
            class="w-full md:w-1/2 xl:w-2/3 {{ $zIndexSecondLayout }} md:z-0 md:mx-1.5 md:relative absolute top-0 bg-base-100 h-screen {{ $isInvisibleApp }} md:block">
            @switch($layout)
                @case(2)
                    <div class="block relative w-full">
                        <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
                        @php
                            $total = 0;
                        @endphp
                        <div class="flex justify-center">
                            <div class="mb-8 flex flex-col items-center w-11/12" style="overflow: auto; height: fit;">
                                @foreach ($arrQuantity as $key => $item)
                                    @if ($item > 0)
                                        @if ($columnRun == 0)
                                            @php
                                                echo '<div class="flex xl:flex-row flex-col justify-evenly items-center w-full">';
                                            @endphp
                                        @endif
                                        @php
                                            $dish = App\Models\Dish::find($key);
                                            $total = $total + $dish->cost * $item;
                                        @endphp
                                        <x-order-cfm-dsh mx=0 title="{{ $dish->name }}" price="{{ $dish->cost }}"
                                            quantity="{{ $item }}"
                                            onClick="$dispatch('trashCfm', { index: {{ $key }} })" />
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
                                    @if ($columnRun == 1 && array_key_last($arrQuantity) == $key && $hasQuantityMoreThanZero)
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
                        <div class="flex flex-col mx-2 container mx-auto mt-6">
                            <div class="flex">
                                <p class="font-bold text-lg mr-1">{{ __('dish.discount') }}</p>
                                <p class="font-bold text-lg summary">6,000đ</p>
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
                        <div class="flex flex-col mx-2 sticky right-0 left-0 bottom-0">
                            <div class="my-1 flex justify-center">
                                {{ $customerId }}
                            </div>
                            <div class="flex justify-evenly items-center mx-1.5 ">
                                <button wire:click="chooseMenu"
                                    class="btn w-1/3 mx-1 my-3 rounded shadow-xl text-xs 
                                sm:text-sm md:text-base border-2 btn-outline btn-base-content bg-base-100">{{ __('Menu') }}</button>
                                <button wire:click="chooseImageCode"
                                    class="btn w-1/3 mx-1 my-3 rounded shadow-xl text-xs 
                                sm:text-sm md:text-base border-2 btn-outline btn-base-content bg-base-100">{{ __('QrCode') }}</button>
                                <button wire:click="chooseMenu"
                                    class="pay-cfm btn w-1/3 mx-1 my-3 rounded shadow-xl text-xs 
                                sm:text-sm md:text-base border-2 btn-outline btn-base-content bg-base-100">{{ __('order') }}</button>
                            </div>
                        </div>
                    </div>
                @break

                @case(3)
                    <livewire:discount />
                @break

                @case(4)
                    <livewire:genre />
                @break

                @case(5)
                    <livewire:image />
                @break

                @case(6)
                    <livewire:order />
                @break

                @case(7)
                    <livewire:select />
                @break

                @case(8)
                    <livewire:review />
                @break

                @case(9)
                    <livewire:category />
                @break

                @case(1)
                    <div class="block relative w-full ">
                        <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
                        <div class="mb-8 flex flex-col items-center w-full" style="overflow: auto; height: fit;">
                            @for ($i = 0; $i < $dishes->count(); $i += 2)
                                <div class="flex xl:flex-row flex-col justify-evenly items-center w-full">
                                    <x-order-btn-dsh-onl mx="0" title="{{ $dishes[$i]->name }}"
                                        description="{{ __('dish.description') }}"
                                        messDscript="{{ $dishes[$i]->description }}"
                                        price="{{ __('dish.price', ['cur' => number_format($dishes[$i]->cost, 0)]) }}"
                                        quantity="{{ $arrQuantity[$dishes[$i]->dishId] }}"
                                        plusFunc="$dispatch('plusFunc', { index: {{ $dishes[$i]->dishId }} })"
                                        minusFunc="$dispatch('minusFunc', { index: {{ $dishes[$i]->dishId }} })" />
                                    @if ($i + 1 < $dishes->count())
                                        <x-order-btn-dsh-onl mx="0" title="{{ $dishes[$i + 1]->name }}"
                                            description="{{ __('dish.description') }}"
                                            messDscript="{{ $dishes[$i + 1]->description }}"
                                            price="{{ __('dish.price', ['cur' => number_format($dishes[$i + 1]->cost, 0)]) }}"
                                            quantity="{{ $arrQuantity[$dishes[$i + 1]->dishId] }}"
                                            plusFunc="$dispatch('plusFunc', { index: {{ $dishes[$i + 1]->dishId }} })"
                                            minusFunc="$dispatch('minusFunc', { index: {{ $dishes[$i + 1]->dishId }} })" />
                                    @else
                                        <div class="sm:w-80 rounded-tr-xlarge rounded-bl-xlarge relative mx-2 invisible">
                                            <div class="hidden md:block visible"></div>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                        <div class="flex flex-col mx-2 sticky right-0 left-0 bottom-0">
                            <div class="my-1 flex justify-center">
                                {{ $categoryId }}
                            </div>
                            <div class="flex justify-evenly items-center ">
                                <button wire:click="chooseCategory"
                                    class="btn w-1/2 mx-1 my-3 rounded shadow-xl text-xs sm:text-sm md:text-base border-2 btn-outline btn-base-content bg-base-100">{{ __('category') }}</button>
                                <button wire:click="chooseCfm"
                                    class="pay-cfm btn w-1/2 mx-1 my-3 rounded shadow-xl text-xs sm:text-sm md:text-base border-2 btn-outline btn-base-content bg-base-100">{{ __('order') }}</button>
                            </div>
                        </div>
                    </div>
                @break

            @endswitch

        </div>
        <div
            class="w-full md:w-1/2 xl:w-1/3 z-0 relative absolute h-screen bg-base-100 {{ $isInvisibleHome }} md:visible">
            <div class="flex justify-between mb-2 z-10">
                <button class="btn p-2 shadow-md my-1.5 mx-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" height="34" viewBox="0 -960 960 960" width="34">
                        <path class="fill-base-content"
                            d="M160-200v-60h80v-304q0-84 49.5-150.5T420-798v-22q0-25 17.5-42.5T480-880q25 0 42.5
                                                    17.5T540-820v22q81 17 130.5 83.5T720-564v304h80v60H160Zm320-302Zm0 422q-33 0-56.5-23.5T400-160h160q0
                                                    33-23.5 56.5T480-80ZM300-260h360v-304q0-75-52.5-127.5T480-744q-75 0-127.5 52.5T300-564v304Z" />
                    </svg>
                </button>
                <button class="btn p-2 shadow-md my-1.5 mx-1.5">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-base-content" d="M16 15C13.8 15 12 14.3 10.6 12.9C9.2 11.5 8.5 9.7 8.5 7.5C8.5 5.3 9.2 3.5
                                                    10.6 2.1C12 0.7 13.8 0 16 0C18.2 0 20 0.7 21.4 2.1C22.8 3.5 23.5 5.3 23.5 7.5C23.5
                                                    9.7 22.8 11.5 21.4 12.9C20 14.3 18.2 15 16 15ZM0 31.05V26.35C0 25.0833 0.316667 24
                                                    0.95 23.1C1.58333 22.2 2.4 21.5167 3.4 21.05C5.63333 20.05 7.775 19.3 9.825 18.8C11.875
                                                    18.3 13.9333 18.05 16 18.05C18.0667 18.05 20.1167 18.3083 22.15 18.825C24.1833 19.3417
                                                    26.3154 20.0866 28.5461 21.0597C29.5894 21.5306 30.4259 22.2133 31.0556 23.108C31.6852
                                                    24.0027 32 25.0833 32 26.35V31.05H0ZM3 28.05H29V26.35C29 25.8167 28.8417 25.3083 28.525
                                                    24.825C28.2083 24.3417 27.8167 23.9833 27.35 23.75C25.2167 22.7167 23.2667 22.0083 21.5
                                                    21.625C19.7333 21.2417 17.9 21.05 16 21.05C14.1 21.05 12.25 21.2417 10.45 21.625C8.65 22.0083
                                                    6.7 22.7167 4.6 23.75C4.13333 23.9833 3.75 24.3417 3.45 24.825C3.15 25.3083 3 25.8167 3 26.35V28.05ZM16
                                                    12C17.3 12 18.375 11.575 19.225 10.725C20.075 9.875 20.5 8.8 20.5 7.5C20.5 6.2 20.075 5.125 19.225
                                                    4.275C18.375 3.425 17.3 3 16 3C14.7 3 13.625 3.425 12.775 4.275C11.925 5.125 11.5 6.2 11.5 7.5C11.5
                                                    8.8 11.925 9.875 12.775 10.725C13.625 11.575 14.7 12 16 12Z"
                            fill="#3C691B" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-col items-center">
                <h6 class="text-base font-bold text-center">Amount of review</h6>
                <div class="flex justify-center items-center">
                    <h4 class="text-xl font-bold text-center mr-1">0</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path class="fill-base-content"
                            d="m323-205 157-94 157 95-42-178 138-120-182-16-71-168-71 167-182 16 138 120-42
                                                    178ZM233-80l65-281L80-550l288-25 112-265 112 265 288 25-218 189 65 281-247-149L233-80Zm247-355Z" />
                    </svg>
                </div>
            </div>
            <div class="h-3/5">
                <div class="pb-20 h-full w-full bg-base-200 rounded-tr-xlarge rounded-tl-xlarge ">
                    <div class="font-bold text-center my-0.5">
                        Most popular
                    </div>
                    <div class="carousel w-full mb-0.5">
                        <div id="item1" class="carousel-item w-full flex justify-center">
                            <x-carousel-item />
                            <x-carousel-item />
                            <x-carousel-item />
                        </div>
                        <div id="item2" class="carousel-item w-full flex justify-center">
                            <x-carousel-item />
                            <x-carousel-item />
                            <x-carousel-item />
                        </div>
                        <div id="item3" class="carousel-item w-full flex justify-center">
                            <x-carousel-item />
                            <x-carousel-item />
                            <x-carousel-item />
                        </div>
                    </div>
                    <div class="flex justify-center w-full py-2 gap-2">
                        <a href="#item1" class="btn btn-xs">1</a>
                        <a href="#item2" class="btn btn-xs">2</a>
                        <a href="#item3" class="btn btn-xs">3</a>
                    </div>
                </div>

            </div>
            <div class="absolute w-full bg-base-100 rounded-tr-xlarge rounded-tl-xlarge h-80"
                style="top: max(60%, 20rem)">
                <div class="flex justify-evenly my-4">
                    <x-btn-nav-layout title="Review" onClick="chooseReview">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960"
                            width="48">
                            <path class="fill-base-content"
                                d="m363-390 117-71 117 71-31-133 104-90-137-11-53-126-53 126-137 11
                                                        104 90-31 133ZM80-80v-740q0-24 18-42t42-18h680q24 0 42 18t18 42v520q0
                                                        24-18 42t-42 18H240L80-80Zm134-220h606v-520H140v600l74-80Zm-74 0v-520 520Z" />
                        </svg>
                    </x-btn-nav-layout>
                    <x-btn-nav-layout title="My Order" onClick="chooseOrderList">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960"
                            width="48">
                            <path class="fill-base-content"
                                d="M663-149h40v-160h-40v160Zm100 0h40v-160h-40v160ZM240-620h480v-60H240v60ZM732.5-41Q655-41
                                                        600-96.5T545-228q0-78.435 54.99-133.717Q654.98-417 733-417q77 0 132.5 55.283Q921-306.435 921-228q0
                                                        76-55.5 131.5T732.5-41ZM120-81v-699q0-24.75 17.625-42.375T180-840h600q24.75 0 42.375
                                                        17.625T840-780v327q-14.169-6.857-29.085-11.429Q796-469 780-472v-308H180v599h310q2.885 18.172 8.942
                                                        34.586Q505-130 513-114l-33 33-60-60-60 60-60-60-60 60-60-60-60 60Zm120-199h252.272q3.728-16
                                                        8.228-31t12.5-29H240v60Zm0-170h384q22-11 46-17.5t50-8.5v-34H240v60Zm-60 269v-599 599Z" />
                        </svg>
                    </x-btn-nav-layout>
                </div>
                <div class="flex justify-evenly mt-4">
                    <x-btn-nav-layout title="Book At Store" onClick="">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960"
                            width="48">
                            <path class="fill-base-content"
                                d="m240-160 60-150q9-23 29-36.5t45-13.5h76v-161q-159-5-264.5-45T80-660q0-58 117-99t283-41q166 0 283
                                                        41t117 99q0 54-105.5 94T510-521v161h76q24 0 44.5 13.5T660-310l60 150h-60l-55-140H356l-56 140h-60Zm240-420q108
                                                        0 202-22t143-58q-49-36-143-58t-202-22q-108 0-202 22t-143 58q49 36 143 58t202 22Zm0-80Z" />
                        </svg>
                    </x-btn-nav-layout>
                    <x-btn-nav-layout title="Online Store" onClick="chooseMenu">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960"
                            width="48">
                            <path class="fill-base-content"
                                d="M220-80q-24 0-42-18t-18-42v-520q0-24 18-42t42-18h110v-10q0-63 43.5-106.5T480-880q63 0
                                                        106.5 43.5T630-730v10h110q24 0 42 18t18 42v520q0 24-18 42t-42 18H220Zm0-60h520v-520H630v90q0 12.75-8.675
                                                        21.375-8.676 8.625-21.5 8.625-12.825 0-21.325-8.625T570-570v-90H390v90q0 12.75-8.675 21.375-8.676 8.625-21.5 8.625-12.825
                                                        0-21.325-8.625T330-570v-90H220v520Zm170-580h180v-10q0-38-26-64t-64-26q-38 0-64 26t-26 64v10ZM220-140v-520 520Z" />
                        </svg>
                    </x-btn-nav-layout>
                </div>
            </div>
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my_modal_6" class="modal-toggle" />
    <div class="modal ">
        <div class="modal-box">
            <div class="flex justify-center mb-4">
                <input id="search-input-text" type="text" placeholder="{{ __('nav.type_here') }}"
                    class="input input-sm input-bordered w-full max-w-xs" />
                <button id="search-btn" class="btn btn-sm ml-2">{{ __('nav.search') }}</button>
            </div>
            <div class="flex justify-center">
                <label for="my_modal_6" class="btn btn-xs">{{ __('nav.close') }}</label>
            </div>
        </div>
    </div>
</div>
