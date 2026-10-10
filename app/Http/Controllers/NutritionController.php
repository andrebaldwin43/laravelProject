<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nutrition;

class NutritionController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('nutrition');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'calories'      => 'nullable|integer',
            'protein'       => 'nullable|integer',
            'carbs'         => 'nullable|integer',
            'fat'           => 'nullable|integer',
            'fiber'         => 'nullable|integer',
            'sugar'         => 'nullable|integer',
            'cholesterol'   => 'nullable|integer',
            'sodium'        => 'nullable|integer',
            'saturated_fat' => 'nullable|integer',
        ]);

        foreach ($validatedData as $key => $value) {
            if ($value !== null) {
                $validatedData[$key] = Nutrition::where('user_id', auth()->id())->value($key) + $value;
            }
        }   

        $nutrition = Nutrition::updateOrCreate(
            ['user_id' => auth()->id()],
            $validatedData
        );

        return redirect()->route('dashboard');
    }

    public function showNutritionForm()
    {
        return view('nutrition');
    }
}