<?php

namespace App\Http\Controllers;

use App\Models\Calorie;
use App\Services\Fitness\FitnessService;
use Illuminate\Http\Request;
use App\Models\Fitness;
use App\Models\Nutrition;

class DashboardController extends Controller
{
    public function index(FitnessService $fitnessService)
    {
        $fitnessMetrics = [];
        $fitnessData = Fitness::where('user_id', auth()->id())->first();
        $calorieData = Calorie::where('user_id', auth()->id())->where('date', now()->toDateString())->first();

        $nutritionData = Nutrition::getDailyNutritionForUser(auth()->id());

        if ($fitnessData) {
            $fitnessMetrics = $fitnessService->getFitnessMetrics($fitnessData);
            $fitnessData = array_merge($fitnessData ? $fitnessData->toArray() : [], $fitnessMetrics);
        } 

        return view('dashboard', compact('fitnessData', 'nutritionData', 'calorieData'));
    }
}
