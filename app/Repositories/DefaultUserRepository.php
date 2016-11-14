<?php

namespace Keikaku\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Models\{User, Project, Task};

class DefaultUserRepository implements UserRepository
{
    public function find(array $parameters = [], array $columns = ['*']): Collection
    {
        return empty($parameters) ?
            User::all($columns) :
            User::where($parameters)->orderBy('created_at', 'ASC')->get($columns);
    }

    public function findOneById($id, array $columns = ['*'])
    {
        return User::where('id', $id)->first($columns);
    }

    public function findOneByEmail($email, array $columns = ['*'])
    {
        return User::where('email', $email)->first($columns);
    }

    public function findByProject(Project $project, array $columns = ['*']): Collection
    {
        return $project->users()->get($columns);
    }

    public function findByTask(Task $task, array $columns = ['*']): Collection
    {
        return $task->users()->get($columns);
    }
}