<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;

class UserResource extends AbstractResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return User
     */
    public function toArray($request)
    {
        return $this->normalize();
    }

    public function normalize()
    {
        /** @var User $user */
        $user = $this->resource;
        return $user;
    }
}
