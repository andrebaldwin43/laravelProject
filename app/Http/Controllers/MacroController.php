<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Macro;
use App\Models\Fitness;
use App\Services\Fitness\FitnessService;

class MacroController extends Controller
{
    public function edit(FitnessService $fitnessService)
    {
        $fitnessData = Fitness::where('user_id', auth()->id())->first();
        $macroData = Macro::where('user_id', auth()->id())->first();

        if ($fitnessData) {
            $fitnessMetrics = $fitnessService->getFitnessMetrics($fitnessData);
            $fitnessData = array_merge($fitnessData ? $fitnessData->toArray() : [], $fitnessMetrics);
        }

        return view('macro_goals', compact('fitnessData', 'macroData'));
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'daily_calories' => 'required|numeric|min:0',
            'daily_protein' => 'nullable|numeric',
            'daily_carbohydrate' => 'nullable|numeric',
            'daily_fat' => 'nullable|numeric',
        ]);

        $macroData = Macro::where('user_id', auth()->id())->first();

        $validated['user_id'] = $request->user()->id;

        $request->user()->macro()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return redirect()->back()->with('success', 'Target calories updated successfully.');
    }
}