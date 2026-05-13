<?php

namespace App\Console\Commands;

use App\Jobs\ImportMangaJob;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('importJikanManga')]
#[Description('Command description')]
class ImportJikanManga extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        ImportMangaJob::dispatch();
    }
}
