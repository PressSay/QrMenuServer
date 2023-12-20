<!doctype html>
<html>

<x-header />

<body style="background-color: #FDFDF5;">
    <x-nav-talwin close="{{ __('nav.close') }}" search="{{ __('nav.search') }}" home="{{ __('nav.home') }}"
        register="{{ __('nav.register') }}" category="{{ __('nav.category') }}" tableId="{{ $tableId }}"
        categoryId="{{ $categoryId }}" />

    @for ($i = 0; $i < $categories->count(); $i += 6)
        @if ($i + 6 < $categories->count())
            <div class="flex flex-col md:flex-row xl:flex-col md:justify-evenly sm:items-center container mx-auto">
                <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full items-center">
                    @for ($j = 0; $j < 3; $j++)
                        <x-genre-btn
                            url="{{ strval(route('menus') . '?tableOrder=' . $tableId . '&categoryId=' . $categories[$i + $j]->categoryId) }}"
                            category="{{ $categories[$i + $j]->name }}" />
                    @endfor
                </div>
                <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full items-center">
                    @for ($j = 3; $j < 6; $j++)
                        <x-genre-btn
                            url="{{ strval(route('menus') . '?tableOrder=' . $tableId . '&categoryId=' . $categories[$i + $j]->categoryId) }}"
                            category="{{ $categories[$i + $j]->name }}" />
                    @endfor
                </div>
            </div>
        @else
            <div class="flex flex-col md:flex-row xl:flex-col md:justify-evenly sm:items-center container mx-auto">
                @if ($categories->count() % 6 >= 3)
                    <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full items-center">
                        @for ($j = 0; $j < 3; $j++)
                            <x-genre-btn
                                url="{{ strval(route('menus') . '?tableOrder=' . $tableId . '&categoryId=' . $categories[$i + $j]->categoryId) }}"
                                category="{{ $categories[$i + $j]->name }}" />
                        @endfor
                    </div>
                    <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full items-center">
                        @for ($j = 3; $j < $categories->count() % 6; $j++)
                            <x-genre-btn
                                url="{{ strval(route('menus') . '?tableOrder=' . $tableId . '&categoryId=' . $categories[$i + $j]->categoryId) }}"
                                category="{{ $categories[$i + $j]->name }}" />
                        @endfor
                        @for ($j = 0; $j < 3 - (($categories->count() % 6) % 3); $j++)
                            <div class="sm:w-96 w-10/12 mx-2 my-3 hidden md:block" style="height: 64px;"></div>
                        @endfor
                    </div>
                @else
                    <div class="flex flex-col xl:flex-row xl:justify-evenly xl:w-full items-center">
                        @for ($j = 0; $j < $categories->count() % 6; $j++)
                            <x-genre-btn
                                url="{{ strval(route('menus') . '?tableOrder=' . $tableId . '&categoryId=' . $categories[$i + $j]->categoryId) }}"
                                category="{{ $categories[$i + $j]->name }}" />
                        @endfor
                        @for ($j = 0; $j < 3 - ($categories->count() % 6); $j++)
                            <div class="sm:w-96 w-10/12 mx-2 my-3 hidden xl:block" style="height: 64px;"></div>
                        @endfor
                    </div>
                @endif
            </div>
        @endif
    @endfor


    <x-pay-btn order="Order" genre="Menu" tableId="{{ $tableId }}" categoryId="{{ $categoryId }}"
        pageGenre="{{ true }}" />

</body>

</html>
