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

        <div class="[&_h2]:text-center">
            <x-progress-ring class="h-60 shadow-none!" id="ring-calories" title="Calories"
                :value="$remainingCalories" :max="$goalCalories" label="Remaining" color="{{ $remainingCalories < $goalCalories * 0.25 ? '#FBBF24' : '#0B72FF' }}" />
        </div>

        <div>
            @include('partials.food-search-card')
        </div>
    </div>

    <div class="group grid grid-cols-1 sm:grid-cols-3 gap-4 bg-white p-2 mt-6 rounded-lg shadow-sm [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4">
        @include('partials.progress-ring-card', [
            'remainingCalories' => $remainingCalories,
            'goalCalories'      => $goalCalories,
            'remainingProtein'  => $remainingProtein,
            'proteinGoal'       => $proteinGoal,
            'remainingCarbs'    => $remainingCarbs,
            'carbsGoal'         => $carbsGoal,
            'remainingFat'      => $remainingFat,
            'fatGoal'           => $fatGoal,
        ])
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-white p-6 mt-6 rounded-lg shadow-sm [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4">
        <div class="sm:border-r pr-2 border-gray-500">
            @include('partials.target-calorie-card', ['fitnessData' => $fitnessData ?? null])
        </div>

        <div class="sm:border-r pr-2 border-gray-500">
           @include('partials.nutrition-data-card', ['nutritionData' => $nutritionData])
        </div>
    </div>
</x-layout>
