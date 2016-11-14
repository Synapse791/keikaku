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
     * @param array $columns
     * @return Collection
     */
    public function find(array $parameters = [], array $columns = ['*']);

    /**
     * Find a single user by their ID
     *
     * @param string $id
     * @param array $columns
     * @return User|null
     */
    public function findOneById($id, array $columns = ['*']);

    /**
     * Find a single user by their email
     *
     * @param string $email
     * @param array $columns
     * @return User|null
     */
    public function findOneByEmail($email, array $columns = ['*']);

    /**
     * Find all users assigned to a project
     *
     * @param Project $project
     * @param array $columns
     * @return Collection
     */
    public function findByProject(Project $project, array $columns = ['*']);

    /**
     * Find all users assigned to a task
     *
     * @param Task $task
     * @param array $columns
     * @return Collection
     */
    public function findByTask(Task $task, array $columns = ['*']);
}