<?php

namespace App\Http\Controllers;

use App\Services\Fitness\FitnessService;
use Illuminate\Http\Request;
use App\Models\Fitness;
use App\Models\Nutrition;

class DashboardController extends Controller
{
    public function index(FitnessService $fitnessService)
    {
        $fitnessData   = Fitness::where('user_id', auth()->id())->first();
        $nutritionData = Nutrition::getDailyNutritionForUser(auth()->id());

        $goalCalories = (int) ($fitnessData->daily_calories ?? 0);
        $proteinGoal  = (int) ($fitnessData->daily_protein ?? 0);
        $carbsGoal    = (int) ($fitnessData->daily_carbs ?? 0);

        $protein = (int) ($nutritionData['protein'] ?? 0);
        $carbs   = (int) ($nutritionData['carbohydrate'] ?? 0);
        $remainingCalories = max($goalCalories - (int)($nutritionData['calories'] ?? 0), 0);

        if ($fitnessData) {
            $fitnessMetrics = $fitnessService->getFitnessMetrics($fitnessData);
            $fitnessData = array_merge($fitnessData ? $fitnessData->toArray() : [], $fitnessMetrics);
        } 

        return view('dashboard', compact(
            'fitnessData', 
            'nutritionData', 
            'goalCalories', 
            'proteinGoal', 
            'carbsGoal', 
            'protein', 
            'carbs', 
            'remainingCalories'
        ));
    }
}
