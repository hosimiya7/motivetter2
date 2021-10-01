<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class GoalController extends Controller
{
    //
    public function create(Request $request)
    {
        $goal = new \App\Models\Goal;
        $goal->goal = $request->goal;
        $goal->number = $request->number;
        $goal->unit = $request->unit;
        $goal->user_id = Auth::id();
        $goal->save();

        return $goal;
    }

    public function show(Request $request)
    {

        $user_id = Auth::id();
        $goal = \App\Models\Goal::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();

        return $goal;

    }

}
