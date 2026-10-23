<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalorieController extends Controller
{
    public function store(Request $request)
    {
       $validated = $request->validate([
            'target_calories' => 'required|numeric',
        ]);

        $user = auth()->user();

        $calorieRecord = $user->calorie()->firstOrNew(['date' => now()->toDateString()]);
        $calorieRecord->target_calories = $validated['target_calories'];
        $calorieRecord->save();

        return redirect()->back()->with('success', 'Target calories updated successfully.');
    }
}