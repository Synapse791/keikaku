<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Repository\UserRepository;

class ProjectMemberList extends Command
{
    protected $signature = 'keikaku:project:member:list {projectId}';

    protected $description = 'Adds a member to a project';

    protected $projectRepository;

    protected $userRepository;

    public function __construct(ProjectRepository $projectRepository, UserRepository $userRepository)
    {
        parent::__construct();

        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        $project = $this->projectRepository->findOneById($this->argument('projectId'));

        if (!$project) {
            $this->error("Project with ID {$this->argument('projectId')} not found!");
            return;
        }

        $users = $this->userRepository->findByProject($project);

        if ($users->isEmpty()) {
            $this->warn("This project has no members!");
            return;
        }

        $rows = [];
        foreach ($users as $u)
            $rows[] = [
                $u->id,
                $u->name,
                $u->email,
                $u->created_at,
                $u->updated_at,
            ];

        $this->table(
            ['ID', 'Name', 'Email', 'Created', 'Last Updated'],
            $rows
        );
    }
}
