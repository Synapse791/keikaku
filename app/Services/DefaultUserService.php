<?php

namespace Keikaku\Services;

use Illuminate\Hashing\BcryptHasher;
use Keikaku\Contracts\Services\UserService;
use Keikaku\Models\User;

/**
 * Class DefaultUserService
 * @package Keikaku\Services
 */
class DefaultUserService extends BaseService implements UserService
{
    /** @var BcryptHasher */
    private $hasher;

    /**
     * DefaultUserService constructor
     *
     * @param BcryptHasher $hasher
     */
    public function __construct(BcryptHasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function create(string $name, string $email, string $password)
    {
        if (empty($name))
            return $this->setBadRequest('The name field cannot be empty');

        if (empty($email))
            return $this->setBadRequest('The email field cannot be empty');

        if (empty($password))
            return $this->setBadRequest('The password field cannot be empty');

        if (strlen($password) < 6)
            return $this->setBadRequest('The password field must be at least 6 characters long');

        $newUser = new User();

        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $this->hasher->make($password);

        return $this->saveEntity($newUser);
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function update(User $user, array $data = [])
    {
        if (empty($data))
            return true;

        if (isset($data['name']) && ! is_null($data['name']))
            $user->name = $data['name'];

        if (isset($data['email']) && ! is_null($data['email']))
            $user->email = $data['email'];

        if (isset($data['password']) && ! is_null($data['password']))
            $user->password = $this->hasher->make($data['password']);

        return $this->saveEntity($user);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $this->deleteEntity($user);
    }
}