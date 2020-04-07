<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Models\User;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            User::ID => $this->id,
            User::NAME => $this->name,
            User::EMAIL => $this->email,
            User::CREATED_AT => $this->created_at,
            User::UPDATED_AT => $this->updated_at,
        ];
        // return parent::toArray($request);
    }
}
