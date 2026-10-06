
<x-nav></x-nav>
<x-header title="Fitness Overview"></x-header>
<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm [&>div]:mb-1">
            <h1 class="text-lg font-bold text-center">Fitness Goals</h1>
            @if ($fitness)
            @php
                $bmi = ($fitness->current_weight / ( (($fitness->height_ft*12) + $fitness->height_in) ** 2)) * 703;
                $genderNumeric = $fitness->sex == 'male' ? 1 : 0;
                $bodyFat = ($bmi * 1.20) + (0.23 * $fitness->age) - (10.89 * $genderNumeric) - 5.4;
            @endphp
                <div class="flex gap-4" >
                    <p class="flex-1 whitespace-nowrap ">Current Weight: </p>
                    <p class="flex-1 text-right {{ $fitness->current_weight > $fitness->target_weight ? 'text-red-500' : 'text-green-600' }}">{{ number_format($fitness->current_weight, 0) }} lbs</p>
                </div>
                <div class="flex gap-4">
                    <p class="flex-1">Target Weight: </p>
                    <p class="flex-1 text-right">{{ number_format($fitness->target_weight, 0) }} lbs</p>
                </div>
                <div class="flex gap-4">
                    <p class="flex-1">BMI Estimate: </p>
                    <p class="flex-1 text-right">{{ number_format($bmi, 1) }}</p>
                </div>
                <div class="flex gap-4">
                    <p class="flex-1">Body Fat: </p>
                    <p class="flex-1 text-right">{{ number_format($bodyFat, 1) }}%</p>
                </div>
            @else
                <p class="text-sm font-medium text-gray-500">No fitness data available.</p>
            @endif
            <div class="justify-center flex">
                <x-link class="bg-green-700 hover:bg-green-900 hover:text-white text-white rounded py-1! px-4! mt-4" title="" href="/fitness">{{ $fitness ? 'Update Goals' : 'Add Goals' }}</x-link>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-500">Example data</p>
            <p class="text-3xl font-bold text-gray-900">N/A</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-500">Example data</p>
            <p class="text-3xl font-bold text-gray-900">N/A</p>
        </div>
    </div>
</x-layout>
