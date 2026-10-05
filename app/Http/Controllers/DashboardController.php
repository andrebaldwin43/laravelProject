<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fitness;

class DashboardController extends Controller
{
    public function index()
    {
        $fitness = Fitness::where('user_id', auth()->id())->first();

        return view('dashboard', compact('fitness'));
    }
}
