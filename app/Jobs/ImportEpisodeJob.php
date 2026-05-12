<?php

namespace App\Jobs;

use App\Repository\EpisodeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ImportEpisodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $anime_id, public int $mal_id, public int $page = 1) {}

    public function handle(EpisodeRepository $episodeRepository)
    {
        $response = Http::withoutVerifying()->get("https://api.jikan.moe/v4/anime/{$this->mal_id}/episodes", ['page' => $this->page]);

        // Se è un errore 429 riprova. Se è un 404 fermati.
        if ($response->status() === 429) $response->throw();
        if (! $response->ok()) return;

        // Estrai i dati ( SE IL CAMPO DATA NON è PRESENTE METTE ARRAY VUOTO )
        foreach ($response->json('data', []) as $episode) {
            $episodeRepository->updateOrCreate(
                //se l'episodio con quell'anime id e mal id già esiste lo aggiorna.
                ['anime_id' => $this->anime_id, 'mal_id' => $episode['mal_id']], //condizione
                ['title' => $episode['title']]
            );
        }

        // Se c'è una pagina successiva, lanciala con 1 secondi di ritardo
        if ($response->json('pagination.has_next_page')) {
            self::dispatch($this->anime_id, $this->mal_id, $this->page + 1)->delay(1);
        }
    }
}
