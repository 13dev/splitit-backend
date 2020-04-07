<?php

namespace Modules\User\Repositories;

use Modules\User\Models\User;

interface UserRepositoryInterface
{
    /**
     * Get user by email
     * @param  string  $email
     * @return User
     */
    public function byEmail(string $email): User;

    /**
     * Get user by id.
     * @param  int  $id
     * @return User
     */
    public function byId(int $id): User;
}
