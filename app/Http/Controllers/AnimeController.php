<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Repository\AnimeRepository;
use App\Repository\EpisodeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{

    public function show_anime(AnimeRepository $animeRepository)
    {
        $animeList = $animeRepository->getList();


        return view('anime.show_anime', compact('animeList'));
    }

    public function show_anime_details($id, AnimeRepository $animeRepository)
    {
        $anime = $animeRepository->getById($id);

        $reviews = Cache::remember("anime_reviews_{$id}", now()->addHours(24), function () use($id)  { // con use diciamo prendi il parametro automaticamente

            $response = Http::withoutVerifying()->get("https://api.jikan.moe/v4/anime/{$id}/reviews");
            if ($response->status() === 429) $response->throw(); //429 too many request

            $reviews_to_save = [];
            if (! $response->ok()) { //se c'è un errore ritorno array vuoto
                return $reviews_to_save;
            }
            foreach($response->json('data', []) as $review){
                $reviews_to_save[] = $review['review'];
            }
            return $reviews_to_save; //Ritorno array con reviews.
        });

         return view('anime.show_anime_details', compact('reviews', 'anime'));
    }
}
