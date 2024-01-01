@props(['home', 'register', 'auth' => 'user', 'search' => 'false'])

<div class="navbar bg-base-100 z-30 container mx-auto Lime">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost btn-circle" wire:click="$dispatch('backPrevious')">
                <svg class="h-5 w-5 fill-base-content" xmlns="http://www.w3.org/2000/svg" height="48"
                    viewBox="0 -960 960 960" width="48">
                    <path d="m274-450 248 248-42 42-320-320 320-320 42 42-248 248h526v60H274Z" />
                </svg>
            </label>
        </div>
    </div>
    <div class="navbar-center">
        <a class="btn btn-ghost text-xl" wire:click="$dispatch('home')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                <path class="w-16 h-16 text-gray-500 fill-base-content"
                    d="M220-180h150v-250h220v250h150v-390L480-765 220-570v390Zm-60 60v-480l320-240 320 240v480H530v-250H430v250H160Zm320-353Z" />
            </svg>
        </a>
    </div>
    <div class="navbar-end">
        @if ($search == "true")
            <label for="my_modal_6" class="btn btn-ghost btn-circle fill-base-content">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-base-content" fill="none"
                    viewBox="0 0 24 24" stroke="#01CA84">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </label>
        @endif
    </div>
</div>
