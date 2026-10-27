<h1>Suggested Calories</h1>

@if ($fitnessData and $fitnessData['current_weight'] > $fitnessData['target_weight'])
    <div>
        <p>To maintain weight: </p>
        <p>{{ number_format($fitnessData['dailyCalories'] ?? 0, 0) }} cal</p>
    </div>
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
@if (!$fitnessData)
    <div class="h-1/2 justify-center!">
        <p class="text-center! text-red-500">Please add your fitness goals to calculate suggested calories.</p>
    </div>

    <div class="justify-center!">
        <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4!" title="" href="{{ route('fitness') }}">{{ 'Add' }}</x-link>
    </div>
@endif