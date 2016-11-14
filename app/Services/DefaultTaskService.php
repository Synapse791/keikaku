<?php

namespace Keikaku\Services;

use Keikaku\Contracts\Services\TaskService;
use Keikaku\Models\Category;
use Keikaku\Models\Project;
use Keikaku\Models\Task;
use Keikaku\Models\User;

class DefaultTaskService extends BaseService implements TaskService
{
    public function create(
        Project $project,
        Category $category,
        string $title,
        string $description = '',
        float $estimatedCost = null,
        \DateTime $dueDate = null
    )
    {
        if (empty($title))
            return $this->setBadRequestError('The title field cannot be empty');

        $newTask = new Task();

        if (!$this->associateEntities($newTask->project(), $project))
            return false;

        if (!$this->associateEntities($newTask->category(), $category))
            return false;

        $newTask->title = $title;
        $newTask->description = $description;
        $newTask->estimated_cost = $estimatedCost;
        $newTask->due_date = $dueDate;

        return $this->saveEntity($newTask);
    }

    public function update(Task $task, array $data = [])
    {
        if (isset($data['project']) && $data['project'] instanceof Project)
            if (!$this->associateEntities($task->project(), $data['project']))
                return false;

        if (isset($data['category']) && $data['category'] instanceof Category)
            if (!$this->associateEntities($task->category(), $data['category']))
                return false;

        if (isset($data['title']))
            if (is_string($data['title']))
                $task->title = $data['title'];
            else
               return $this->setBadRequestError('The title field must be a string');

        if (isset($data['description']))
            if (is_string($data['description']))
                $task->description = $data['description'];
            else
                return $this->setBadRequestError('The description field must be a string');

        if (isset($data['estimated_cost']))
            if (is_float($data['estimated_cost']))
                $task->estimated_cost = $data['estimated_cost'];
            else
                return $this->setBadRequestError('The estimated_cost field must be a float');

        if (isset($data['actual_cost']))
            if (is_float($data['actual_cost']))
                $task->actual_cost = $data['actual_cost'];
            else
                return $this->setBadRequestError('The actual_cost field must be a float');

        if (isset($data['due_date']))
            if ($data['due_date'] instanceof \DateTime)
                $task->due_date = $data['due_date'];
            else
                $this->setBadRequestError('The due_date field must be an instance of \DateTime');

        if (isset($data['completed']))
            if (is_bool($data['completed']))
                $task->completed = $data['completed'];
            else
                $this->setBadRequestError('The completed field must be a boolean');

        if (isset($data['archived']))
            if (is_bool($data['archived']))
                $task->archived = $data['archived'];
            else
                $this->setBadRequestError('The archived field must be a boolean');

        return $this->saveEntity($task);
    }

    public function addMember(Task $task, User $user)
    {
        return $this->attachEntities($task->users(), $user);
    }

    public function removeMember(Task $task, User $user)
    {
        return $this->detachEntities($task->users(), $user);
    }
}