<div>
    {{-- The whole world belongs to you. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" search="true"/>
    <div class="text-xl text-center my-10">
        {{__('revthanks.thanks')}}
    </div>
    <div class="flex justify-center">
        <button class="btn" wire:click="$dispatch('chooseLayout', { layout: 8 })">{{__('revthanks.continue_rev')}}</button>
    </div>
</div>
