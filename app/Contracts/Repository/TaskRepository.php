<?php

namespace Keikaku\Contracts\Repository;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Models\{
    Project, Task, User, Category
};

/**
 * Interface TaskRepository
 * @package Keikaku\Contracts\Repository
 */
interface TaskRepository
{
    /**
     * Finds Tasks based on the provided parameters
     *
     * @param array $parameters
     * @param array $columns
     * @return Collection
     */
    public function find(array $parameters = [], array $columns = ['*']);

    /**
     * Finds a single Task by it's ID
     *
     * @param string $id
     * @param array $columns
     * @return Task|null
     */
    public function findOneById(string $id, array $columns = ['*']);

    /**
     * Finds all of a User's tasks
     *
     * @param User $user
     * @param bool $archived
     * @param array $columns
     * @return Collection
     */
    public function findByUser(User $user, bool $archived = false, array $columns = ['*']);

    /**
     * Find all Tasks in the provided Category
     *
     * @param Category $category
     * @param bool $archived
     * @param array $columns
     * @return Collection
     */
    public function findByCategory(Category $category, bool $archived = false, array $columns = ['*']);

    /**
     * Find all Tasks in a Project
     *
     * @param Project $project
     * @param bool $archived
     * @param array $columns
     * @return Collection
     */
    public function findByProject(Project $project, bool $archived = false, array $columns = ['*']);
}