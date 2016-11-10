<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\ProjectRepository;

class ProjectList extends Command
{
    protected $signature = 'keikaku:project:list {--archived}';

    protected $description = 'Lists projects from the database';

    /** @var ProjectRepository  */
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->projectRepository = $projectRepository;
    }

    public function handle()
    {
        $projects = $this->projectRepository->find([
            'archived' => $this->option('archived'),
        ]);

        $rows = [];

        foreach ($projects as $project)
            $rows[] = [
                $project->id,
                $project->title,
                $project->currency->symbol,
                $project->budget,
                $project->created_at,
                $project->updated_at,
            ];

        if (!$this->option('archived') && $projects->isEmpty())
            $this->warn('No active projects in the database!');
        else if ($this->option('archived') && $projects->isEmpty())
            $this->warn('No archived projects in the database!');
        else
            $this->table(
                ['ID', 'Title', 'Currency', 'Budget', 'Created', 'Last Updated'],
                $rows
            );
    }
}
