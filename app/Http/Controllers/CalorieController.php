<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fitness;
use App\Services\Fitness\FitnessService;

class CalorieController extends Controller
{
    public function edit(FitnessService $fitnessService)
    {
        $fitnessData = Fitness::where('user_id', auth()->id())->first();

        if ($fitnessData) {
            $fitnessMetrics = $fitnessService->getFitnessMetrics($fitnessData);
            $fitnessData = array_merge($fitnessData ? $fitnessData->toArray() : [], $fitnessMetrics);
        } 

        return view('calorie_goals', compact('fitnessData'));
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'daily_calories' => 'required|numeric',
        ]);

        $user = auth()->user();

        $fitnessRecord = $user->fitness()->latest()->first();
 
        if ($fitnessRecord) {
            $fitnessRecord->daily_calories = $validated['daily_calories'];
            $fitnessRecord->save();
        }

        return redirect()->back()->with('success', 'Target calories updated successfully.');
    }
}