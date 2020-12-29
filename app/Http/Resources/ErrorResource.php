<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ErrorResource extends AbstractResource
{
    public function toResponse($request)
    {
        $resource = $this->resource;
        $code = $resource->getCode();
        $message = $resource->getMessage();
        return parent::toResponse($request)->setStatusCode($code, $message);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return ['error' => $this->normalize()];
    }

    public function normalize()
    {
        return ['code' => $this->resource->getCode(), 'message' => $this->resource->getMessage()];
    }


}
