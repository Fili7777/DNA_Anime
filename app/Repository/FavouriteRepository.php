<?php

namespace App\Repository;

use App\Api\FavouriteInterface;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FavouriteRepository implements FavouriteInterface
{

    public function addUserFavourite(User $user, Model $favourite): Model
    {
        //controlla se già esiste sennò lo crea
        return Favourite::firstOrCreate([
            'user_id' => $user->id,
            'favourable_id'=>$favourite->id ,
            'favourable_type'=>get_class($favourite)]);
    }

    public function deleteUserFavourite(User $user, Model $favourite)
    {
        return $user->favourites()->where([
            'favourable_id' => $favourite->id, 'favourable_type' => get_class($favourite)
        ])->delete();
    }

    public function getUserFavourites(User $user): \Illuminate\Database\Eloquent\Collection
    {
        //per evitare n+1 query, facciamo che richiamiamo i favourites di un utente includendo anche gli anime o manga relativi
        return $user->favourites()->with('favourable')->get();
    }
}
