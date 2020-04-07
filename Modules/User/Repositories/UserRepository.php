<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\User\Exceptions\UserNotFoundException;
use Modules\User\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param  string  $email
     * @return User
     * @throws UserNotFoundException
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
     * @param  int  $id
     * @return User
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

    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
