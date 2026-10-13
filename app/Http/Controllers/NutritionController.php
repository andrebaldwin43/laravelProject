<?php

namespace App\Http\Controllers;

use App\Services\Nutrition\NutritionApiService;
use App\Services\Nutrition\NutritionDataParserService;
use Illuminate\Http\Request;
use App\Models\Nutrition;

class NutritionController extends Controller
{
    public function __construct()
    {
        $this->nutritionApiService = app(NutritionApiService::class);
    }

    public function index()
    {
        return view('nutrition');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'calories'      => 'nullable|integer',
            'protein'       => 'nullable|integer',
            'carbohydrate'  => 'nullable|integer',
            'fat'           => 'nullable|integer',
            'fiber'         => 'nullable|integer',
            'sugar'         => 'nullable|integer',
            'cholesterol'   => 'nullable|integer',
            'sodium'        => 'nullable|integer',
            'saturated_fat' => 'nullable|integer',
        ]);

        Nutrition::create(array_merge(['user_id' => auth()->id()], $validatedData));

        return redirect()->route('dashboard');
    }

    public function searchFood(Request $request)
    {
        $item = $request->input('query');
    
        if (!$item) {
            return redirect()->route('dashboard')->withErrors(['query' => 'Please enter a search term.']);
        }
        
        $foodResults = $this->nutritionApiService->searchFood($item);

        return redirect()->route('dashboard')->with([
            'foodResults' => $foodResults,
        ]);
    }

    public function showFoodSearchResults($foodid)
    {
        $fooditem = $this->nutritionApiService->getFoodById($foodid);

        $nutritionData = app(NutritionDataParserService::class)->parse($fooditem);

        return redirect()->route('dashboard')->with([
            'nutritionData' => $nutritionData,
        ]);
    }

    public function addNutritionFromSearch(Request $request)
    {
        $nutritionData = $request->only([
            'calories',
            'protein',
            'carbohydrate',
            'fat',
            'fiber',
            'sugar',
            'cholesterol',
            'sodium',
            'saturated_fat',
        ]);

        Nutrition::create(array_merge(['user_id' => auth()->id()], $nutritionData));

        session()->flash('success', 'Nutrition data added successfully.');

        return redirect()->route('dashboard');
    }

    public function showNutritionForm()
    {
        return view('nutrition');
    }
}