<?php
declare(strict_types=1);


namespace App\Repositories\Interfaces;


interface UserRepositoryInterface
{
    public function getAll(?array $with = []);

    public function getById(int $id, ?array $with = []);
}
