<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Favourite extends Model
{
    protected $guarded = ['id']; //permette assegnazione di tutti i campi tranne che per l'id
    // lo facciamo per via del massAssignment siccome noi non salviamo le model ma i dati presi da un array
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //relazione N a 1 verso anime o manga ( grazie a morphs )
    public function favourable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
