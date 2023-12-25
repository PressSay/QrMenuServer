<div>
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
    @for ($i = 0; $i < $categories->count(); $i += 2)
        <div class="flex xl:flex-row flex-col justify-evenly items-center w-full">
            <button wire:click="$dispatch('changeCategoryId', { categoryId: {{ $categories[$i]->categoryId }} })"
                class="btn btn-lg sm:w-96 w-10/12 mx-2 my-3 rounded-tr-xlarge rounded-bl-xlarge 
                shadow-xl text-sm sm:text-base btn-outline btn-base-content">{{ $categories[$i]->name }}</button>
            @if ($i + 1 < $categories->count())
                <button wire:click="$dispatch('changeCategoryId', { categoryId: {{ $categories[$i + 1]->categoryId }} })"
                    class="btn btn-lg sm:w-96 w-10/12 mx-2 my-3 rounded-tr-xlarge rounded-bl-xlarge 
                    shadow-xl text-sm sm:text-base btn-outline btn-base-content">{{ $categories[$i + 1]->name }}</button>
            @else
                <div class="sm:w-96 w-10/12 mx-2 my-3">
                </div>
            @endif
        </div>
    @endfor
    <div class="bg-base-100 mt-3 flex justify-center">
        {{ $categories->count() }}
    </div>
</div>
