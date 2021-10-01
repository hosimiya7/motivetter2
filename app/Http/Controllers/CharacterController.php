<?php

namespace App\Http\Controllers;

use App\Models\CharacterTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CharacterController extends Controller
{
    public function show(Request $request)
    {

        $user_id = Auth::id();
        $character = \App\Models\Character::where('user_id', $user_id)->orderBy('created_at', 'desc')->with('CharacterTemplate')->first();

        // Log::debug($character->characterTemplate);

        return $character;
    }

    public function create(Request $request)
    {
        $character = new \App\Models\Character;
        $character->user_id = Auth::id();
        $character->save();

        return $character;

    }

    public function updateExp(Request $request)
    {
        $user_id = Auth::id();
        // 実行をしないと動かない。
        $character = \App\Models\Character::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
        $character->exp = $request->exp;
        $character->save();
    }
}
