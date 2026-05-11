<?php

namespace App\Management;

use App\Models\User;
use App\Repository\AnimeRepository;
use App\Repository\FavouriteRepository;
use App\Repository\MangaRepository;
use App\Repository\UserRepository;

class FavouriteManagement
{
    protected AnimeRepository $animeRepository;
    protected UserRepository $userRepository;
    protected FavouriteRepository $favouriteRepository;
    protected MangaRepository $mangaRepository;


    public function __construct(AnimeRepository $animeRepository, MangaRepository $mangaRepository, UserRepository $userRepository, FavouriteRepository $favouriteRepository)
    {
        $this->animeRepository = $animeRepository;
        $this->mangaRepository = $mangaRepository;
        $this->userRepository = $userRepository;
        $this->favouriteRepository = $favouriteRepository;

    }

    //funzione che prende preferiti di un utente
    public function getUserFavourites($userId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->favouriteRepository->getUserFavourites($userId);
    }

    //Funzione che aggiunge un media ( anime o manga ) ai favourites
    public function addMediaToFavourites(User $user, $mediaId, $mediaType)
    {

        $media = null;

        if($mediaType == 'manga'){
            $media = $this->mangaRepository->getById($mediaId);
        }elseif($mediaType == 'anime'){
            $media = $this->animeRepository->getById($mediaId);
        }else{
            throw new \Exception("Unsupported media type");
        }

        if($media !== null){
            $this->favouriteRepository->addUserFavourite($user, $media);
        }

    }
}
