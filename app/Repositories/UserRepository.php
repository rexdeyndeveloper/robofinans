<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use RuntimeException;

class UserRepository implements UserRepositoryInterface
{

    public function getAll(?array $with = ['wallet'])
    {
        $users = User::query()->with($with)->get();
        if ($users->isEmpty()) {
            throw new RuntimeException('Users not founds', 404);
        }
        return $users;
    }

    public function getById(int $id, ?array $with = ['wallet'])
    {
        $user = User::query()->with($with)->find($id);
        if ($user === null) {
            throw new RuntimeException('User not found', 404);
        }
        return $user;
    }
}
