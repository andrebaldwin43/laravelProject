<?php

namespace App\Services\Nutrition;

use App\Models\Nutrition;
use Illuminate\Support\Facades\Schema;

// Service to parse nutrition data from a api response.
class NutritionDataParserService
{
    public function parse(array $fooditem)
    {
        $nutritionProperties = (new Nutrition)->getFillable();
        $parsedData = [];

        if (!empty($fooditem['food']['servings']['serving'])) {
            foreach ($fooditem['food']['servings']['serving'] as $servingKey => $serving) {
                if (in_array($servingKey, $nutritionProperties)) {
                    $parsedData[$servingKey] = $serving;
                }
            }
        }

        return $parsedData;

    }
}

    
