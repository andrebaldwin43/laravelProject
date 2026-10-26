<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalorieController extends Controller
{
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