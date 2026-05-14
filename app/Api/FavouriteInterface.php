<?php

namespace App\Api;

use App\Models\Favourite;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface FavouriteInterface
{
    // Usiamo Model perchè può essere Anime o Manga
    public function addUserFavourite(User $user, Model $favourite);
    public function deleteUserFavourite(User $user, Favourite $favourite);
    public function getUserFavourites(User $user): \Illuminate\Database\Eloquent\Collection;
}
