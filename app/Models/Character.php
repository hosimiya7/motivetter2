<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

        return $character;
    }
}
