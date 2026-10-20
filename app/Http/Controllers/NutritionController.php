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
            'calorie_target' => 'nullable|integer',
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
        $item = $request->input('query', '');
    
        if (!$item) {
            return redirect()->route('dashboard');
        }
        
        $foodResults = $this->nutritionApiService->searchFood($item);

        if (isset($foodResults['error'])) {
            return redirect()->route('dashboard')->withErrors(['query' => 'Food search may not be available at the moment. Please try again later.']);
        }

        if (!$foodResults) {
            return redirect()->route('dashboard')->withErrors(['query' => 'No food results found for your search.']);
        }

        return redirect()->route('dashboard')->with([
            'foodResults' => $foodResults,
        ]);
    }

    public function showFoodSearchResults($foodid)
    {
        $fooditem = $this->nutritionApiService->getFoodById($foodid);

        if (!$fooditem) {
            return redirect()->route('dashboard')->withErrors(['query' => 'No nutrition details found for the selected item.']);
        }

        if (isset($fooditem['error'])) {
            return redirect()->route('dashboard')->withErrors(['query' => 'Food details may not be available at the moment. Please try again later.']);
        }

        $nutritionData = app(NutritionDataParserService::class)->parse($fooditem);

        return redirect()->route('dashboard')->with([
            'nutritionData' => $nutritionData,
        ]);
    }

    public function addNutritionFromSearch(Request $request)
    {
        $nutritionData = $request->only([
            'calories',
            'calorie_target',
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