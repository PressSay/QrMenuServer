<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
    @php
        $isRevDishHidden = $isBill ? 'hidden' : '';
        $isRevBillHidden = !$isBill ? 'hidden' : '';
        $firstDish = ($customers != []) ? true : false;
        $firstBill = ($customerDishCrossRefs != []) ? true : false;
    @endphp
    <div class="flex mx-4 items-center p-3 border rounded-md mb-3">
        <div class="review-carousel">
            @foreach ($customers as $customer)
                @php
                    $checkBill = '';
                    if ($firstBill) {
                        $checkBill = 'checked';
                        $firstBill = false;
                    }
                @endphp
                <input wire:click="chooseReview({{ $customer->customerId }})" type="radio" name="rating-bill"
                    value="{{ $customer->customerId }}" class="mask-review mask-review-star mr-2 {{ $isRevBillHidden }}"
                    {{ $checkBill }} />
            @endforeach
            @foreach ($customerDishCrossRefs as $crossRef)
                @php
                    $checkDish = '';
                    if ($firstDish) {
                        $checkDish = 'checked';
                        $firstDish = false;
                    }
                    $param = $crossRef->dishId . '-' . $crossRef->customerId;
                @endphp
                <input wire:click="chooseReviewDish('{{ $param }}')" type="radio" name="rating-dish"
                    value="{{ $param }}" class="mask-review mask-review-star mr-2 {{ $isRevDishHidden }}"
                    {{ $checkDish }} />
            @endforeach
        </div>
    </div>
    <div class="flex justify-center items-center flex-col mb-3">
        {{ $reviewChoose }}-{{ $reviewDishChoose }}-{{ $thumpUp }}-{{ $isContent }}
        @if (!$isBill)
            @php
                $dish = App\Models\Dish::where('dishId', explode('-', $reviewDishChoose)[0])->first();
                if ($dish == null) {
                    $dish = App\Models\Dish::where('dishId', $firstRevDishChoose)->first();
                }
                $title = '';
                $description = '';
                $price = '';
                if ($dish != null) {
                    $title = $dish->name;
                    $description = $dish->description;
                    $price = $dish->cost;
                }
            @endphp
            <x-dish-card title="{{ $title }}" content="{{ $description }}" price="{{ $price }}" />
        @endif
    </div>
    <div class="flex justify-between mb-4 mx-1.5">
        <button class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" width="28">
                <path class="fill-base-content"
                    d="M240-399h313v-60H240v60Zm0-130h480v-60H240v60Zm0-130h480v-60H240v60ZM80-80v-740q0-24
                    18-42t42-18h680q24 0 42 18t18 42v520q0 24-18 42t-42 18H240L80-80Zm134-220h606v-520H140v600l74-80Zm-74 0v-520 520Z" />
            </svg>
        </button>
        <div class="flex justify-between w-36">
            <button class="btn" wire:click="toggleThump(false)">
                <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" width="28">
                    @if ($thumpUp == -1)
                        <path class="fill-error" d="M242-840h444v512L408-40l-39-31q-6-5-9-14t-3-22v-10l45-211H103q-24 0-42-18t-18-42v-81.839Q43-477
                        41.5-484.5T43-499l126-290q8.878-21.25 29.595-36.125Q219.311-840 242-840Zm384 60H229L103-481v93h373l-53
                        249 203-214v-427Zm0 427v-427 427Zm60 25v-60h133v-392H686v-60h193v512H686Z" />
                    @else
                        <path class="fill-base-content" d="M242-840h444v512L408-40l-39-31q-6-5-9-14t-3-22v-10l45-211H103q-24 0-42-18t-18-42v-81.839Q43-477
                        41.5-484.5T43-499l126-290q8.878-21.25 29.595-36.125Q219.311-840 242-840Zm384 60H229L103-481v93h373l-53
                        249 203-214v-427Zm0 427v-427 427Zm60 25v-60h133v-392H686v-60h193v512H686Z" />
                    @endif
                </svg>
            </button>
            <button class="btn" wire:click="toggleThump(true)">
                <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" width="28">
                    @if ($thumpUp == 1)
                        <path class="fill-success" d="M716-120H272v-512l278-288 39 31q6 5 9 14t3 22v10l-45 211h299q24 0 42 18t18 42v81.839q0
                        7.161 1.5 14.661T915-461L789-171q-8.878 21.25-29.595 36.125Q738.689-120 716-120Zm-384-60h397l126-299v-93H482l53-249-203
                        214v427Zm0-427v427-427Zm-60-25v60H139v392h133v60H79v-512h193Z" />
                    @else
                        <path class="fill-base-content" d="M716-120H272v-512l278-288 39 31q6 5 9 14t3 22v10l-45 211h299q24 0 42 18t18 42v81.839q0
                        7.161 1.5 14.661T915-461L789-171q-8.878 21.25-29.595 36.125Q738.689-120 716-120Zm-384-60h397l126-299v-93H482l53-249-203
                        214v427Zm0-427v427-427Zm-60-25v60H139v392h133v60H79v-512h193Z" />
                    @endif
                </svg>
            </button>
        </div>
    </div>
    <textarea class="w-full mb-3 input input-bordered input h-64" wire:model="content" name="comment" id="comment"></textarea>
    <div class="w-full flex justify-evenly my-5">
        <button class="btn" wire:click="submit">Submit</button>
        @if ($isBill)
            <button wire:click="toggleBill" class="btn">Dish</button>
        @else
            <button wire:click="toggleBill" class="btn">Bill</button>
        @endif
    </div>
</div>
