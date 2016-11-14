<?php

namespace Keikaku\Repositories;

use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Models\{
    Project, User, Currency, Task
};

class DefaultProjectRepository implements ProjectRepository
{
    public function find(array $parameters = [], array $columns = ['*'])
    {
        return empty($parameters) ?
            Project::all($columns) :
            Project::where($parameters)->get($columns);
    }

    public function findOneById(string $id, array $columns = ['*'])
    {
        return Project::where('id', $id)->first($columns);
    }

    public function findByUser(User $user, array $columns = ['*'])
    {
        return $user->projects()->get($columns);
    }

    public function findByCurrency(Currency $currency, array $columns = ['*'])
    {
        return $currency->projects()->get($columns);
    }

    public function findByTask(Task $task)
    {
        return $task->project;
    }
}