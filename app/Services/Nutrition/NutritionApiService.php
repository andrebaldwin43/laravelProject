<?php

namespace App\Services\Nutrition;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NutritionApiService
{
    protected string $baseUrl;
    protected string $consumerKey;
    protected string $consumerSecret;

    public function __construct()
    {
        $this->baseUrl = 'https://platform.fatsecret.com/rest/server.api';
        $this->consumerKey = config('services.fatsecret.consumer_key');      // or consumer_key
        $this->consumerSecret = config('services.fatsecret.consumer_secret'); // or consumer_secret
    }

    public function searchFood(string $query, int $maxResults = 5): ?array
    {
        $params = [
            'method' => 'foods.search',
            'search_expression' => $query,
            'max_results' => $maxResults,
            'page_number' => 0,
            'format' => 'json',
        ];

        return $this->sendSignedGet($params);
    }

    public function getFoodById(string $foodId): ?array
    {
        $params = [
            'method' => 'food.get.v2',
            'food_id' => $foodId,
            'format' => 'json',
        ];

        return $this->sendSignedGet($params);
    }

    protected function sendSignedGet(array $params): ?array
    {
        $oauth = [
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_nonce' => bin2hex(random_bytes(16)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0',
        ];

        $all = array_merge($params, $oauth);

        ksort($all);
        $encoded = [];
        foreach ($all as $k => $v) {
            $encoded[] = rawurlencode((string) $k) . '=' . rawurlencode((string) $v);
        }

        $paramString = implode('&', $encoded);

        $baseString = 'GET&' . rawurlencode($this->baseUrl) . '&' . rawurlencode($paramString);
        $signingKey = rawurlencode($this->consumerSecret) . '&';

        $oauth['oauth_signature'] = base64_encode(
            hash_hmac('sha1', $baseString, $signingKey, true)
        );

        $query = array_merge($params, $oauth);

        $response = Http::acceptJson()->get($this->baseUrl, $query);

        if ($response->failed()) {
            Log::error('FatSecret API failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'query' => $query,
            ]);
            
            return null;
        }

        return $response->json();
    }
}