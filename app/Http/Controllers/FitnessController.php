<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FitnessController extends Controller
{
    public function index()
    {
        return view('fitness');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'current_weight' => 'required|numeric',
            'target_weight' => 'required|numeric',
            'height' => 'required|string',
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