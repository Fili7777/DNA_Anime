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
use Log;

class ImportAnimeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $page = 1) {} //ci viene richiamato col dispatch in automatico

    public function handle(AnimeRepository $animeRepository)
    {
        $response = Http::withoutVerifying()->get('https://api.jikan.moe/v4/anime', ['page' => $this->page]);

        if ($response->ok()) {
            $data = $response->json();
            foreach ($data['data'] as $anime) {
                $animeRepository->updateOrCreate(
                    ['mal_id' => $anime['mal_id']],
                    AnimeHydrator::hydrate($anime)
                );
            }

            if ($data['pagination']['has_next_page']) {
                ImportAnimeJob::dispatch($this->page + 1)->delay(now()->addMilliseconds(350));
                //ricorsione sul job aumentando la pagina di 1 che andrà nel cosutruttore
            }
        } else {
            Log::error("Errore scaricamento Anime a pagina {$this->page}");
        }
    }
}
