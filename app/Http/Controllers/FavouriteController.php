<?php

namespace App\Http\Controllers;

use App\Management\FavouriteManagement;
use App\Models\Favourite;
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
}
