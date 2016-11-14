<?php

namespace Keikaku\Contracts\Repository;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Models\Category;
use Keikaku\Models\Task;

interface CategoryRepository
{
    /**
     * Find Categories based on the provided parameters
     *
     * @param array $parameters
     * @param array $columns
     * @return Collection
     */
    public function find(array $parameters = [], array $columns = ['*']);

    /**
     * Find a single Category by it's ID
     *
     * @param string $id
     * @param array $columns
     * @return Category|null
     */
    public function findOneById(string $id, array $columns = ['*']);

    /**
     * Find Category from a Task
     *
     * @param Task $task
     * @return Category|null
     */
    public function findOneByTask(Task $task);
}