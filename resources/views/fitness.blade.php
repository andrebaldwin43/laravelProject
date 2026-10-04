
<x-nav></x-nav>
<x-layout>
    <x-header title="Fitness Goals">
        <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fitness') }}
        </h2> -->
    </x-header>
    
<div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
    <form class="flex flex-col" method="POST" action="{{ route('fitness.store') }}">
        @csrf
        <!-- Form fields for fitness data go here -->
        <div>
            <label for="current_weight">Current Weight:</label>
            <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="text" id="current_weight" name="current_weight" required>
        </div>
        <div>
            <label for="target_weight">Target Weight:</label>
            <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="text" id="target_weight" name="target_weight" required>
        </div>
        <div>
            <label for="height">Height:</label>
            <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="text" id="height" name="height" required>
        </div>
        <div>
            <label for="age">Age:</label>
            <input class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" type="text" id="age" name="age" required>
        </div>
        <div>
            <label for="sex">Sex:</label>
            <select class="bg-amber-50 border border-gray-300 p-2 mb-5 rounded" id="sex" name="sex" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div>
            <button class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600" type="submit">Save</button>
        </div>
    </form>
</div>
</x-layout>