<?php

namespace App\Services\Nutrition;

class NutritionService
{
    public function totalsForUser($userId, $macroData, $dailyNutrition): array
    {
        $goals = [
            'calories' => (int) ($macroData->daily_calories ?? 0),
            'protein'  => (int) ($macroData->daily_protein ?? 0),
            'carbs'    => (int) ($macroData->daily_carbohydrate ?? 0),
            'fat'      => (int) ($macroData->daily_fat ?? 0),
        ];

        return [
            'goalCalories'      => $goals['calories'],
            'proteinGoal'       => $goals['protein'],
            'carbsGoal'         => $goals['carbs'],
            'fatGoal'           => $goals['fat'],
            'remainingCalories' => max($goals['calories'] - (int) ($dailyNutrition['calories'] ?? 0), 0),
            'remainingProtein'  => max($goals['protein'] - (int) ($dailyNutrition['protein'] ?? 0), 0),
            'remainingCarbs'    => max($goals['carbs'] - (int) ($dailyNutrition['carbohydrate'] ?? 0), 0),
            'remainingFat'      => max($goals['fat'] - (int) ($dailyNutrition['fat'] ?? 0), 0),
        ];
    }
}