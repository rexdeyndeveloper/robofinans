<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionResource extends AbstractResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return Transaction
     */
    public function toArray($request)
    {
        return $this->normalize();
    }

    public function normalize()
    {
        /** @var Transaction $user */
        $user = $this->resource;
        return $user;
    }
}
