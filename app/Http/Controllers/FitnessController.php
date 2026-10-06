<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fitness;

class FitnessController extends Controller
{
    public function index()
    {
        $fitness = Fitness::where('user_id', auth()->id())->first();

        return view('fitness', compact('fitness'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'current_weight' => 'required|numeric',
            'target_weight' => 'required|numeric',
            'height_ft' => 'required|integer',
            'height_in' => 'required|integer',
            'age' => 'required|integer',
            'sex' => 'required|string',
        ]);

        $validated['user_id'] = $request->user()->id;

        $request->user()->fitness()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return redirect()->route('dashboard');
    }
}