<?php

namespace App\Repository;

use App\Api\MangaInterface;
use App\Models\Manga;
use Illuminate\Support\Collection;


class MangaRepository implements MangaInterface
{

    public function delete(Manga $manga)
    {
       return $manga->delete();
    }

    public function getById(int $id)
    {
        return Manga::find($id);
    }

    public function getList()
    {
        return Manga::simplePaginate(20);
    }

    public function updateOrCreate(array $condizione, array $data)
    {
        return Manga::updateOrCreate($condizione, $data);
    }


}
