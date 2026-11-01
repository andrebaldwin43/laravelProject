<x-progress-ring id="ring-protein" title="Protein"
    :value="$remainingProtein" :max="$proteinGoal" label="Remaining" color="{{ $remainingProtein < $proteinGoal * 0.25 ? '#FBBF24' : '#0B72FF' }}" />

<x-progress-ring id="ring-carbs" title="Carbs"
    :value="$remainingCarbs" :max="$carbsGoal" label="Remaining" color="{{ $remainingCarbs < $carbsGoal * 0.25 ? '#FBBF24' : '#0B72FF' }}" />

<x-progress-ring id="ring-fat"  title="Fat"
    :value="$remainingFat" :max="$fatGoal" label="Remaining" color="{{ $remainingFat < $fatGoal * 0.25 ? '#FBBF24' : '#0B72FF' }}" />
    




    