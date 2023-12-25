@props(['status', 'tableId', 'customerId'])

<div class="flex xl:w-96 w-full border h-14 rounded-md my-1.5">
    <label class="w-3/4 flex items-center p-3 order-radio">
        <input type="radio" name="customerId" value="1" class="mask-order mask-order-star" check />
        <div class="w-full mb-2 h-fit font-bold text-xs text-center truncate">something something </div>
    </label>
    <div class="w-1/4 flex justify-center items-center">
        <button class="w-1/2 btn rounded-none mr-1">
            <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
                <path class="fill-base-content" d="M705-128 447-388q-23 8-46 13t-47 5q-97.083 0-165.042-67.667Q121-505.333 121-602q0-31 8.158-60.388Q137.316-691.777
                    152-718l145 145 92-86-149-149q25.915-15.158 54.957-23.579Q324-840 354-840q99.167 0 168.583 69.417Q592-701.167
                    592-602q0 24-5 47t-13 46l259 258q11 10.957 11 26.478Q844-209 833-198l-76 70q-10.696 11-25.848 11T705-128Zm28-57
                    40-40-273-273q16-21 24-49.5t8-54.5q0-75-55.5-127T350-782l101 103q9 9 9 22t-9 22L319-511q-9 9-22 9t-22-9l-97-96q3
                    77 54.668 127T354-430q25 0 53-8t49-24l277 277ZM476-484Z" />
            </svg>
        </button>
        <button class="w-1/2 btn rounded-none mr-4">
            <svg width="48" height="48" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="fill-base-content" d="M2.84062 20C2.37656 20 1.9793 19.8368 1.64883 19.5104C1.31836 19.184 1.15312 18.7917 1.15312
                    18.3333V2.5H0V0.833333H5.2875V0H12.7125V0.833333H18V2.5H16.8469V18.3333C16.8469 18.7778 16.6781 19.1667
                    16.3406 19.5C16.0031 19.8333 15.6094 20 15.1594 20H2.84062ZM15.1594 2.5H2.84062V18.3333H15.1594V2.5ZM5.82187
                    15.9444H7.50937V4.86111H5.82187V15.9444ZM10.4906 15.9444H12.1781V4.86111H10.4906V15.9444Z"
                    fill="#BA1A1A" />
            </svg>
        </button>
    </div>
    {{-- <div class="review-carousel  flex-col">
        document.querySelector('input[name="rating-2"]:checked').value;
        <input type="radio" name="rating-2" value="1" class="mask-review mask-review-star mr-2" checked />
        <input type="radio" name="rating-2" value="2" class="mask-review mask-review-star mr-2" />
        <input type="radio" name="rating-2" value="3" class="mask-review mask-review-star mr-2" />
        <input type="radio" name="rating-2" value="4" class="mask-review mask-review-star mr-2" />
        <input type="radio" name="rating-2" value="5" class="mask-review mask-review-star mr-2" />
    </div> --}}
</div>
