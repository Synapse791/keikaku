<?php

namespace Keikaku\Repositories;

use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Models\{
    Project, User, Currency, Task
};

class DefaultProjectRepository implements ProjectRepository
{
    public function find(array $parameters = [])
    {
        return empty($parameters) ? Project::all() : Project::where($parameters)->get();
    }

    public function findOneById(string $id)
    {
        return Project::where('id', $id)->first();
    }

    public function findByUser(User $user)
    {
        return $user->projects;
    }

    public function findByCurrency(Currency $currency)
    {
        return $currency->projects;
    }

    public function findByTask(Task $task)
    {
        return $task->project;
    }

    public function newQuery()
    {
        return Project::query();
    }
}