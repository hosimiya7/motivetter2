<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class GoalController extends Controller
{

    public function create(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        if ($user->goal === null) {
            \App\Models\Goal::insert(
                [
                    'user_id' => $user->id,
                    'goal' => $request->goal,
                    'number' => $request->number,
                    'unit' => $request->unit,
                ]
            );
        } else {
            $user->goal->fill($request->all())->save();
        }

        return $user->goal;
    }

    public function show(Request $request)
    {

        /**
         * @var User $user
         */
        $user = Auth::user();
        $goal = $user->goal;

        return $goal;
    }
}
