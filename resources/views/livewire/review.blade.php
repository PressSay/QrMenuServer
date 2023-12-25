<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-nav-talwin-onl home="{{ __('nav.home') }}"
        register="{{ __('nav.register') }}" />
    <div class="flex mx-4 items-center p-3 border rounded-md mb-3">
        <div class="review-carousel">
            {{-- document.querySelector('input[name="rating-2"]:checked').value; --}}
            <input type="radio" name="rating-2" value="1" class="mask-review mask-review-star mr-2" checked />
            <input type="radio" name="rating-2" value="2" class="mask-review mask-review-star mr-2" />
            <input type="radio" name="rating-2" value="3" class="mask-review mask-review-star mr-2" />
            <input type="radio" name="rating-2" value="4" class="mask-review mask-review-star mr-2" />
            <input type="radio" name="rating-2" value="5" class="mask-review mask-review-star mr-2" />
        </div>
    </div>
    <div class="flex justify-center mb-3">
        <x-dish-card />
    </div>
    <div class="flex justify-between mb-4">
        <button class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" width="28">
                <path class="fill-base-content"
                    d="M240-399h313v-60H240v60Zm0-130h480v-60H240v60Zm0-130h480v-60H240v60ZM80-80v-740q0-24
                    18-42t42-18h680q24 0 42 18t18 42v520q0 24-18 42t-42 18H240L80-80Zm134-220h606v-520H140v600l74-80Zm-74 0v-520 520Z" />
            </svg>
        </button>
        <div class="flex justify-between w-36">
            <button class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" width="28">
                    <path class="fill-base-content" d="M242-840h444v512L408-40l-39-31q-6-5-9-14t-3-22v-10l45-211H103q-24 0-42-18t-18-42v-81.839Q43-477
                        41.5-484.5T43-499l126-290q8.878-21.25 29.595-36.125Q219.311-840 242-840Zm384 60H229L103-481v93h373l-53
                        249 203-214v-427Zm0 427v-427 427Zm60 25v-60h133v-392H686v-60h193v512H686Z" />
                </svg>
            </button>
            <button class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" width="28">
                    <path class="fill-base-content" d="M716-120H272v-512l278-288 39 31q6 5 9 14t3 22v10l-45 211h299q24 0 42 18t18 42v81.839q0
                        7.161 1.5 14.661T915-461L789-171q-8.878 21.25-29.595 36.125Q738.689-120 716-120Zm-384-60h397l126-299v-93H482l53-249-203
                        214v427Zm0-427v427-427Zm-60-25v60H139v392h133v60H79v-512h193Z" />
                </svg>
            </button>
        </div>
    </div>
    <textarea class="w-full mb-3 input input-bordered input h-64" name="comment" id="comment"></textarea>
    <div class="w-full flex justify-between my-5">
        <button class="btn">Submit</button>
        <button class="btn">Bill</button>
        <button class="btn">Cancel</button>
    </div>
</div>
