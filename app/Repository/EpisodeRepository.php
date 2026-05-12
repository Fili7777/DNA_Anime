<?php

namespace App\Repository;

use App\Api\EpisodeInterface;
use App\Models\Anime;
use App\Models\Episode;

class EpisodeRepository implements EpisodeInterface
{

    public function getEpisodesByAnime(string $animeId)
    {
        return Episode::where('anime_id', $animeId)->get();
    }

    public function updateOrCreate(array $condizione, array $data)
    {
        return Episode::updateOrCreate($condizione, $data);
    }
}
