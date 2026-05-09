<?php

namespace App\Repository;

use App\Api\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface
{

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        return $user->update($data);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function getAll(): Collection
    {
        return User::all();
    }
}
