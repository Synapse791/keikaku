<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CurrencyRepository;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Services\ProjectService;

class ProjectCurrencyUpdate extends Command
{
    protected $signature = 'keikaku:project:currency:update {id}';

    protected $description = 'Updates a project\'s currency';

    protected $projectRepository;

    protected $currencyRepository;

    protected $projectService;

    public function __construct(ProjectRepository $projectRepository, CurrencyRepository $currencyRepository, ProjectService $projectService)
    {
        parent::__construct();

        $this->projectRepository = $projectRepository;
        $this->currencyRepository = $currencyRepository;
        $this->projectService = $projectService;
    }

    public function handle()
    {
        $project = $this->projectRepository->findOneById($this->argument('id'));

        if (!$project) {
            $this->error("Project with ID {$this->argument('id')} not found!");
            return;
        }

        $currencies = $this->currencyRepository->find();

        if ($currencies->isEmpty()) {
            $this->error('No currencies found in the database! Make sure you create at least one before trying to create a project');
            return;
        }

        $currencyChoices = [];

        foreach ($currencies as $c)
            $currencyChoices[] = "{$c->symbol} ({$c->name})";

        $rawCurrenctString = $this->choice('Which currency should be used for your project?', $currencyChoices);

        $symbol = explode(' ', $rawCurrenctString)[0];

        $currency = $this->currencyRepository->findOneBySymbol($symbol);

        if ($this->projectService->setCurrency($project, $currency))
            $this->info("Project with ID {$project->id} successfully updated!");
        else
            $this->error($this->projectService->getErrorDescription());
    }
}
