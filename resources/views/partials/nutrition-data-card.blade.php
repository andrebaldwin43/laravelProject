<h1>Daily Nutrition</h1>
@if ($nutritionData)
    <div class="h-3/4 [&>div]:justify-between [&>div]:flex flex-col [&>div]:mb-1 mb-2">
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