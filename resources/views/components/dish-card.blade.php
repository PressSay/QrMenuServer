@props(['content' => 'bla bla bla bla bla bla bla bla bla','description' => 'description:', 'title' => 'dish 1.1.1', 'path' => '/image-dish/default.jpg', 'price' => '12,000 VND'])
<div class="flex w-80 rounded-tr-xlarge rounded-bl-xlarge border bg-base-200">
    <div class="w-5/12 flex flex-col items-center">
        <img src="{{ $path }}" class="dish-img h-32 rounded-tr-xlarge rounded-bl-xlarge border mb-2" />
        <div class="w-20 mb-2 mx-1.5 h-fit text-center rounded-tr-md rounded-bl-md font-bold text-xs truncate bg-base-300">
            {{ $price }}
        </div>
    </div>
    <div class="w-7/12 flex flex-col items-center p-1.5">
        <div class="w-full mx-1.5 h-fit text-center font-bold text-xs truncate">
            {{ $title }}
        </div>
        <div class="w-full h-full flex flex-col">
            <div class="w-full font-bold text-xs truncate mb-1.5">{{ $description }}</div>
            <div class="w-full h-28 font-bold text-xs" style="overflow: auto;">{{ $content }}</div>
        </div>
    </div>
</div>