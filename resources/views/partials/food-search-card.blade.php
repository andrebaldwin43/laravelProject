<div id="food-lookup">
    <h1>Food Look-Up</h1>
        <form id="food-search-form" method="GET" action="{{ route('food.search') }}">
            <div class="text-center">
                <x-form.input required class="w-full" id="query" name="query" label="Search for food:" />
            </div>
            <div class="text-center">
                <x-form.button class="py-1! px-4! mt-0!" type="submit" title="Search" />
            </div>
        </form>
    </div>

    @if (session('foodResults'))
        <div id="food-results" class="bg-amber-100 p-6 mt-6 rounded-lg shadow-sm">
            <h1 class="text-base font-bold text-center mb-4">Please select the item that best matches your search:</h1>
            @foreach (session('foodResults')['foods']['food'] ?? [] as $food)
                <div>
                    <x-link class="text-blue-600 hover:underline text-center text-sm" href="{{ route('food.results', ['foodid' => $food['food_id'] ?? '']) }}">
                        <p>{{ $food['food_name'] ?? 'N/A' }}</p>
                    </x-link>
                </div>
            @endforeach
            <div class="justify-center flex  mt-4">   
                <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4!" href="{{ route('food.search') }}">
                    Back to Food Search
                </x-link>
            </div>
        </div>
    @endif
    @if (session('nutritionData'))
        <div id="nutrition-data" class="bg-amber-100 p-6 mt-6 rounded-lg shadow-sm [&>div]:mb-1 [&>div]:flex [&>div]:gap-4 [&_p]:flex-1 [&_p:nth-of-type(2)]:text-right">
            <h1 class="text-base font-bold text-center mb-4">Nutrition Data</h1>
            @foreach (session('nutritionData') as $key => $value)
                <div>
                    <p>{{ ucfirst(str_replace('_', ' ', $key)) }}: </p>
                    <p>{{ number_format($value ?? 0, 0) }} g</p>
                </div>
            @endforeach

            <form method="POST" action="{{ route('nutrition.addFromSearch') }}">
                @csrf
                <p class="text-red-600 text-sm mt-4 text-center">Please review the nutrition data before adding it to your daily intake.</p>
                <div class="text-center">
                    <x-form.button class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4! mt-2" type="submit" title="Add to daily nutrition" />
                </div>

                <div class="text-center mt-2">
                    <x-link class="text-blue-600 hover:underline text-sm" href="{{ route('food.search') }}">
                        Back to Food Search
                    </x-link>
                </div>

                @foreach (session('nutritionData') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            </form>

            
        </div>
    @endif
</div>