<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use App\Repository\EpisodeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{

    public function show_anime(AnimeRepository $animeRepository)
    {
        $animeList = $animeRepository->getList();

        return view('anime.show_anime', compact('animeList'));
    }

    public function show_anime_details($id)
    {
        $response = Http::withoutVerifying()->get("https://api.jikan.moe/v4/anime/{$id}/reviews");
        if ($response->status() === 429) $response->throw();
        $reviews = [];
        if (! $response->ok()) return view('anime.show_anime_details', compact('reviews'));

        foreach($response->json('data', []) as $review){
            $reviews[] = $review['review'];
        }
        return view('anime.show_anime_details', compact('reviews'));
    }
}
