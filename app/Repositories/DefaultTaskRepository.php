<?php

namespace Keikaku\Repositories;

use Keikaku\Contracts\Repository\TaskRepository;
use Keikaku\Models\{
    Category, Project, Task, User
};

class DefaultTaskRepository implements TaskRepository
{
    public function find(array $parameters = [], array $columns = ['*'])
    {
        return empty($parameters) ?
            Task::all($columns) :
            Task::where($parameters)->get($columns);
    }

    public function findOneById(string $id, array $columns = ['*'])
    {
        return Task::where('id', $id)->first($columns);
    }

    public function findByProject(Project $project, bool $archived = false, array $columns = ['*'])
    {
        return $project->tasks()->where('archived', $archived)->get($columns);
    }

    public function findByCategory(Category $category, bool $archived = false, array $columns = ['*'])
    {
        return $category->tasks()->where('archived', $archived)->get($columns);
    }

    public function findByUser(User $user, bool $archived = false, array $columns = ['*'])
    {
        return $user->tasks()->where('archived', $archived)->get($columns);
    }
}