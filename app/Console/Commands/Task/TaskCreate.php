<?php

namespace Keikaku\Console\Commands\Task;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CategoryRepository;
use Keikaku\Contracts\Repository\ProjectRepository;
use Keikaku\Contracts\Services\TaskService;

class TaskCreate extends Command
{
    protected $signature = 'keikaku:task:create';

    protected $description = 'Creates a new task';

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CategoryRepository */
    protected $categoryRepository;

    /** @var TaskService  */
    protected $taskService;

    public function __construct(
        ProjectRepository $projectRepository,
        CategoryRepository $categoryRepository,
        TaskService $taskService
    )
    {
        parent::__construct();
        $this->projectRepository = $projectRepository;
        $this->categoryRepository = $categoryRepository;
        $this->taskService = $taskService;
    }

    public function handle()
    {
        $projects = $this->projectRepository->find();
        if ($projects->isEmpty()) {
            $this->error('No projects in the database!');
            return;
        }
        $projectName = $this->choice('Which project is the task for?', array_map(create_function('$o', 'return $o[\'title\'];'), $projects->toArray()));
        $project = $projects->where('title', $projectName)->first();

        $categories = $this->categoryRepository->find();
        if ($categories->isEmpty()) {
            $this->error('No categories in the database!');
            return;
        }
        $categoryName = $this->choice('Which category is the task for?', array_map(create_function('$o', 'return $o[\'name\'];'), $categories->toArray()));
        $category = $categories->where('name', $categoryName)->first();

        $title = $this->ask('Enter the title for the new task');

        $description = $this->confirm('Would you like to enter a description for the new task') ?
            $this->ask('Enter the description for the new task') :
            '';

        $estimatedCost = $this->confirm('Would you like to enter an estimated cost for the new task') ?
            $this->ask('Enter the estimated cost for the new task') :
            null;

        if ($this->confirm('Would you like to enter a due date for the new task')) {
            $dueDateString = $this->ask('Enter the due date for the new task (yyyy/mm/dd)');
            $dueDate = Carbon::parse($dueDateString);
        } else
            $dueDate = null;

        if ($this->taskService->create($project, $category, $title, $description, $estimatedCost, $dueDate))
            $this->info('Successfully created new task');
        else
            $this->error($this->taskService->getErrorDescription());
    }
}
