<?php

namespace Keikaku\Console\Commands\Project;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CurrencyRepository;
use Keikaku\Contracts\Services\ProjectService;

class ProjectCreate extends Command
{
    protected $signature = 'keikaku:project:create {--t|title=} {--b|budget=}';

    protected $description = 'Creates a new project';

    protected $currencyRepository;

    protected $projectService;

    public function __construct(CurrencyRepository $currencyRepository, ProjectService $projectService)
    {
        parent::__construct();

        $this->currencyRepository = $currencyRepository;
        $this->projectService = $projectService;
    }

    public function handle()
    {
        $title = $this->option('title') ?? $this->ask('What is the project title?');

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

        $budget = $this->option('budget');

        if (is_null($budget) && $this->confirm('Does your project have a budget?'))
             $budget = $this->ask('What is the project budget?');

        if ($this->projectService->create($title, $currency, $budget))
            $this->comment('Project created successfully!');
        else
            if ($this->projectService->getErrorCode() === 409)
                $this->error('A project already exists with that title!');
            else {
                $this->error('Something went wrong whilst storing the project!');
                $this->error($this->projectService->getErrorDescription());
            }

    }
}
