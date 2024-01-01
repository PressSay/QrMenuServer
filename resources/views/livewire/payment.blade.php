<div>
    <style>
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            background-repeat: no-repeat;
            padding-top: 0.5rem;
            padding-right: 2.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
        }

        .form-select::-ms-expand {
            color: #a0aec0;
            border: none;
        }

        @media not print {
            .form-select::-ms-expand {
                display: none;
            }
        }

        @media print and (-ms-high-contrast: active),
        print and (-ms-high-contrast: none) {
            .form-select {
                padding-right: 0.75rem;
            }
        }
    </style>
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
    @switch($layout_payment)
        @case(1)
        <div class="flex items-center justify-center px-2">
            <div class="w-full mx-auto rounded-lg shadow-lg p-2 sm:p-5 bg-base-300" style="max-width: 600px">
                <div class="flex justify-evenly w-full mb-4">
                    <button wire:click="creditCard"
                        class="btn rounded-full w-20 h-20 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>credit-card-outline</title>
                            <path class="fill-base-content"
                                d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
                        </svg>
                    </button>
                    <button wire:click="transfer" class="btn w-20 h-20 shadow-lg rounded-full">
                        <img src="/logo_chuyen_khoan.png" alt="logo_chuyen_khoan"/>
                    </button>
                </div>
                <div class="flex flex-col mb-10">
                    <div class="flex">
                        <div class="w-8 h-8">
                            <x-mbbank-logo />
                        </div>
                        <p class="ml-1 text-2xl font-bold" style="color: #141ED2;">MB</p>
                        <p class="ml-1 text-2xl">:</p>
                        <p class="ml-1 text-2xl">0987654321</p>
                    </div>
                    <div class="flex">
                        <div class="w-8 h-8">
                            <x-momo-logo />
                        </div>
                        <p class="ml-1 text-2xl">:</p>
                        <p class="ml-1 text-2xl">0987654321</p>
                    </div>
                    <div class="flex flex-col mt-2">
                        <p class="font-bold mb-1">Image Confirm: (mỗi mã áp dụng 1 đơn)</p>
                        <div class="flex flex-col">
                            <input type="file" class="file-input file-input-sm w-full max-w-xs mb-2" />
                            <input wire:model="idPayment" type="text" placeholder="{{__('ma_giao_dich')}}" class="input input-bordered input-sm" />
                        </div>
                    </div>
                </div>
                <div class="w-full mx-auto text-center">
                    <button wire:click="pay"
                        class="btn px-3 py-3 font-semibold">PAY NOW</button>
                </div>
                @php
                    $oldCustomerId = App\Models\Order::where('status', 'unpaid-onl')->first()->customerId;
                @endphp
                <div class="flex flex-col mt-3">
                    <p>{{__('hoac_chuyen_khoan_voi_noi_dung_ben_duoi')}}</p>
                    <p>{{__('noi_dung_chuyen_khoang')}}:</p>
                    <p>{{__('ma_kh:')}} {{ $oldCustomerId }}</p>
                </div>
            </div>
        </div>
            @break
        @case(2)
        <div class="flex items-center justify-center px-2">
            <div class="w-full mx-auto rounded-lg shadow-lg p-2 sm:p-5 bg-base-300" style="max-width: 600px">
                <div class="flex justify-evenly w-full mb-4">
                    <button wire:click="creditCard"
                        class="btn rounded-full w-20 h-20 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>credit-card-outline</title>
                            <path class="fill-base-content"
                                d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
                        </svg>
                    </button>
                    <button wire:click="transfer" class="btn w-20 h-20 shadow-lg rounded-full">
                        <img src="/logo_chuyen_khoan.png" alt="logo_chuyen_khoan"/>
                    </button>
                </div>
                <div class="mb-3 flex -mx-2">
                    <div class="px-2">
                        <label for="type1" class="flex items-center cursor-pointer">
                            <input wire:model="typeCard" value="master" type="radio" class="radio h-5 w-5 " name="type" id="type1"
                                checked>
                            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
                        </label>
                    </div>
                    <div class="px-2">
                        <label for="type2" class="flex items-center cursor-pointer">
                            <input wire:model="typeCard" value="paypal" type="radio" class="radio h-5 w-5 " name="type" id="type2">
                            <img src="https://www.sketchappsources.com/resources/source-image/PayPalCard.png"
                                class="h-8 ml-3">
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="font-bold text-sm mb-2 ml-1">Name on card</label>
                    <div>
                        <input wire:model="name"
                            class="input input-bordered w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                            placeholder="John Smith" type="text" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="font-bold text-sm mb-2 ml-1">Card number</label>
                    <div>
                        <input wire:model='cardNumber'
                            class="input input-bordered w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                            placeholder="0000 0000 0000 0000" type="text" />
                    </div>
                </div>
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Expiration date</label>
                        <div>
                            <select wire:model="month"
                                class="select select-bordered form-select w-full px-3 py-2 mb-1 rounded-md transition-colors cursor-pointer">
                                <option value="01">01 - January</option>
                                <option value="02">02 - February</option>
                                <option value="03">03 - March</option>
                                <option value="04">04 - April</option>
                                <option value="05">05 - May</option>
                                <option value="06">06 - June</option>
                                <option value="07">07 - July</option>
                                <option value="08">08 - August</option>
                                <option value="09">09 - September</option>
                                <option value="10">10 - October</option>
                                <option value="11">11 - November</option>
                                <option value="12">12 - December</option>
                            </select>
                        </div>
                    </div>
                    <div class="px-2 w-1/2">
                        <select wire:model="year"
                            class="select select-bordered form-select w-full px-3 py-2 mb-1 rounded-md transition-colors cursor-pointer">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                        </select>
                    </div>
                </div>
                <div class="mb-10">
                    <label class="font-bold text-sm mb-2 ml-1">Security code</label>
                    <div>
                        <input wire:model="code"
                            class="input input-bordered w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md transition-colors"
                            placeholder="000" type="text" />
                    </div>
                </div>
                <div class="w-full mx-auto text-center">
                    <button wire:click="pay"
                        class="btn px-3 py-3 font-semibold">PAY NOW</button>
                </div>
            </div>
        </div>
            @break
        @default
            
    @endswitch
    

    

    {{-- <!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->
    <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a title="Buy me a beer" href="https://www.buymeacoffee.com/scottwindon" target="_blank"
                class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full"
                    src="https://i.pinimg.com/originals/60/fd/e8/60fde811b6be57094e0abc69d9c2622a.jpg" />
            </a>
        </div>
    </div> --}}
</div>
