<?php

namespace App\Api;

use App\Models\Anime;
use Illuminate\Database\Eloquent\Collection;

interface AnimeInterface
{
    public function delete(Anime $anime);
    public function getById(int $id);
    public function getList();
    public function updateOrCreate(array $condizione, array $data): Anime;
}
