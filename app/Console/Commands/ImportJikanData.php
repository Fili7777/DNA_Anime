<?php

namespace App\Console\Commands;

use App\Hydrators\AnimeHydrator;
use App\Hydrators\MangaHydrator;
use App\Repository\AnimeRepository;
use App\Repository\MangaRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('importJikanData')]
#[Description('Importa Anime e Manga da API jikan')]
class ImportJikanData extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(AnimeRepository $animeRepository, MangaRepository $mangaRepository)
    {
        $page = 1;

        do {
            $responseAnime = Http::withoutVerifying()->get('https://api.jikan.moe/v4/anime', ['page' => $page]);
            $responseManga = Http::withoutVerifying()->get('https://api.jikan.moe/v4/manga', ['page' => $page]);

            if($responseAnime->ok()){
                $data = $responseAnime->json();
                foreach($data['data'] as $anime){
                    $animeRepository->updateOrCreate(
                        ['mal_id' => $anime['mal_id']],
                        AnimeHydrator::hydrate($anime)
                    );
                }
            }else{
                $this->error("Errore scaricamento Anime a pagina $page");
                continue;
            }
            if($responseManga->ok()){
                $data = $responseManga->json();
                foreach($data['data'] as $manga){
                    $mangaRepository->updateOrCreate(
                        ['mal_id' => $manga['mal_id']],
                        MangaHydrator::hydrate($manga)
                    );
                }
            }else{
                $this->error("Errore scaricamento Manga a pagina $page");
                continue;
            }

            $page++;
            sleep(1);
            }while($page <= 20);
    }
}
