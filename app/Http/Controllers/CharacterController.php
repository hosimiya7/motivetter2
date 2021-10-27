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
        $user = Auth::user();

        $goal = $user->goal->orderBy('created_at', 'desc')->first();
        $goal_number = $goal->number;
        $achieve = $request->achieve;

        $gotExp = ($achieve / $goal_number) * 100;
        if ($gotExp > 100) {
            $gotExp = 100;
        }

        // 実行をしないと動かない。
        $character = $user->character->first();
        $currentExp = $character->exp;
        $character->exp = ($currentExp + $gotExp);

        if ($currentExp + $gotExp > 500) {
            $character->character_template_id = 2;
            $character->growth = 1;
        }
        if($currentExp + $gotExp > 1200){
            $character->character_template_id = 3;
            $character->growth = 2;
        }

        $character->save();

        return $character;
    }

    public function food(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::User();
        $belongings = $user->belongings()->get();

        // 一定数で好感度を上げる、進化用条件のチェック、どれだけ食べたかDBでチェック
        $food_quantity = [$request->strawberry,$request->moshi,$request->melon,$request->gress];

        foreach ($belongings as $num => $belonging) {
            $belonging->quantity -= $food_quantity[$num];
            $belonging->save();
        }

        return $belongings;
    }


}
