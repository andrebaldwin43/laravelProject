<?php

namespace App\Services\Fitness;

use App\Models\Fitness;

class FitnessService
{
    public function getFitnessMetrics(Fitness $fitnessData) : array
    { 
        $genderNumeric = $fitnessData->sex == 'male' ? 1 : 0;
        $bmi           = ($fitnessData->current_weight / ( (($fitnessData->height_ft*12) + $fitnessData->height_in) ** 2)) * 703;
        $bodyFat       = ($bmi * 1.20) + (0.23 * $fitnessData->age) - (10.89 * $genderNumeric) - 5.4;

        $calorieData = $this->calculateCalories(
            $fitnessData->current_weight,
            $fitnessData->height_ft,
            $fitnessData->height_in,
            $fitnessData->age,
            $genderNumeric,
            $fitnessData->fitness_level
        );

        return [
            'bmi'           => $bmi,
            'bodyFat'       => $bodyFat,
            'dailyCalories' => $calorieData['maintenance'],
            'mildCut'       => $calorieData['cut_mild'],
            'cut'           => $calorieData['cut'],
            'aggressiveCut' => $calorieData['aggressive_cut'],
            'mildBulk'      => $calorieData['bulk_mild'],
            'bulk'          => $calorieData['bulk'],
        ];
    }

    function calculateCalories(
    float $weightLb,
    int   $heightFt,
    int   $heightIn,
    int   $age,
    int   $genderNumeric,
    float $activityLevel
): array {
    // Unit conversions for Mifflin–St Jeor
    $weightKg = $weightLb * 0.45359237;
    $heightCm = (($heightFt * 12) + $heightIn) * 2.54;

    // BMR
    $genderAdjustment = ($genderNumeric === 1) ? 5 : -161;
    $bmr = (10 * $weightKg) + (6.25 * $heightCm) - (5 * $age) + $genderAdjustment;

    // Maintenance calories (TDEE)
    $maintenance = $bmr * $activityLevel;

    // Goal targets
    $mildCut       = $maintenance - 250; // ~0.5 lb/week loss
    $cut           = $maintenance - 500; // ~1.0 lb/week loss
    $aggressiveCut = $maintenance - 750; // ~1.5 lb/week loss
    $mildBulk      = $maintenance + 250; // ~0.5 lb/week gain
    $bulk          = $maintenance + 500; // ~1.0 lb/week gain

    // Optional floor so targets don't go unrealistically low
    $mildCut       = max($mildCut, 1200);
    $cut           = max($cut, 1200);
    $aggressiveCut = max($aggressiveCut, 1200);

    return [
        'bmr'            => round($bmr),
        'maintenance'    => round($maintenance),
        'cut_mild'       => round($mildCut),
        'cut'            => round($cut),
        'aggressive_cut' => round($aggressiveCut),
        'bulk_mild'      => round($mildBulk),
        'bulk'           => round($bulk),
    ];
}
}