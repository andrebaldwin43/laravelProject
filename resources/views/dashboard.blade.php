<x-nav></x-nav>
<x-header title="Fitness Overview"></x-header>
<x-layout>
    <div class="space-y-6 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-6
        [&>div]:bg-white [&>div]:rounded-lg [&>div]:p-6 [&>div]:shadow-sm [&>div]:flex [&>div]:flex-col
        [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4"
     >
        <div>
            <h1>Fitness Data</h1>
            @if ($fitnessData)
                @php
                    $bmi = $fitnessData['bmi'] ?? 'N/A';
                    $bodyFat = $fitnessData['bodyFat'] ?? 'N/A';
                    $targetWeight = $fitnessData['target_weight'] ?? 'N/A';
                    $currentWeight = $fitnessData['current_weight'] ?? 'N/A';
                @endphp
                <div class="h-3/4 [&>div]:justify-between [&>div]:flex flex-col [&>div]:mb-1">
                    <div>
                        <p>Current Weight: </p>
                        <p class="{{ $currentWeight > $targetWeight ? 'text-red-500' : 'text-green-600' }}">{{ number_format($currentWeight, 0) }} lbs</p>
                    </div>
                    <div>
                        <p>Target Weight: </p>
                        <p>{{ number_format($targetWeight, 0) }} lbs</p>
                    </div>
                    <div>
                        <p>BMI Estimate: </p>
                        <p>{{ $bmi !== 'N/A' ? number_format($bmi, 1) : 'N/A' }}</p>
                    </div>
                    <div>
                        <p>Body Fat: </p>
                        <p>{{ $bodyFat !== 'N/A' ? number_format($bodyFat, 1) . '%' : 'N/A' }}</p>
                    </div>
                    @if ($currentWeight > $targetWeight)
                        <p class="text-amber-800 mt-3 mb-4 text-sm text-center">You are {{ $currentWeight - $targetWeight }} lbs away from your target weight.</p>
                    @elseif ($currentWeight < $targetWeight)
                        <p class="text-amber-800 mt-3 mb-4 text-sm text-center">You are {{ $targetWeight - $currentWeight }} lbs below your target weight.</p>
                    @else
                        <p class="text-green-800 text-center mt-4 mb-4">Congratulations! You reached your target weight.</p>
                    @endif
            @else
                    <p class="text-base text-center font-medium text-red-500">No fitness data available.</p>
            @endif
                </div>

            <div class="justify-center flex mt-auto">
                <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4!" title="" href="/fitness">{{ $fitnessData ? 'Update Goals' : 'Add Goals' }}</x-link>
            </div>
        </div>

        <div>
            <h1>Daily Nutrition</h1>
            @if ($nutritionData)
                <div class="h-3/4 [&>div]:justify-between [&>div]:flex flex-col [&>div]:mb-1 mb-2">
                    <div>
                        <p>Calories: </p>
                        <p>{{ number_format($nutritionData['calories'] ?? 0, 0) }} cal</p>
                    </div>
                    <div>
                        <p>Protein: </p>
                        <p>{{ number_format($nutritionData['protein'] ?? 0, 0) }} g</p>
                    </div>
                    <div>
                        <p>Carbohydrates: </p>
                        <p>{{ number_format($nutritionData['carbohydrate'] ?? 0, 0) }} g</p>
                    </div>
                    <div>
                        <p>Fat: </p>
                        <p>{{ number_format($nutritionData['fat'] ?? 0, 0) }} g</p>
                    </div>
                    <div>
                        <p>Fiber: </p>
                        <p>{{ number_format($nutritionData['fiber'] ?? 0, 0) }} g</p>
                    </div>
                    <div>
                        <p>Sugar: </p>
                        <p>{{ number_format($nutritionData['sugar'] ?? 0, 0) }} g</p>
                    </div>
                    <div>
                        <p>Cholesterol: </p>
                        <p>{{ number_format($nutritionData['cholesterol'] ?? 0, 0) }} mg</p>
                    </div>
                    <div>
                        <p>Sodium: </p>
                        <p>{{ number_format($nutritionData['sodium'] ?? 0, 0) }} mg</p>
                    </div>
                    <div>
                        <p>Saturated Fat: </p>
                        <p>{{ number_format($nutritionData['saturated_fat'] ?? 0, 0) }} g</p>
                    </div>
                </div>
            @else
                <p class="text-base text-center font-medium text-red-500">No nutrition data available for today.</p>
            @endif

            <div class="justify-center flex mt-auto">
                <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4!" title="" href="/nutrition">{{ $nutritionData ? 'Update Nutrition' : 'Add Nutrition' }}</x-link>
            </div>
        </div>

        <div>
            <div id="food-lookup">
            <h1>Food Look-Up</h1>
                <form id="food-search-form" method="GET" action="{{ route('food.search') }}">
                    <div class="text-center">
                        <x-form.input class="w-full" id="query" name="query" label="Search for food:" />
                    </div>
                    <div class="text-center">
                        <x-button class="py-1! px-4! mt-0!" type="submit" title="Search" />
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
            @elseif (session('nutritionData'))
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
                            <x-button class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4! mt-2" type="submit" title="Add to daily nutrition" />
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

            @if (session('errors') && session('errors')->any())
                <div id="flash-message" class="bg-red-100 p-6 mt-6 rounded-lg shadow-sm">
                    <ul>
                        @foreach (session('errors')->all() as $error)
                            <li class="text-red-500 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-white p-6 mt-6 rounded-lg shadow-sm [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4">
        <div class="col-span-1 [&>div]:justify-between [&>div]:flex flex-col [&>div]:mb-1 sm:border-r pr-2 border-gray-500">
            <h1>Suggested Calories</h1>
            <div>
                <p>To maintain weight: </p>
                <p>{{ number_format($fitnessData['dailyCalories'] ?? 0, 0) }} cal</p>
            </div>
            @if ($fitnessData and $fitnessData['current_weight'] > $fitnessData['target_weight'])
                <div>
                    <p>0.5 lb/week loss: </p>
                    <p>{{ number_format($fitnessData['mildCut'] ?? 0, 0) }} cal</p>
                </div>
                <div>
                    <p>1 lb/week loss: </p>
                    <p>{{ number_format($fitnessData['cut'] ?? 0, 0) }} cal</p>
                </div>
                <div>
                    <p>1.5 lb/week loss: </p>
                    <p>{{ number_format($fitnessData['aggressiveCut'] ?? 0, 0) }} cal</p>
                </div>
            @endif
            @if ($fitnessData and $fitnessData['current_weight'] < $fitnessData['target_weight'])
                <div>
                    <p>0.5 lb/week gain: </p>
                    <p>{{ number_format($fitnessData['mildBulk'] ?? 0, 0) }} cal</p>
                </div>
                <div>
                    <p>1 lb/week gain: </p>
                    <p>{{ number_format($fitnessData['bulk'] ?? 0, 0) }} cal</p>
                </div>
            @endif
        </div>

        <div class="hidden sm:block col-span-2 [&>div]:gap-10 [&>div]:flex [&>div]:mb-1 [&>div]:justify-end mx-auto">
           <h1>General FDA / Dietary Guidelines</h1>
           <div>
                <p class="w-32 text-left">Carbohydrates: </p>
                <p>45%–65% of daily calories (4 calories per gram)</p>
            </div>
            <div>
                <p class="w-32 text-left">Proteins: </p>
                <p>10%–35% of daily calories (4 calories per gram)</p>
            </div>
            <div>
                <p class="w-32 text-left">Fats: </p>
                <p>20%–35% of daily calories (9 calories per gram)</p>
            </div>  
        </div>
    </div>
</x-layout>
