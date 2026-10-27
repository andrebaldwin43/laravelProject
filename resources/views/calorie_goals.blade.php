<x-nav></x-nav>
<x-layout>
    <x-header title="Nutrition & Calorie Goals"></x-header>
    <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-2  outline-2 outline-blue-500">
        <h1 class="text-lg font-bold mb-4 text-center">Daily Calories</h1>
        <div class="text-center">
            @error('daily_calories')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            <form id="target-calorie-form" class="flex flex-col text-center" method="POST" action="{{ route('calorie.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <x-form.input class="text-center" value="{{ $fitnessData['daily_calories'] ?? 0 }}" name="daily_calories" label="" type="text" placeholder="Enter target calories" required></x-form.input>
            </form>
        </div>
        <div class="text-center mt-2">
            <x-form.button class="py-1! px-4! mt-0!" form="target-calorie-form" title="{{ $fitnessData ? 'Update Calories' : 'Add Calories' }}" type="submit"></x-form.button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-white p-6 mt-6 rounded-lg shadow-sm [&_h1]:text-lg [&_h1]:font-bold [&_h1]:text-center [&_h1]:mb-4">
        <div class="[&>div]:justify-between [&>div]:flex flex-col [&>div]:mb-1 sm:border-r pr-2 border-gray-500">
            @include('partials.suggested-calories-card', ['fitnessData' => $fitnessData])
        </div>

        <div class="hidden sm:block [&>div]:gap-10 [&>div]:flex [&>div]:mb-1 [&>div]:justify-end mx-auto">
           @include('partials.guidelins-data-card')
        </div>
    </div>
</x-layout>