<?php

namespace App\Http\Controllers;

use App\Services\Nutrition\NutritionService;
use App\Services\Nutrition\NutritionApiService;
use App\Services\Nutrition\NutritionDataParserService;
use Illuminate\Http\Request;
use App\Models\Nutrition;
use App\Models\Macro;

class NutritionController extends Controller
{
    public function __construct()
    {
        $this->nutritionApiService = app(NutritionApiService::class);
        $this->nutritionService = app(NutritionService::class);
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
        $validated = $request->validate([
            'calories'      => 'nullable|numeric|min:0',
            'protein'       => 'nullable|numeric|min:0',
            'carbohydrate'  => 'nullable|numeric|min:0',
            'fat'           => 'nullable|numeric|min:0',
            'fiber'         => 'nullable|numeric|min:0',
            'sugar'         => 'nullable|numeric|min:0',
            'cholesterol'   => 'nullable|numeric|min:0',
            'sodium'        => 'nullable|numeric|min:0',
            'saturated_fat' => 'nullable|numeric|min:0',
        ]);

        Nutrition::create(array_merge(['user_id' => auth()->id()], $validated));

        if ($request->wantsJson() || $request->ajax()) {
            $userId = auth()->id();

            return response()->json([
                'data' => $this->nutritionService->totalsForUser(
                    $userId,
                    Macro::where('user_id', $userId)->first(),
                    Nutrition::getDailyNutritionForUser($userId)
                ),
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Nutrition data added successfully.');
    }

    public function showNutritionForm()
    {
        return view('nutrition');
    }
}