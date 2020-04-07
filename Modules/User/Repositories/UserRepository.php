<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\User\Exceptions\UserNotFoundException;
use Modules\User\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function byEmail(string $email): User
    {
        try {
            return $this
                ->findWhere([User::EMAIL => $email])
                ->first();
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException;
        }
    }

    /**
     * @inheritDoc
     * @throws UserNotFoundException
     */
    public function byId(int $id): User
    {
        try {
            return $this->find($id)->first();
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException;
        }
    }

    public function model()
    {
        return User::class;
    }
}
