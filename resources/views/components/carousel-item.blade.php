@props(['title' => 'dish 1.1.213141', 'price' => '12,000','path' => '/image-dish/default.jpg'])

<div class="flex flex-col justify-center items-center mx-1">
    <img class="rounded-tr-xlarge rounded-bl-xlarge border-2 mb-2 w-40" src="{{$path}}" alt="carousel-item">
    <div class="w-20 mb-2 mx-1.5 h-fit text-center rounded-tr-md rounded-bl-md font-bold text-xs truncate bg-base-300">
        {{ $price }}
    </div>
    <div class="w-20 mx-1.5 h-fit text-center font-bold text-xs truncate">
        {{ $title }}
    </div>
</div>