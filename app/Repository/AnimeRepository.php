<?php

namespace App\Repository;

use App\Api\AnimeInterface;
use App\Models\Anime;

class AnimeRepository implements AnimeInterface
{
    public function delete(Anime $anime)
    {
       return $anime->delete();
    }

    public function getById(int $id)
    {
        return Anime::find($id);
    }

    public function getList(): \Illuminate\Database\Eloquent\Collection
    {
        return Anime::all();
    }

    public function updateOrCreate(array $condizione, array $data): Anime
    {
        return Anime::updateOrCreate($condizione, $data);
    }
}
