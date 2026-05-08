<?php

namespace App\Models;

use App\Api\MangaInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manga extends Model
{
    //relazione 1 a N con favouritable
    public function favourites()
    {
        return $this->morphMany(Favourite::class,'favouriteable');
    }
}
