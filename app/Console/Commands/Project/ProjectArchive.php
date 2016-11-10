<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Services\ProjectService;

class ProjectArchive extends Command
{
    protected $signature = 'keikaku:project:archive {id}';

    protected $description = 'Archives a project';

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
            $this->error('Project not found!');
            return;
        }

        if ($this->projectService->archive($project))
            $this->info("Successfully archived project");
        else
            $this->error($this->projectService->getErrorDescription());
    }
}
