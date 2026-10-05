
<x-nav></x-nav>
<x-layout>
    <x-header title="Fitness Goals"></x-header>
        
    <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
        <form class="flex flex-col text-center" method="POST" action="{{ route('fitness.store') }}">
            @csrf
            <!-- Form fields for fitness data go here -->
            <div>
                <x-form.input name="current_weight" label="Current Weight" type="text" placeholder="Enter weight" required></x-form.input>
            </div>
            <div>
                <x-form.input name="target_weight" label="Target Weight" type="text" placeholder="Enter target weight" required></x-form.input>
            </div>
            <div>
                <x-form.input name="height" label="Height" type="text" placeholder="Enter height" required></x-form.input>
            </div>
            <div>
                <x-form.input name="age" label="Age" type="text" placeholder="Enter age" required></x-form.input>
            </div>
            <div>
                <x-form.select name="sex" label="Sex" :options="['male'=>'Male','female'=>'Female','other'=>'Other']" required></x-form.select>
            </div>
            <div>
                <x-button title="Save"></x-button>
            </div>
        </form>
    </div>
</x-layout>