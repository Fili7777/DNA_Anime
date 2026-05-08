<?php

namespace App\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{
    //prende un array di dati e crea l'utente
    public function create(array $data): User;

    //prende l'utente esistente e un array di dati da aggiornare
    public function update(User $user, array $data);

    public function delete(User $user);

    public function getById(int $id): ?User;

    public function getAll(): Collection;
}
