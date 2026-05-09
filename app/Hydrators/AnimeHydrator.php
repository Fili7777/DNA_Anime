<?php

namespace App\Hydrators;


class AnimeHydrator
{
    public static function hydrate(array $anime): array
    {
        return [
            'title' => $anime['title'],
            'rank' => $anime['rank'] ?? null,
            'image_url' => $anime['images']['jpg']['image_url'] ?? null,
            'episodes' => $anime['episodes'],
            'status' => $anime['status']
        ];
    }
}
