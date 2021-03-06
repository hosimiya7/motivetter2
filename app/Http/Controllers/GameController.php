<?php

namespace App\Http\Controllers;

use App\Models\Belonging;
use App\Models\Food;
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

        // 値段
        $foods = DB::table('foods')->where('id', $foodId)->first();
        $price = $foods->price;

        // 現在ポイント
        $currentPoint = $user->point;

        $belonging = $user->belongings()->where('food_id', $foodId)->first();
        $food = $user->belongings()->get();

        if ($currentPoint - $price > 0) {
            $point = $currentPoint - $price;
            $user->point = $point;
            $user->save();
            // foodIdがrequestと同じものを探す。見つかれば個数を1増やす。見つからなければそのfoodIdの行を作る。
            if ($belonging === null) {
                $user->belongings()->create(['food_id' => $request->foodId, 'quantity' => 1]);
            } else {
                $quantity = $belonging->quantity + 1;
                $belonging->quantity = $quantity;
                $belonging->save();
            }
        }

        return [$food, $user];
    }

    public function showFood(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        // $foods = $user->belongings()->with('foods')->get();

        $query = Belonging::query()
            ->join('foods', 'belongings.food_id', '=', 'foods.id')
            ->where('user_id', $user->id)
            ->select(['belongings.*', 'foods.name']);

        return $query->get();
    }
}
