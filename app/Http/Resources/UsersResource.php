<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;

class UsersResource extends AbstractResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array[]
     */
    public function toArray($request)
    {
        return [
            'list' => $this->normalize(),
        ];
    }

    public function normalize()
    {
        /** @var User[] $users */
        $users = $this->resource;
        $payload = [];
        foreach ($users as $user) {
            $payload[] = (new UserResource($user))->normalize();
        }
        return $payload;
    }
}
