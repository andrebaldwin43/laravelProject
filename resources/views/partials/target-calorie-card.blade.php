<h1 class="text-lg font-bold mb-4 text-center">Daily Calories</h1>
<div class="text-center">
    @error('daily_calories')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
    <form id="target-calorie-form" method="POST" action="{{ route('calorie.store') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <x-form.input class="text-center" value="{{ $fitnessData['daily_calories'] ?? 0 }}" name="daily_calories" label="" type="text" placeholder="Enter target calories" required></x-form.input>
    </form>
</div>
<div class="text-center mt-2">
    <x-form.button class="py-1! px-4! mt-0!" form="target-calorie-form" title="{{ $fitnessData ? 'Update Calories' : 'Add Calories' }}" type="submit"></x-form.button>
</div>