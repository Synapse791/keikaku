<?php

namespace Keikaku\Services;

use Keikaku\Contracts\Services\ProjectService;
use Keikaku\Models\Currency;
use Keikaku\Models\Project;
use Keikaku\Models\User;

class DefaultProjectService extends BaseService implements ProjectService
{
    public function create(string $title, Currency $currency, float $budget = null)
    {
        if (empty($title))
            return $this->setBadRequestError('The title field cannot be empty');

        $newProject = new Project();

        $newProject->title = $title;
        $newProject->budget = $budget;

        if (!$this->associateEntities($newProject->currency(), $currency))
            return false;

        return $this->saveEntity($newProject);
    }

    public function update(Project $project, array $data = [])
    {
        if (empty($data))
            return true;

        if (isset($data['title']) && ! is_null($data['title']))
            $project->title = $data['title'];

        if (isset($data['budget']) && ! is_null($data['budget']))
            $project->budget = $data['budget'];

        return $this->saveEntity($project);
    }

    public function archive(Project $project)
    {
        $project->archived = true;

        return $this->saveEntity($project);
    }

    public function unarchive(Project $project)
    {
        $project->archived = false;

        return $this->saveEntity($project);
    }

    public function setCurrency(Project $project, Currency $currency)
    {
        if (!$this->associateEntities($project->currency(), $currency))
            return false;

        return $this->saveEntity($project);
    }

    public function addMember(Project $project, User $user)
    {
        return $this->attachEntities($project->users(), $user);
    }

    public function removeMember(Project $project, User $user)
    {
        return $this->detachEntities($project->users(), $user);
    }
}