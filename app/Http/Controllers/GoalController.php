<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class GoalController extends Controller
{

     public function create(Request $request)
    {
        $user = Auth::user();
        $user->goal->fill($request->all())->save();

        return $user->goal;

    }

    public function show(Request $request)
    {

        $user = Auth::User();
        $goal = $user->goal->first();

        return $goal;

    }

}
