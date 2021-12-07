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

    // えさやり
    public function food(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::User();

        // 一定数で好感度を上げる　所持している餌が0以上でないといけない
        $food_quantities = [$request->food_1, $request->food_2, $request->food_3, $request->food_4];

        foreach ($food_quantities as $num => $food_quantity) {
            $belongings = $user->belongings()->where('food_id', $num + 1)->first();
            $ate_foods = $user->ate_foods()->where('food_id', $num + 1)->first();
            $belongings->quantity -= $food_quantity;
            $ate_foods->quantity += $food_quantity;
            if($belongings->quantity >= 0){
                $belongings->save();
                $ate_foods->save();
            }
        }

        return $user->belongings()->get();
    }
}
