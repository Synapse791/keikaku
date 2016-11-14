<?php

namespace Keikaku\Console\Commands\Task;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\TaskRepository;

class TaskShow extends Command
{
    protected $signature = 'keikaku:task:show {id}';

    protected $description = 'Shows a single task from the database';

    /** @var TaskRepository  */
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        parent::__construct();
        $this->taskRepository = $taskRepository;
    }

    public function handle()
    {
        $task = $this->taskRepository->findOneById($this->argument('id'));

        if (!$task) {
            $this->error("Task with ID {$this->argument('id')} not found");
            return;
        }

        $this->line("  ID             : {$task->id}");
        $this->line("  Project ID     : {$task->project->id}");
        $this->line("  Category ID    : {$task->category->id}");
        $this->line("  Title          : {$task->title}");
        $this->line("  Description    : {$task->description}");
        $this->line("  Estimated Cost : {$task->estimated_cost}");
        $this->line("  Actual Cost    : {$task->actual_cost}");
        $this->line("  Due Date       : {$task->due_date}");
        $this->line("  Completed      : {$task->completed}");
        $this->line("  Archived       : {$task->archived}");
        $this->line("  Created at     : {$task->created_at}");
        $this->line("  Updated at     : {$task->updated_at}");
    }
}
