<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *@param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'uuid' =>  $this->uuid,

            'name' =>$this->name,
            'email'=>$this->email,
        ];
    }
}
