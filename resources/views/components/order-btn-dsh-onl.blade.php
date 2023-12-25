@props(['title', 'description', 'messDscript', 'price', 'quantity', 'mx', 'path' => '/image-dish/default.jpg', 'plusFunc', 'minusFunc'])

<div class="w-80 h-40 rounded-tr-xlarge rounded-bl-xlarge shadow-md relative mx-2 my-4"
    {{ $attributes->merge(['class' => 'sm:mx-' . $mx]) }}>
    <div class="absolute h-full w-full">
        <div class="w-full h-1/2 rounded-tr-xlarge bg-base-300"></div>
        @if ($quantity > 0)
            <div class="w-full h-1/2 rounded-bl-xlarge bg-minus bg-error" ></div>
        @else
            <div class="w-full h-1/2 rounded-bl-xlarge bg-minus" ></div>
        @endif
    </div>
    <div class="absolute flex flex-col">
        <div class="flex mb-3">
            <div class="sm:w-28 flex flex-col items-center ">
                <img src="{{ $path }}" class="dish-img h-28 rounded-tr-xlarge rounded-bl-xlarge border-2"
                    {{-- style="border-color: #3C691B" --}} />
            </div>
            <div class="flex flex-col sm:w-52 w-2/3  ml-2 relative">
                <svg class="w-6 text-sky-600 absolute right-2" xmlns="http://www.w3.org/2000/svg" height="48"
                    viewBox="0 -960 960 960" width="48">
                    <path class="fill-base-content" d="M450-450H200v-60h250v-250h60v250h250v60H510v250h-60v-250Z" />
                </svg>
                <p class="text-base text-center font-bold text-sm fill-base-content" {{-- style="color: #3C691B" --}}>
                    {{ $title }}</p>
                <p class="text-sm font-bold text-sm fill-base-content">{{ $description }}</p>
                <p class="text-xs h-20 text-ellipsis overflow-hidden fill-base-content" style="overflow: auto;">
                    {{ $messDscript }}
                </p>
            </div>
        </div>
        <div class="flex mb-2">
            <div class="w-24 flex justify-center">
                <p class="ml-3 w-20 text-center rounded-tr-md rounded-bl-md font-bold text-sm bg-base-200">
                    {{ $price }}
                </p>
            </div>
            <div class="flex justify-center sm:w-52 w-full ml-4 relative">
                <svg class="w-5 absolute right-3 bottom-2" width="28" height="3" viewBox="0 0 28 3"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-base-content fill-error-content icon-minus" d="M0 3V0H28V3H0Z" fill="#BA1A1A" />
                </svg>
                <p class="w-24 text-center rounded-tr-md rounded-bl-md font-bold text-sm quantity"
                    {{-- style="background: #3C691B;" --}}>
                    {{ $quantity }}
                </p>
            </div>
        </div>
    </div>
    <div class="absolute h-full w-full ">
        <button wire:click="{{ $plusFunc }}" class="w-full h-1/2 btn-plus rounded-tr-xlarge opacity-0 cursor-pointer" {{-- onclick="alert('plus')" --}} />
        <button wire:click="{{ $minusFunc }}" class="w-full h-1/2 btn-minus rounded-bl-xlarge opacity-0 cursor-pointer" {{-- onclick="alert('minus')" --}} />
    </div>
</div>
