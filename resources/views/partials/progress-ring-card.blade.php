@vite(['resources/js/progress_card.js'])
<x-progress-ring id="ring-protein" title="Protein"
    :value="$protein" :max="$proteinGoal" label="eaten" />

<x-progress-ring id="ring-carbs" title="Carbs"
    :value="$carbs" :max="$carbsGoal" label="eaten" />

<x-progress-ring id="ring-calories" title="Fat"
    :value="$remainingCalories" :max="$goalCalories" label="Remaining" />




    