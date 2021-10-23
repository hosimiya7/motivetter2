<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //
    public function postOmikujiPoint(Request $request)
    {
        $user = Auth::user();


        return $user->point;

    }
}
