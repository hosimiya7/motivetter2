<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = [

    ];

    public function characterTemplate() {
        return $this->belongsTo(CharacterTemplate::class);
    }
}
