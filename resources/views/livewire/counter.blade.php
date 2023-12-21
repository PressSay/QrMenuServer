<div>
<div style="text-align: center">

    <button wire:click="increment">+</button>

    <h1>{{ $count }}</h1>


    @if($count >= 3)
        <livewire:counter />
    @endif

</div>


</div>
