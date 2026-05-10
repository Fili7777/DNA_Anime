<?php

namespace App\Jobs;

use App\Hydrators\MangaHydrator;
use App\Repository\MangaRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ImportMangaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $page = 1) {}
    //ci viene richiamato col dispatch in automatico

    public function handle(MangaRepository $mangaRepository)
    {
        $response = Http::withoutVerifying()->get('https://api.jikan.moe/v4/manga', ['page' => $this->page]);

        if ($response->ok()) {
            $data = $response->json();
            foreach ($data['data'] as $manga) {
                $mangaRepository->updateOrCreate(
                    ['mal_id' => $manga['mal_id']],
                    MangaHydrator::hydrate($manga)
                );
            }

            if ($data['pagination']['has_next_page']) {
                ImportMangaJob::dispatch($this->page + 1)->delay(now()->addMilliseconds(350));
                //ricorsione sul job aumentando la pagina di 1 che andrà nel cosutruttore
            }
        } else {
            \Log::error("Errore scaricamento Manga a pagina {$this->page}");
        }
    }
}
