<x-nav></x-nav>
<x-header title="Fitness Overview"></x-header>
<x-layout>
    <div class="space-y-6 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-6
        [&>div]:bg-white [&>div]:rounded-lg [&>div]:p-6 [&>div]:shadow-sm [&>div]:flex [&>div]:flex-col
        [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4"
     >
        <div>
            @include('partials.fitness-data-card', ['fitnessData' => $fitnessData])
        </div>

        <div>
            @include('partials.nutrition-data-card', ['nutritionData' => $nutritionData])
        </div>

        <div>
            @include('partials.food-search-card')
        </div>
    </div>

    <div id="dashboard-config"
        data-totals-url="{{ route('nutrition.totals') }}"
        class="hidden">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-white p-2 mt-6 rounded-lg shadow-sm [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4">
        @include('partials.progress-ring-card', [
            'remainingCalories' => $remainingCalories,
            'goalCalories' => $goalCalories ?: 1,
            'protein' => $protein,
            'proteinGoal' => $proteinGoal ?: 1,
            'carbs' => $carbs,
            'carbsGoal' => $carbsGoal ?: 1,
        ])
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-white p-6 mt-6 rounded-lg shadow-sm [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4">
        <div class="sm:border-r pr-2 border-gray-500">
            @include('partials.target-calorie-card', ['calorieData' => $fitnessData['daily_calories'] ?? null])
        </div>
        
        <div class="[&>div]:justify-between [&>div]:flex flex-col [&>div]:mb-1 sm:border-r pr-2 border-gray-500">
            @include('partials.suggested-calories-card', ['fitnessData' => $fitnessData])
        </div>

        <div class="hidden sm:block [&>div]:gap-10 [&>div]:flex [&>div]:mb-1 [&>div]:justify-end mx-auto">
           @include('partials.guidelins-data-card')
        </div>
    </div>
</x-layout>
