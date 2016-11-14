<?php

namespace Keikaku\Contracts\Services;
use Keikaku\Models\{
    Category, Project, Task, User
};

/**
 * Interface TaskService
 * @package Keikaku\Contracts\Services
 */
interface TaskService extends ServiceErrors
{
    /**
     * Creates a new Task
     *
     * @param Project $project
     * @param Category $category
     * @param string $title
     * @param string $description
     * @param float|null $estimatedCost
     * @param \DateTime|null $dueDate
     * @return bool
     */
    function create(
        Project $project,
        Category $category,
        string $title,
        string $description = '',
        float $estimatedCost = null,
        \DateTime $dueDate = null
    );

    /**
     * Updates an existing Task
     *
     * @param Task $Task
     * @param array $data
     * @return bool
     */
    function update(Task $Task, array $data = []);

    /**
     * Adds a User to a Task
     *
     * @param Task $Task
     * @param User $user
     * @return bool
     */
    function addMember(Task $Task, User $user);

    /**
     * Removes a User from a Task
     *
     * @param Task $Task
     * @param User $user
     * @return bool
     */
    function removeMember(Task $Task, User $user);
}