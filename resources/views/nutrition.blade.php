<x-nav />

<x-layout>
    <x-header title="Nutrition" />
    <div class="container bg-slate-300 mx-auto max-w-md p-8 rounded-lg shadow-md mt-10  outline-2 outline-blue-500">
        <form class='flex flex-col text-center' action="{{ route('nutrition.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <x-form.input name="calories" label="Calories" type="number" />
            </div>      
            <div>
                <x-form.input name="protein" label="Protein" type="number" />
            </div>      
            <div>
                <x-form.input name="carbs" label="Carbs" type="number" />
            </div>
            <div>
                <x-form.input name="fat" label="Fat" type="number" />
            </div>
            <div>
                <x-form.input name="fiber" label="Fiber" type="number" />
            </div>
            <div>
                <x-form.input name="sugar" label="Sugar" type="number" />
            </div>
            <div>
                <x-form.input name="cholesterol" label="Cholesterol" type="number" />
            </div>
            <div>
                <x-form.input name="saturated_fat" label="Saturated Fat" type="number" />
            </div>
            <div>
                <x-form.input name="sodium" label="Sodium" type="number" />
            </div>
            <div>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Nutrition
                </button>
            </div>
        </form>
    </div>
</x-layout>