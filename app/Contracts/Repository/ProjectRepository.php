<?php

namespace Keikaku\Contracts\Repository;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Models\{
    Project, User, Currency, Task
};

/**
 * Interface ProjectRepository
 * @package Keikaku\Contracts\Repository
 */
interface ProjectRepository
{
    /**
     * Finds Projects based on the provided parameters
     *
     * @param array $parameters
     * @param array $columns
     * @return Collection
     */
    public function find(array $parameters = [], array $columns = ['*']);

    /**
     * Finds a single Project by it's ID
     *
     * @param string $id
     * @param array $columns
     * @return Project|null
     */
    public function findOneById(string $id, array $columns = ['*']);

    /**
     * Finds all Projects a User is a member of
     *
     * @param User $user
     * @param array $columns
     * @return Collection
     */
    public function findByUser(User $user, array $columns = ['*']);

    /**
     * Find all Projects with the provided Currency
     *
     * @param Currency $currency
     * @param array $columns
     * @return Collection
     */
    public function findByCurrency(Currency $currency, array $columns = ['*']);

    /**
     * Find the Project containing the provided Task
     *
     * @param Task $task
     * @return Project
     */
    public function findByTask(Task $task);
}