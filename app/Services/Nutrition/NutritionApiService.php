<?php

namespace App\Services\Nutrition;

use Illuminate\Support\Facades\Http;

class NutritionApiService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.nutrition.api_url');
        $this->apiKey = config('services.nutrition.api_key');
    }

    public function searchFood($item)
    {
        $response = Http::acceptJson()
        ->get('https://api.nal.usda.gov/fdc/v1/foods/search', [
            'query'   => $item,
            'dataType' => 'SR Legacy',
            'pageSize' => 5,
            'api_key' => $this->apiKey,
        ]);

        if ($response->failed()) {
            logger()->error('USDA API failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return null;
        }

        $data = $response->json();
        return $data;
    }
}