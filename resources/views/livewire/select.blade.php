<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}"
        register="{{ __('nav.register') }}" />
    <div class="block relative w-full mt-14">
        <div class="flex justify-center">
            <x-item-select-code />
        </div>
    </div>

    <div class="flex flex-col mt-16 items-center mx-3">
        <button class="btn w-full sm:w-80 h-14" wire:click="$dispatch('backToImgQr')">{{ __('back') }}</button>
    </div>
</div>
