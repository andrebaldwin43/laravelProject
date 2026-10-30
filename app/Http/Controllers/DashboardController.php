<?php

namespace App\Http\Controllers;

use App\Services\Fitness\FitnessService;
use Illuminate\Http\Request;
use App\Models\Fitness;
use App\Models\Nutrition;
use App\Models\Macro;

class DashboardController extends Controller
{
    public function index(FitnessService $fitnessService)
    {
        $fitnessData   = Fitness::where('user_id', auth()->id())->first();
        $nutritionData = Nutrition::getDailyNutritionForUser(auth()->id());
        $macroData     = Macro::where('user_id', auth()->id())->first();

        if ($fitnessData) {
            $fitnessMetrics = $fitnessService->getFitnessMetrics($fitnessData);
            $fitnessData = array_merge($fitnessData ? $fitnessData->toArray() : [], $fitnessMetrics);
        } 

        $goalCalories = (int) ($macroData->daily_calories ?? 0);
        $proteinGoal  = (int) ($macroData->daily_protein ?? 0);
        $carbsGoal    = (int) ($macroData->daily_carbohydrate ?? 0);
        $fatGoal      = (int) ($macroData->daily_fat ?? 0);

        $protein = (int) ($nutritionData['protein'] ?? 0);
        $carbs   = (int) ($nutritionData['carbohydrate'] ?? 0);
        $fat     = (int) ($nutritionData['fat'] ?? 0);
        $remainingCalories = max($goalCalories - (int)($nutritionData['calories'] ?? 0), 0);

        return view('dashboard', compact(
            'fitnessData', 
            'nutritionData',
            'macroData',
            'goalCalories', 
            'proteinGoal', 
            'carbsGoal', 
            'fatGoal', 
            'protein', 
            'carbs', 
            'fat', 
            'remainingCalories'
        ));
    }
}
