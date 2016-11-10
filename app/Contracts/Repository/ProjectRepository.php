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
     * @return Collection
     */
    public function find(array $parameters = []);

    /**
     * Finds a single Project by it's ID
     *
     * @param string $id
     * @return Project|null
     */
    public function findOneById(string $id);

    /**
     * Finds all Projects a User is a member of
     *
     * @param User $user
     * @return Collection
     */
    public function findByUser(User $user);

    /**
     * Find all Projects with the provided Currency
     *
     * @param Currency $currency
     * @return Collection
     */
    public function findByCurrency(Currency $currency);

    /**
     * Find the Project containing the provided Task
     *
     * @param Task $task
     * @return Project
     */
    public function findByTask(Task $task);
}