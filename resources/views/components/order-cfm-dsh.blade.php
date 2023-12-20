@props(['title', 'price', 'quantity', 'mx'])

<div class="flex flex-col relative sm:w-96 mx-2 shadow-xl my-3" {{ $attributes->merge(['class' => 'sm:mx-'.$mx]) }}>
    <img class="absolute w-24 rounded-tr-xlarge rounded-bl-xlarge border-2"
        src="/image-dish/default.jpg" />
    <div class="flex rounded-tr-xlarge border-2" style="border-color: #3C691B;">
        <div class="w-24"></div>
        <div class="w-full flex justify-center">
            <p class="text-sm my-1 font-bold" style="color: #3C691B;">{{ $title }}</p>
        </div>
    </div>
    <div class="flex h-11 border-r-2 border-b-2 border-l-2 justify-between" style="border-color: #3C691B;">
        <div class="flex justify-content items-center">
            <div class="w-24"></div>
            <p class="w-24 mx-1.5 h-fit text-center rounded-tr-md rounded-bl-md text-white font-bold text-sm"
                style="background: #3C691B;">
                {{ $price }}
            </p>
            <p class="w-16 h-fit text-center rounded-tr-md rounded-bl-md text-white font-bold text-sm"
                style="background: #3C691B;">
                {{ $quantity }}
            </p>
        </div>
        <div class="flex justify-end items-center mr-2 cursor-pointer">
            <svg width="22" height="24" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2.84062 20C2.37656 20 1.9793 19.8368 1.64883 19.5104C1.31836 19.184 1.15312 18.7917 1.15312 18.3333V2.5H0V0.833333H5.2875V0H12.7125V0.833333H18V2.5H16.8469V18.3333C16.8469 18.7778 16.6781 19.1667 16.3406 19.5C16.0031 19.8333 15.6094 20 15.1594 20H2.84062ZM15.1594 2.5H2.84062V18.3333H15.1594V2.5ZM5.82187 15.9444H7.50937V4.86111H5.82187V15.9444ZM10.4906 15.9444H12.1781V4.86111H10.4906V15.9444Z"
                    fill="#BA1A1A" />
            </svg>
        </div>
    </div>
</div>
