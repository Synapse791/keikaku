<?php

namespace Keikaku\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Models\{User, Project, Task};

class DefaultUserRepository implements UserRepository
{
    public function find(array $parameters = []): Collection
    {
        if (empty($parameters))
            return User::all();
        else
            return User::where($parameters)->orderBy('created_at', 'ASC')->get();
    }

    public function findOneById($id)
    {
        return User::where('id', $id)->first();
    }

    public function findOneByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function findByProject(Project $project): Collection
    {
        return $project->users;
    }

    public function findByTask(Task $task): Collection
    {
        return $task->users;
    }
}