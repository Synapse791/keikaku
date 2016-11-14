<?php

namespace Keikaku\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Contracts\Repository\CategoryRepository;
use Keikaku\Models\{Category, Task};

class DefaultCategoryRepository implements CategoryRepository
{
    public function find(array $parameters = [], array $columns = ['*']): Collection
    {
        return empty($parameters) ?
            Category::all($columns) :
            Category::where($parameters)->get($columns);
    }

    public function findOneById(string $id, array $columns = ['*'])
    {
        return Category::where('id', $id)->first($columns);
    }

    public function findOneByTask(Task $task)
    {
        return $task->category;
    }
}