<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $guarded = ['id']; //permette assegnazione di tutti i campi tranne che per l'id

    //relazione 1 a N con favourable
    public function favourites()
    {
        return $this->morphMany(Favourite::class,'favourable');
    }
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
