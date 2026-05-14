<?php

namespace App\Http\Controllers;

use App\Management\FavouriteManagement;
use App\Models\Favourite;
use App\Repository\FavouriteRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    //
    public function show_favourite(FavouriteManagement $favouriteManagement)
    {
       $favourites = $favouriteManagement->getUserFavourites(Auth::user());
       return view('favourite.show_favourite', compact('favourites'));
    }

    public function delete_favourite(Favourite $favourite, FavouriteRepository $favouriteRepository)
    {
        $favouriteRepository->deleteUserFavourite(Auth::user(), $favourite);
        return back();
    }

    public function add_anime(\App\Models\Anime $anime, FavouriteRepository $favouriteRepository)
    {
        $favouriteRepository->addUserFavourite(Auth::user(), $anime);
        return back()->with('success', 'Anime aggiunto!');
    }

    public function add_manga(\App\Models\Manga $manga, FavouriteRepository $favouriteRepository)
    {
        $favouriteRepository->addUserFavourite(Auth::user(), $manga);
        return back()->with('success', 'Manga aggiunto!');
    }

}
