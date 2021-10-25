<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    //
    public function postPoint(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $currentPoint = $user->point;
        $newPoint = $request->point;
        $user->point = $currentPoint + $newPoint;
        $user->save();

        return $user->point;

    }

    public function showPoint(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $user->first;

        return $user;

    }
}
