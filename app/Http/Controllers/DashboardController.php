<?php

namespace App\Http\Controllers;

use App\Services\Fitness\FitnessService;
use App\Services\Nutrition\NutritionService;
use Illuminate\Http\Request;
use App\Models\Fitness;
use App\Models\Nutrition;
use App\Models\Macro;

class DashboardController extends Controller
{
    public function index(FitnessService $fitnessService, NutritionService $nutritionService)
    {
        $fitnessData   = Fitness::where('user_id', auth()->id())->first();
        $nutritionData = Nutrition::getDailyNutritionForUser(auth()->id());
        $macroData     = Macro::where('user_id', auth()->id())->first();

        if ($fitnessData) {
            $fitnessMetrics = $fitnessService->getFitnessMetrics($fitnessData);
            $fitnessData = array_merge($fitnessData ? $fitnessData->toArray() : [], $fitnessMetrics);
        } 

        $totals = $nutritionService->totalsForUser(auth()->id(), $macroData, $nutritionData);

        return response()
            ->view('dashboard', array_merge($totals, compact(
                'fitnessData',
                'nutritionData',
                'macroData'
        )))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }
}
