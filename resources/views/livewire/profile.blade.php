<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}" register="{{ __('nav.register') }}" />
    <div class="flex flex-col justify-center items-center mt-5">
        <img class="w-40 h-40 rounded-full" src="/image-dish/default.jpg" alt="account_img">
        <p class="text-xl my-4">Ten</p>
        <div class="w-11/12 flex flex-col">
            <div class="flex mb-3">
                <p class="text-lg mr-1.5">Username:</p>
                <p class="text-lg">{{ auth::user()->name }}</p>
            </div>
            <div class="flex mb-3">
                <p class="text-lg mr-1.5">Phone:</p>
                <p class="text-lg">{{ auth::user()->phoneNumber }}</p>
            </div>
            <div class="flex mb-3">
                <p class="text-lg mr-1.5">Position:</p>
                <p class="text-lg">{{ auth::user()->nameRole }}</p>
            </div>
            <div class="flex mb-3">
                <p class="text-lg mr-1.5">Exp:</p>
                <p class="text-lg">{{ auth::user()->Exp }}</p>
            </div>
            <div class="flex mb-3">
                <p class="text-lg mr-1.5">Level:</p>
                <p class="text-lg">{{ auth::user()->level }}</p>
            </div>
            <div class="flex mb-3">
                <p class="text-lg mr-1.5">Email:</p>
                <p class="text-lg">{{ auth::user()->email }}</p>
            </div>
            <div class="flex mb-3">
                <p class="text-lg mr-1.5">Address:</p>
                <p class="text-lg">{{ auth::user()->address }}</p>
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-6">
        <a href="/profile" class="btn mr-1.5">{{__('edit_profile')}}</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</div>
