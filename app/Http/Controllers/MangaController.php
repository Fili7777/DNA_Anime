<?php

namespace App\Http\Controllers;


use App\Repository\MangaRepository;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    //
    public function show_manga(MangaRepository $mangaRepository)
    {
        $mangaList = $mangaRepository->getList();

        return view('manga.show_manga', compact('mangaList'));
    }
}
