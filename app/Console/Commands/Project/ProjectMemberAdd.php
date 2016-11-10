<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Contracts\Services\ProjectService;

class ProjectMemberAdd extends Command
{
    protected $signature = 'keikaku:project:member:add {projectId}';

    protected $description = 'Adds a member to a project';

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

        $userId = $this->ask('Enter the ID of the user to add');

        $user = $this->userRepository->findOneById($userId);

        if (!$user) {
            $this->error("User with ID {$userId} not found!");
            return;
        }

        if ($this->projectService->addMember($project, $user))
            $this->info('User successfully added to the project!');
        else
            $this->error($this->projectService->getErrorDescription());
    }
}
