<?php

namespace App\Http\Controllers;


use App\Repository\MangaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MangaController extends Controller
{
    //
    public function show_manga(MangaRepository $mangaRepository)
    {
        $mangaList = $mangaRepository->getList();

        return view('manga.show_manga', compact('mangaList'));
    }

    public function show_manga_details(string $id)
    {
        $response = Http::withoutVerifying()->get("https://api.jikan.moe/v4/manga/{$id}/reviews");
        if ($response->status() === 429) $response->throw();
        $reviews = [];
        if (! $response->ok()) return view('manga.show_manga_details', compact('reviews'));
        foreach($response->json('data', []) as $review){
            $reviews[] = $review['review'];
        }

        return view('manga.show_manga_details', compact('reviews'));
    }
}
