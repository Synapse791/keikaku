<?php

namespace Keikaku\Contracts\Repository;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Models\{Project, Task, User};

/**
 * Interface UserRepository
 * @package Keikaku\Contracts\Repository
 */
interface UserRepository
{
    /**
     * Find users based on the provided parameters
     *
     * @param array $parameters
     * @return Collection
     */
    public function find(array $parameters = []);

    /**
     * Find a single user by their ID
     *
     * @param string $id
     * @return User|null
     */
    public function findOneById($id);

    /**
     * Find a single user by their email
     *
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail($email);

    /**
     * Find all users assigned to a project
     *
     * @param Project $project
     * @return Collection
     */
    public function findByProject(Project $project);

    /**
     * Find all users assigned to a task
     *
     * @param Task $task
     * @return Collection
     */
    public function findByTask(Task $task);
}