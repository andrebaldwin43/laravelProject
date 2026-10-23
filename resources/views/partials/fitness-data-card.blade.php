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
    </div>
@else
    <p class="text-base text-center font-medium text-red-500">No fitness data available.</p>
@endif
    
<div class="justify-center flex mt-auto">
    <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4!" title="" href="/fitness">{{ $fitnessData ? 'Update Goals' : 'Add Goals' }}</x-link>
</div>
