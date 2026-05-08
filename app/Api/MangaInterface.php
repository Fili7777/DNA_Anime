<?php

namespace App\Api;

use App\Models\Manga;

interface MangaInterface
{
    public function delete(Manga $manga);
    public function getById(int $id);
    public function getList();

    public function updateOrCreate(array $condizione, array $data);
}
