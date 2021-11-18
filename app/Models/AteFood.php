<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AteFood extends Model
{
    //
    protected $guarded = [];
    protected $table = "ate_foods";

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
