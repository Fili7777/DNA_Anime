<?php

namespace App\Jobs;

use App\Hydrators\AnimeHydrator;
use App\Repository\AnimeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ImportAnimeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    public function __construct(public int $page = 1) {}

    public function handle(AnimeRepository $animeRepository)
    {
        $response = Http::withoutVerifying()->get('https://api.jikan.moe/v4/anime', ['page' => $this->page]);

        //gestione errori
        if ($response->status() === 429) $response->throw();
        if (! $response->ok()) return;

        $delay = 2; // Partiamo con 2 secondo di ritardo

        // Estrazione dati sicura tramnite metodo ->json che nel caso data non ce restituisce array vuoto
        foreach ($response->json('data', []) as $anime) {
            $animeCreato = $animeRepository->updateOrCreate(
                ['mal_id' => $anime['mal_id']], //condizione
                AnimeHydrator::hydrate($anime)
            );

            //
            ImportEpisodeJob::dispatch($animeCreato->getKey(), $anime['mal_id'])->delay($delay);
            $delay += 2;
        }

        // Se c'è una pagina successiva page + 1
        if ($response->json('pagination.has_next_page')) {
            self::dispatch($this->page + 1)->delay($delay + 2);
        }
    }
}
