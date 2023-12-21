<x-qrmenu>
    <x-nav-talwin close="{{ __('nav.close') }}" search="{{ __('nav.search') }}" home="{{ __('nav.home') }}"
        register="{{ __('nav.register') }}" category="{{ __('nav.category') }}" tableId="{{ $tableId }}"
        categoryId="{{ $categoryId }}" />

    <div id="cfm-container" class="container mx-auto">
        {{-- <div class="flex flex-col md:flex-row xl:flex-col md:justify-evenly sm:items-center container">
            <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full">
                <x-order-cfm-dsh mx="0" title="Tên món ăn" price="18,000đ" quantity="012" />
                <x-order-cfm-dsh mx="0" title="Tên món ăn" price="18,000đ" quantity="012" />
                <x-order-cfm-dsh mx="0" title="Tên món ăn" price="18,000đ" quantity="012" />
            </div>
            <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full">
                <x-order-cfm-dsh mx="0" title="Tên món ăn" price="18,000đ" quantity="012" />
                <x-order-cfm-dsh mx="0" title="Tên món ăn" price="18,000đ" quantity="012" />
                <x-order-cfm-dsh mx="0" title="Tên món ăn" price="18,000đ" quantity="012" />
            </div>
        </div> --}}
    </div>


    <div class="flex flex-col mx-2 container mx-auto mt-6">
        <div class="flex">
            <p class="font-bold text-lg mr-1" style="color: #3C691B;">{{ __('dish.discount') }}</p>
            <p class="font-bold text-lg summary">6,000đ</p>
        </div>
        <div class="flex">
            <p class="font-bold text-lg mr-1" style="color: #3C691B;">{{ __('dish.tax') }}(5%): </p>
            <p class="font-bold text-lg summary">6,000đ</p>
        </div>
        <div class="flex">
            <p class="font-bold text-lg mr-1" style="color: #3C691B;">{{ __('dish.total') }}</p>
            <p class="font-bold text-lg summary">6,000đ</p>
        </div>
    </div>
    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my_modal_5" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <div class="flex flex-col justify-items-center">
                <h3 class="font-bold text-lg text-center">{{ __('auth.code_of_staff') }}</h3>
                <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs mx-auto" id="code-staff"/>
                <button class="mx-auto pay-cfm btn w-1/2 mx-1 my-3 rounded shadow-xl text-xs sm:text-sm md:text-base border-2"
                    style="background-color: #DAE7CA; color: #3C691B; border-color: #3C691B;">
                    <svg class="mr-2" width="24" height="24" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.6 5C3.27 5 2.9875 4.8825 2.7525 4.6475C2.5175 4.4125 2.4 4.13 2.4 3.8V1.2C2.4 0.87 2.5175 0.5875 2.7525 0.3525C2.9875 0.1175 3.27 0 3.6 0H12.4C12.73 0 13.0125 0.1175 13.2475 0.3525C13.4825 0.5875 13.6 0.87 13.6 1.2V3.8C13.6 4.13 13.4825 4.4125 13.2475 4.6475C13.0125 4.8825 12.73 5 12.4 5H3.6ZM3.6 3.8H12.4V1.2H3.6V3.8ZM1.2 16C0.87 16 0.5875 15.8825 0.3525 15.6475C0.1175 15.4125 0 15.13 0 14.8V13.4H16V14.8C16 15.13 15.8825 15.4125 15.6475 15.6475C15.4125 15.8825 15.13 16 14.8 16H1.2ZM0 12.8L2.9 6.32C3.00667 6.10667 3.15735 5.93333 3.35206 5.8C3.54677 5.66667 3.75608 5.6 3.98 5.6H12.02C12.2439 5.6 12.4532 5.66667 12.6479 5.8C12.8426 5.93333 12.9933 6.10667 13.1 6.32L16 12.8H0ZM5.2 11.2H6C6.10667 11.2 6.2 11.16 6.28 11.08C6.36 11 6.4 10.9067 6.4 10.8C6.4 10.6933 6.36 10.6 6.28 10.52C6.2 10.44 6.10667 10.4 6 10.4H5.2C5.09333 10.4 5 10.44 4.92 10.52C4.84 10.6 4.8 10.6933 4.8 10.8C4.8 10.9067 4.84 11 4.92 11.08C5 11.16 5.09333 11.2 5.2 11.2ZM5.2 9.6H6C6.10667 9.6 6.2 9.56 6.28 9.48C6.36 9.4 6.4 9.30667 6.4 9.2C6.4 9.09333 6.36 9 6.28 8.92C6.2 8.84 6.10667 8.8 6 8.8H5.2C5.09333 8.8 5 8.84 4.92 8.92C4.84 9 4.8 9.09333 4.8 9.2C4.8 9.30667 4.84 9.4 4.92 9.48C5 9.56 5.09333 9.6 5.2 9.6ZM5.2 8H6C6.10667 8 6.2 7.96 6.28 7.88C6.36 7.8 6.4 7.70667 6.4 7.6C6.4 7.49333 6.36 7.4 6.28 7.32C6.2 7.24 6.10667 7.2 6 7.2H5.2C5.09333 7.2 5 7.24 4.92 7.32C4.84 7.4 4.8 7.49333 4.8 7.6C4.8 7.70667 4.84 7.8 4.92 7.88C5 7.96 5.09333 8 5.2 8ZM7.6 11.2H8.4C8.50667 11.2 8.6 11.16 8.68 11.08C8.76 11 8.8 10.9067 8.8 10.8C8.8 10.6933 8.76 10.6 8.68 10.52C8.6 10.44 8.50667 10.4 8.4 10.4H7.6C7.49333 10.4 7.4 10.44 7.32 10.52C7.24 10.6 7.2 10.6933 7.2 10.8C7.2 10.9067 7.24 11 7.32 11.08C7.4 11.16 7.49333 11.2 7.6 11.2ZM7.6 9.6H8.4C8.50667 9.6 8.6 9.56 8.68 9.48C8.76 9.4 8.8 9.30667 8.8 9.2C8.8 9.09333 8.76 9 8.68 8.92C8.6 8.84 8.50667 8.8 8.4 8.8H7.6C7.49333 8.8 7.4 8.84 7.32 8.92C7.24 9 7.2 9.09333 7.2 9.2C7.2 9.30667 7.24 9.4 7.32 9.48C7.4 9.56 7.49333 9.6 7.6 9.6ZM7.6 8H8.4C8.50667 8 8.6 7.96 8.68 7.88C8.76 7.8 8.8 7.70667 8.8 7.6C8.8 7.49333 8.76 7.4 8.68 7.32C8.6 7.24 8.50667 7.2 8.4 7.2H7.6C7.49333 7.2 7.4 7.24 7.32 7.32C7.24 7.4 7.2 7.49333 7.2 7.6C7.2 7.70667 7.24 7.8 7.32 7.88C7.4 7.96 7.49333 8 7.6 8ZM10 11.2H10.8C10.9067 11.2 11 11.16 11.08 11.08C11.16 11 11.2 10.9067 11.2 10.8C11.2 10.6933 11.16 10.6 11.08 10.52C11 10.44 10.9067 10.4 10.8 10.4H10C9.89333 10.4 9.8 10.44 9.72 10.52C9.64 10.6 9.6 10.6933 9.6 10.8C9.6 10.9067 9.64 11 9.72 11.08C9.8 11.16 9.89333 11.2 10 11.2ZM10 9.6H10.8C10.9067 9.6 11 9.56 11.08 9.48C11.16 9.4 11.2 9.30667 11.2 9.2C11.2 9.09333 11.16 9 11.08 8.92C11 8.84 10.9067 8.8 10.8 8.8H10C9.89333 8.8 9.8 8.84 9.72 8.92C9.64 9 9.6 9.09333 9.6 9.2C9.6 9.30667 9.64 9.4 9.72 9.48C9.8 9.56 9.89333 9.6 10 9.6ZM10 8H10.8C10.9067 8 11 7.96 11.08 7.88C11.16 7.8 11.2 7.70667 11.2 7.6C11.2 7.49333 11.16 7.4 11.08 7.32C11 7.24 10.9067 7.2 10.8 7.2H10C9.89333 7.2 9.8 7.24 9.72 7.32C9.64 7.4 9.6 7.49333 9.6 7.6C9.6 7.70667 9.64 7.8 9.72 7.88C9.8 7.96 9.89333 8 10 8Z"
                            fill="#3C691B" />
                    </svg>
                    Confirm
                </button>
            </div>
            <div class="modal-action">
                <label for="my_modal_5" class="btn">Close!</label>
            </div>
        </div>
    </div>
    <x-pay-btn order="Order" genre="Category" tableId="{{ $tableId }}" categoryId="{{ $categoryId }}" payBtn="{{true}}"/>
</x-qrmenu>
