
<x-nav></x-nav>
<x-layout>
    <x-header title="Fitness Goals"></x-header>
        
    <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
        <form class="flex flex-col text-center" method="POST" action="{{ route('fitness.store') }}">
            @csrf
            <!-- Form fields for fitness data go here -->
            <div>
                @error('current_weight')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <x-form.input class="text-center" value="{{ number_format($fitness->current_weight ?? '') }}" name="current_weight" label="Current Weight" type="text" placeholder="Enter weight" required></x-form.input>
            </div>
            <div>
                @error('target_weight')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <x-form.input class="text-center" value="{{ number_format($fitness->target_weight ?? '') }}" name="target_weight" label="Target Weight" type="text" placeholder="Enter target weight" required></x-form.input>
            </div>
            <div class="">
                <label class="block text-center">Height</label>
                <div class="flex space-x-2 justify-center">
                    <x-form.select selected="{{ $fitness->height_ft ?? '' }}" class="w-20" name="height_ft" label="(ft)" :options="array_combine(range(1,8), range(1,8))" :min="1" required></x-form.select>
                    <x-form.select selected="{{ $fitness->height_in ?? '' }}" class="w-20" name="height_in" label="(in)" :options="range(0,11)" required></x-form.select>
                </div>
            </div>
    
            <div>
                <x-form.input class="text-center" value="{{ $fitness->age ?? '' }}" name="age" label="Age" type="text" placeholder="Enter age" required></x-form.input>
                @error('age')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-form.select class="text-center" selected="{{ $fitness->sex ?? '' }}"  name="sex" label="Sex" :options="['male'=>'Male','female'=>'Female','other'=>'Other']" required></x-form.select>
                @error('sex')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror   
            </div>
            <div>
                <x-button title="Save"></x-button>
            </div>
        </form>
    </div>
</x-layout>