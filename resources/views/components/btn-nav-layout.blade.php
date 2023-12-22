@props(['title' => 'default', 'onClick' => 'default'])

<div class="flex flex-col justify-center items-center">
    <div class="w-20 mx-1.5 mb-0.5 h-fit text-center font-bold text-xs truncate">
        {{ $title }}
    </div>
    <button class="btn btn-sm w-24 h-24" wire:click="{{$onClick}}">
        {{ $slot}}
    </button>
</div>
