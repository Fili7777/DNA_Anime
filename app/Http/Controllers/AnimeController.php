<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use App\Repository\EpisodeRepository;
use Illuminate\Http\Request;

class AnimeController extends Controller
{

    public function show_anime(AnimeRepository $animeRepository)
    {
        $animeList = $animeRepository->getList();

        return view('anime.show_anime', compact('animeList'));
    }

    public function show_anime_details($id, EpisodeRepository $episodeRepository)
    {
        $episodeList = $episodeRepository->getEpisodesByAnime($id);

        return view('anime.show_anime_details', compact('episodeList'));
    }
}
