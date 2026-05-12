<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    /** @use HasFactory<\Database\Factories\EpisodeFactory> */
    use HasFactory;
    protected $fillable = ['mal_id','title','anime_id'];
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
