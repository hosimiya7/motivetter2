<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalController extends Controller
{
    //
    public function create(Request $request)
    {
        $goal = new \App\Models\Goal;
        $goal->goal = $request->goal;
        $goal->number = $request->number;
        $goal->unit = $request->unit;
        $goal->save();

        return $goal;
    }
}
