<?php

namespace App\Models;

use App\Api\MangaInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manga extends Model
{
    protected $guarded = ['id']; //permette assegnazione di tutti i campi tranne che per l'id
    //relazione 1 a N con favourable
    public function favourites()
    {
        return $this->morphMany(Favourite::class,'favourable');
    }
}
