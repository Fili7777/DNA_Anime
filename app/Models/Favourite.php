<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favourite extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //relazione N a 1 verso animeo manga ( grazie a morphs )
    public function favourable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
