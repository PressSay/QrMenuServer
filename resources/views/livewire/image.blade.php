<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
    <div class="flex flex-col items-center">
        <div class="flex flex-col mt-5 mb-5">
            <p class="text-base">{{__('qr_code_text')}}</p>
            <input type="text" placeholder="Type here" class="input input-bordered input-lg w-full max-w-xs" />
        </div>
        <input type="file" class="file-input file-input-bordered w-full max-w-xs" />
    </div>
    <div class="flex flex-col mt-16 items-center mx-3">
        <button class="btn w-full sm:w-80 h-14 my-4">{{ __('scan_qr') }}</button>
        <button class="btn w-full sm:w-80 h-14 my-4" wire:click="$dispatch('chooseSelectCode')">{{ __('use_old_qr') }}</button>
        <button class="btn w-full sm:w-80 h-14 my-4">{{ __('confirm') }}</button>
        <button class="btn w-full sm:w-80 h-14" wire:click="$dispatch('backToCfm')">{{ __('back') }}</button>
    </div>
</div>
