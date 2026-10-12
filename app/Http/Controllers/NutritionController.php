<?php

namespace App\Http\Controllers;

use App\Services\Nutrition\NutritionApiService;
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

        $existingNutrition = Nutrition::getDailyNutritionForUser(auth()->id());
        
        foreach ($existingNutrition as $key => $value) {
            if ($value !== null) {
                $existingNutrition[$key] = $value + $value;
            }
        }
        
        Nutrition::create(array_merge(['user_id' => auth()->id()], $validatedData));

        return redirect()->route('dashboard');
    }

    public function searchFood(Request $request)
    {
        $item = $request->input('query');
        $nutritionService = app(NutritionApiService::class);
        $foodResults = $nutritionService->searchFood($item);
        
        return redirect()->route('dashboard')->with([
            'query' => $item,
            'foodResults' => $foodResults,
        ]);
    }

    public function showNutritionForm()
    {
        return view('nutrition');
    }
}