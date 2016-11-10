<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Contracts\Services\ProjectService;

class ProjectMemberRemove extends Command
{
    protected $signature = 'keikaku:project:member:remove {projectId}';

    protected $description = 'Removes a member from a project';

    protected $projectRepository;

    protected $userRepository;

    protected $projectService;

    public function __construct(ProjectRepository $projectRepository, UserRepository $userRepository, ProjectService $projectService)
    {
        parent::__construct();

        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
        $this->projectService = $projectService;
    }

    public function handle()
    {
        $project = $this->projectRepository->findOneById($this->argument('projectId'));

        if (!$project) {
            $this->error("Project with ID {$this->argument('id')} not found!");
            return;
        }

        $projectUsers = $this->userRepository->findByProject($project);
        if ($projectUsers->isEmpty()) {
            $this->error('This project has no members to remove!');
            return;
        }

        $userEmails = [];
        foreach ($projectUsers as $u)
            $userEmails[] = $u->email;

        $userEmail = $this->choice('Choose a member to remove', $userEmails);

        $user = $this->userRepository->findOneByEmail($userEmail);

        if (!$user) {
            $this->error("User with email {$userEmail} not found!");
            return;
        }

        if ($this->projectService->removeMember($project, $user))
            $this->info('User successfully removed from the project!');
        else
            $this->error($this->projectService->getErrorDescription());
    }
}
