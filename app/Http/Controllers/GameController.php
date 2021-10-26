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

    public function postFood(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $foodId = $request->foodId;

        // foodIdがrequestと同じものを探す。見つかれば個数を1増やす。見つからなければそのfoodIdの行を作る。
        $belonging = $user->belongings()->where('food_id', $foodId)->first();

        if($belonging === null) {
            $user->belongings()->create(['food_id' => $request->foodId,'quantity' => 1]);
        }else{
            $quantity = $belonging->quantity + 1;
            $belonging->quantity = $quantity;
            $belonging->save();
        }

        return $belonging;

    }

    public function showFood(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $foods = $user->belongings()->get();

        return $foods;

    }
}
