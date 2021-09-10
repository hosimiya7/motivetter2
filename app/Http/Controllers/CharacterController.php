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
}
