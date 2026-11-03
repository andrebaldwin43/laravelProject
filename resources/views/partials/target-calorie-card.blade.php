<h1 class="text-lg font-bold mb-4 text-center">Daily Macro Goals</h1>
@if(isset($macroData['daily_calories']) && $macroData['daily_calories'])
    <div class="[&>div]:justify-between [&>div]:flex flex flex-1 flex-col [&>div]:mb-1 mb-2">
        <div>
            <p>Calories: </p>
            <p>{{ number_format($macroData['daily_calories'] ?? 0, 0) }} kcal</p>
        </div>
        <div>
            <p>Carbs: </p>
            <p>{{ number_format($macroData['daily_carbohydrate'] ?? 0, 0) }} g</p>
        </div>
        <div>
            <p>Protein: </p>
            <p>{{ number_format($macroData['daily_protein'] ?? 0, 0) }} g</p>
        </div>
        <div>
            <p>Fat: </p>
            <p>{{ number_format($macroData['daily_fat'] ?? 0, 0) }} g</p>
        </div>
    </div>
@else
    <div class="text-center">
        <p class="text-red-500">No daily goals set.</p>
    </div>
@endif

<div class="justify-center flex mt-4">
    <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4!" title="" href="{{ route('macro.edit') }}">{{ 'Edit' }}</x-link>
</div>

