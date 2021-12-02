<?php

namespace App\Http\Controllers;

use App\Models\CharacterTemplate;
use App\Models\Character;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CharacterController extends Controller
{
    public function show(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::User();
        $character = $user->character()->with('characterTemplate')->first();

        // Log::debug($character->characterTemplate);

        return $character;
    }

    public function delete(Request $request)
    {
        // 今まで食べたご飯を消す
        return Character::getRenewCharacter(Auth::User());
    }

    public function updateExp(Request $request)
    {

         /**
         * @var User $user
         */
        $user = Auth::user();

        $goal = $user->goal->orderBy('created_at', 'desc')->first();
        $goal_number = $goal->number;
        $achieve = $request->achieve;

        $gotExp = ($achieve / $goal_number) * 100;
        if ($gotExp > 100) {
            $gotExp = 100;
        }

        // 実行をしないと動かない。user_idが違う…。
        $character = $user->character;
        $currentExp = $character->exp;
        $character->exp = ($currentExp + $gotExp);

        if ($currentExp + $gotExp > 500) {
            $character->character_template_id = 2;
            $character->growth = 1;
        }
        if ($currentExp + $gotExp > 1200) {
            $character->character_template_id = 3;
            $character->growth = 2;
        }

        $character->save();

        return $user->character()->with('characterTemplate')->first();
    }

    public function food(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::User();

        // 一定数で好感度を上げる　0以上でないといけない nameを紐づけたい
        $food_quantities = [$request->food_1, $request->food_2, $request->food_3, $request->food_4];

        foreach ($food_quantities as $num => $food_quantity) {
            $belongings = $user->belongings()->where('food_id', $num + 1)->first();
            if ($belongings === null) {
                $user->belongings()->create(['food_id' => $num + 1, 'quantity' => $food_quantity !== null ? $food_quantity : 0]);
            } else {
                $belongings->quantity -= $food_quantity;
                $belongings->save();
            }
        }

        foreach ($food_quantities as $num => $food_quantity) {
            $ate_foods = $user->ate_foods()->where('food_id', $num + 1)->first();
            if ($ate_foods === null) {
                $user->ate_foods()->create(['food_id' => $num + 1, 'quantity' => $food_quantity !== null ? $food_quantity : 0]);
            } else {
                $ate_foods->quantity += $food_quantity;
                $ate_foods->save();
            }
        }

        return $user->belongings()->get();
    }
}
