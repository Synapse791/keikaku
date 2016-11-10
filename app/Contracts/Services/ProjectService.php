<?php

namespace Keikaku\Contracts\Services;
use Keikaku\Models\{
    Currency, Project, User
};

/**
 * Interface ProjectService
 * @package Keikaku\Contracts\Services
 */
interface ProjectService extends ServiceErrors
{
    /**
     * Creates a new Project
     *
     * @param string $title
     * @param Currency $currency
     * @param int|null $budget
     * @return bool
     */
    function create(string $title, Currency $currency, int $budget = null);

    /**
     * Updates an existing Project
     *
     * @param Project $project
     * @param array $data
     * @return bool
     */
    function update(Project $project, array $data = []);

    /**
     * Archives the provided Project
     *
     * @param Project $project
     * @return bool
     */
    function archive(Project $project);

    /**
     * Unarchives the provided Project
     *
     * @param Project $project
     * @return bool
     */
    function unarchive(Project $project);

    /**
     * Associates the provided Currency with the Project
     *
     * @param Project $project
     * @param Currency $currency
     * @return bool
     */
    function setCurrency(Project $project, Currency $currency);

    /**
     * Adds a User to a Project
     *
     * @param Project $project
     * @param User $user
     * @return bool
     */
    function addMember(Project $project, User $user);

    /**
     * Removes a User from a Project
     *
     * @param Project $project
     * @param User $user
     * @return bool
     */
    function removeMember(Project $project, User $user);
}