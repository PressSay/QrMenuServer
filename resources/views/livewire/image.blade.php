<div>
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />

    <div class="flex justify-center {{ $isHiddenFileInput }}">
        <video id="qr-video"></video>
    </div>

    <div class="flex flex-col items-center">
        <div class="flex flex-col mt-5 mb-5">
            <p class="text-base">{{ __('qr_code_text') }}</p>
            <input type="text" placeholder="Type here" class="input input-bordered input-lg w-full max-w-xs"
                id="file-qr-result" />
        </div>

        <input type="file" class="file-input file-input-bordered w-full max-w-xs {{ $isHiddenFileInput }}"
            id="file-selector" />
    </div>

    <div class="flex flex-col mt-16 items-center mx-3">
        <button id="start-button" class="btn w-full sm:w-80 h-14 my-4" wire:click="initScan"
            onclick="initScanner({{ $notInitScannerQr }})">{{ __('init_scan_qr') }}</button>
        <button class="btn w-full sm:w-80 h-14 my-4"
            wire:click="$dispatch('chooseSelectCode')">{{ __('use_old_qr') }}</button>
        <button class="btn w-full sm:w-80 h-14 my-4">{{ __('confirm') }}</button>
        <button class="btn w-full sm:w-80 h-14 mb-5" wire:click="$dispatch('backPrevious')">{{ __('back') }}</button>
    </div>

</div
