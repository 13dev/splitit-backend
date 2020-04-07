<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Models\User;

class UserResource extends JsonResource
{
    private $token;

    /**
     * UserResource constructor.
     * @param $resource
     * @param $token
     */
    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }

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
            'token' => $this->addToken(),
        ];
        // return parent::toArray($request);
    }

    /**
     * Add token to resource
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    private function addToken()
    {
        return $this->when(
            $this->token !== null,
            fn () => $this->token
        );
    }
}
