<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    //relazione 1 a N con favourable
    public function favourites()
    {
        return $this->morphMany(Favourite::class,'favourable');
    }
}
