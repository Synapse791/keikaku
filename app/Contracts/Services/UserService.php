<?php

namespace Keikaku\Contracts\Services;

use Keikaku\Models\User;

/**
 * Interface UserService
 * @package Keikaku\Contracts\Services
 */
interface UserService extends ServiceErrors
{
    /**
     * Creates a new User
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User|bool
     */
    function create(string $name, string $email, string $password);

    /**
     * Updates an existing User
     *
     * @param User $user
     * @param array $data
     * @return boolean
     */
    function update(User $user, array $data = []);

    /**
     * Deletes the provided User
     *
     * @param User $user
     * @return mixed
     */
    function delete(User $user);
}