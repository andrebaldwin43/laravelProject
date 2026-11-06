<h1>Daily Nutrition</h1>
<div id="daily-nutrition">
    <div data-nutrition-list class="@unless ($nutritionData) hidden @endunless [&>div]:justify-between [&>div]:flex flex-col [&>div]:mb-1 mb-2">
        <div>
            <p>Fiber: </p>
            <p data-nutrient="fiber">{{ number_format($nutritionData['fiber'] ?? 0, 0) }} g</p>
        </div>
        <div>
            <p>Sugar: </p>
            <p data-nutrient="sugar">{{ number_format($nutritionData['sugar'] ?? 0, 0) }} g</p>
        </div>
        <div>
            <p>Cholesterol: </p>
            <p data-nutrient="cholesterol">{{ number_format($nutritionData['cholesterol'] ?? 0, 0) }} mg</p>
        </div>
        <div>
            <p>Sodium: </p>
            <p data-nutrient="sodium">{{ number_format($nutritionData['sodium'] ?? 0, 0) }} mg</p>
        </div>
        <div>
            <p>Saturated Fat: </p>
            <p data-nutrient="saturated_fat">{{ number_format($nutritionData['saturated_fat'] ?? 0, 0) }} g</p>
        </div>
    </div>
    <p data-nutrition-empty class="@if ($nutritionData) hidden @endif text-base text-center font-medium text-red-500">No nutrition data available for today.</p>
</div>

<div class="justify-center flex mt-auto">
    <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4!" title="" href="/nutrition"><span data-nutrition-link>{{ $nutritionData ? 'Update Nutrition' : 'Add Nutrition' }}</span></x-link>
</div>