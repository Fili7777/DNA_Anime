<?php

namespace App\Hydrators;


class MangaHydrator
{
    public static function hydrate(array $manga): array
    {
        return [
            'title' => $manga['title'],
            'rank' => $manga['rank'] ?? null,
            'image_url' => $manga['images']['jpg']['image_url'] ?? null,
            'volumes' => $manga['volumes'] ?? null,
            'status' => $manga['status']
        ];

    }
}
