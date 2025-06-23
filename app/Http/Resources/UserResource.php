<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'first_name' =>$this->first_name,
            'last_name' =>$this->last_name,
            'alias' =>$this->alias,
            'email'=>$this->email,

        ];
    }
}
