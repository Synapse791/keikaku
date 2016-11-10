<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Services\ProjectService;

class ProjectUnarchive extends Command
{
    protected $signature = 'keikaku:project:unarchive {id}';

    protected $description = 'Unarchives a project';

    /** @var ProjectRepository  */
    protected $projectRepository;

    /** @var ProjectService */
    protected $projectService;

    public function __construct(ProjectRepository $projectRepository, ProjectService $projectService)
    {
        parent::__construct();
        $this->projectRepository = $projectRepository;
        $this->projectService = $projectService;
    }

    public function handle()
    {
        $project = $this->projectRepository->findOneById($this->argument('id'));

        if (!$project) {
            $this->error("Project with ID {$this->argument('id')} not found!");
            return;
        }

        if ($this->projectService->unarchive($project))
            $this->info("Successfully unarchived project");
        else
            $this->error($this->projectService->getErrorDescription());
    }
}
