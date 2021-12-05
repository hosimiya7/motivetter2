<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Log;

class Character extends Model
{
    protected $guarded = [];

    public function characterTemplate()
    {
        return $this->belongsTo(CharacterTemplate::class);
    }

    public static function getRenewCharacter(User $user): self
    {
        // userModelに紐づいたcharacterを削除
        $user->character()->delete();
        $character = $user->character()->create();

        // 食べたもの削除
        $ate_foods = $user->ate_foods()->get();
        foreach ($ate_foods as $ate_food){
            $ate_food->quantity = 0;
            $ate_food->save();
        }

        return $character;
    }
}
