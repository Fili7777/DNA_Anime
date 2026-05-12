<?php

namespace App\Api;

use App\Models\Anime;
use App\Models\Episode;

interface EpisodeInterface
{
   public function getEpisodesByAnime(string $animeId);
   public function updateOrCreate(array $condizione, array $data);

}
