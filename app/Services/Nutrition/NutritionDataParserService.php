<?php

namespace App\Services\Nutrition;

use App\Models\Nutrition;
use Illuminate\Support\Facades\Schema;

class NutritionDataParserService
{
    public function parse(array $fooditem): array
    {
        $nutritionProperties = (new Nutrition)->getFillable();
        $parsedData = [];

        $servings = $fooditem['food']['servings']['serving'] ?? null;

        if (empty($servings)) {
            return $parsedData;
        }

        // Can return 1 associative array or a list of multiple arrays, gonna convert to a list and grab the first one.
        if (!array_is_list($servings)) {
            $servings = [$servings];
        }

        foreach ($servings[0] as $key => $value) {
            if (in_array($key, $nutritionProperties)) {
                $parsedData[$key] = $value;
            }
        }

        return $parsedData;
    }
}

    
