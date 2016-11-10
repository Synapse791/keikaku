<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Services\ProjectService;

class ProjectUpdate extends Command
{
    protected $signature = 'keikaku:project:update {id}';

    protected $description = 'Updates a project';

    protected $projectRepository;

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

        $data = [];

        if ($this->confirm('Would you like to update the project title?'))
            $data['title'] = $this->ask('Enter the new project title');

        if ($this->confirm('Would you like to update the project budget?'))
            $data['budget'] = $this->ask('Enter the new project budget');

        if (empty($data)) {
            $this->info('Nothing to update!');
            return;
        }

        if ($this->projectService->update($project, $data)) {
            $project = $this->projectRepository->findOneById($project->id);
            $this->info("Project with ID {$project->id} successfully updated!");
            $this->line("\n  ID           : {$project->id}");
            $this->line("  Title        : {$project->title}");
            $this->line("  Budget       : {$project->budget}");
        } else
            $this->error($this->projectService->getErrorDescription());
    }
}
