<?php

namespace App\Http\Resources;

use App\User as UserModel;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            UserModel::ID => $this->id,
            UserModel::NAME => $this->name,
            UserModel::EMAIL => $this->email,
            UserModel::CREATED_AT => $this->created_at,
            UserModel::UPDATED_AT => $this->updated_at,
        ];
        // return parent::toArray($request);
    }
}
