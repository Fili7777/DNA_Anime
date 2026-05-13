<?php

namespace App\Console\Commands;

use App\Hydrators\AnimeHydrator;
use App\Hydrators\MangaHydrator;
use App\Jobs\ImportAnimeJob;
use App\Jobs\ImportMangaJob;
use App\Repository\AnimeRepository;
use App\Repository\MangaRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('importJikanAnime')]
#[Description('Importa Anime e Manga da API jikan')]
class ImportJikanAnime extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        ImportAnimeJob::dispatch();

        echo "\nIMPORTAZIONE AVVIATA DA jikan\n";
    }
}
