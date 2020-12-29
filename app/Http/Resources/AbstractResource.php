<?php
declare(strict_types=1);


namespace App\Http\Resources;


use App\Contracts\Resource\ResourceContract;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class AbstractResource extends JsonResource implements ResourceContract
{
    public function normalize()
    {
        return $this->resource;
    }
}
