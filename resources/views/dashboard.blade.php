

@vite('resources/js/nutrition.js')
<x-nav></x-nav>
<x-header title="Fitness Overview"></x-header>
<x-layout>
    <div class="grid grid-cols-3 grid-rows-1 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm [&>div]:mb-1 [&>div]:flex [&>div]:gap-4 [&_p]:flex-1 [&_p:nth-of-type(2)]:text-right">
            <h1 class="text-lg font-bold text-center mb-4">Fitness Data</h1>
            @if ($fitnessData)
            @php
                $bmi = $fitnessData['bmi'] ?? 'N/A';
                $bodyFat = $fitnessData['bodyFat'] ?? 'N/A';
                $targetWeight = $fitnessData['target_weight'] ?? 'N/A';
                $currentWeight = $fitnessData['current_weight'] ?? 'N/A';
            @endphp
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
                    <p class="text-amber-800 mt-2 text-sm">You are {{ $currentWeight - $targetWeight }} lbs away from your target weight.</p>
                @elseif ($currentWeight < $targetWeight)
                    <p class="text-amber-800 mt-2 text-sm">You are {{ $targetWeight - $currentWeight }} lbs below your target weight.</p>
                @else
                    <p class="text-green-800 text-center mt-4">Congratulations! You reached your target weight.</p>
                @endif
            @else
                <p class="text-base text-center font-medium text-red-500">No fitness data available.</p>
            @endif

            <div class="justify-center flex">
                <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4! mt-4" title="" href="/fitness">{{ $fitnessData ? 'Update Goals' : 'Add Goals' }}</x-link>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm [&>div]:mb-1 [&>div]:flex [&>div]:gap-4 [&_p]:flex-1 [&_p:nth-of-type(2)]:text-right">
            <h1 class="text-lg font-bold text-center mb-4">Daily Nutrition</h1>
            @if (session('success'))
                <div id="flash-message" class="alert alert-success">
                    <p class="text-green-700 text-base text-center mt-4 mb-4">{{ session('success') }}</p>
                </div>
            @endif

            @if ($nutritionData)
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
            @else
                <p class="text-base text-center font-medium text-red-500">No nutrition data available for today.</p>
            @endif

            <div class="justify-center flex">
                <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4! mt-4" title="" href="/nutrition">{{ $nutritionData ? 'Update Nutrition' : 'Add Nutrition' }}</x-link>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h1 class="text-lg font-bold text-center mb-4">Food Look-Up</h1>
            <form id="food-search-form" method="GET" action="{{ route('food.search') }}">
                <div class="text-center">
                <x-form.input class="w-full" id="query" name="query" label="Search for food:" />
                </div>
                <x-button class type="submit" title="Search" />
            </form>

            @if (session('foodResults'))
                <div class="bg-amber-100 p-6 mt-6 rounded-lg shadow-sm">
                    <h1 class="text-base font-bold text-center mb-4">Please select the item that best matches your search:</h1>
                    @foreach (session('foodResults')['foods']['food'] ?? [] as $food)
                        <div>
                            <x-link class="text-blue-600 hover:underline text-center text-sm" href="{{ route('food.results', ['foodid' => $food['food_id'] ?? '']) }}">
                                <p>{{ $food['food_name'] ?? 'N/A' }}</p>
                            </x-link>
                        </div>
                    @endforeach
                </div>
            @elseif (session('nutritionData'))
                <div class="bg-amber-100 p-6 mt-6 rounded-lg shadow-sm [&>div]:mb-1 [&>div]:flex [&>div]:gap-4 [&_p]:flex-1 [&_p:nth-of-type(2)]:text-right">
                    <h1 class="text-base font-bold text-center mb-4">Nutrition Data</h1>
                    @foreach (session('nutritionData') as $key => $value)
                        <div>
                            <p>{{ ucfirst(str_replace('_', ' ', $key)) }}: </p>
                            <p>{{ number_format($value ?? 0, 0) }} g</p>
                        </div>
                    @endforeach
                    <form method="POST" action="{{ route('nutrition.addFromSearch') }}">
                        @csrf
                        <x-button class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4! mt-4" type="submit" title="Add to daily nutrition" />
                        @foreach (session('nutritionData') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    </form>
                    <p class="text-red-500 text-sm mt-2">Please review the nutrition data before adding it to your daily intake.</p>
                </div>
            @else
                <div class="bg-amber-100 p-6 mt-6 rounded-lg shadow-sm">
                    <h1 class="text-base font-bold text-center mb-4">No Nutrition Data Available</h1>
                </div>
            @endif
        </div>
        
    </div>

    <div class="bg-white p-6 mt-6 rounded-lg shadow-sm [&>div]:mb-1 [&>div]:flex [&>div]:gap-4 [&_p]:flex-1 [&_p:nth-of-type(2)]:text-right">
            <h1 class="text-lg font-bold text-center mb-4">Suggested Calorie Intake</h1>
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
</x-layout>
