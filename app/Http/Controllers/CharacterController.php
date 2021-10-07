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

        $user = Auth::User();
        $character = $user->character()->with('characterTemplate')->first();

        // Log::debug($character->characterTemplate);

        return $character;
    }

    public function delete(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        // userModelに紐づいたcharacterを削除
        $user->character->delete();
        $user_id = Auth::id();
        $character = $user->character->create(['user_id' => $user_id]);

        return $character;

    }

    public function updateExp(Request $request)
    {
        $user = Auth::user();

        $goal = $user->goal->orderBy('created_at', 'desc')->first();
        $goal_number = $goal->number;
        $achieve = $request->achieve;

        $gotExp = ($achieve / $goal_number) * 100;

        // 実行をしないと動かない。
        $character = $user->character->first();
        $currentExp = $character->exp;
        $character->exp = ($currentExp + $gotExp);
        $character->save();

        return $character;
    }
}
