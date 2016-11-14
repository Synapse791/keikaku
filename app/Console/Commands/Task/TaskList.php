<?php

namespace Keikaku\Console\Commands\Task;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\TaskRepository;

class TaskList extends Command
{
    protected $signature = 'keikaku:task:list {--archived}';

    protected $description = 'Lists tasks from the database';

    /** @var TaskRepository  */
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        parent::__construct();
        $this->taskRepository = $taskRepository;
    }

    public function handle()
    {
        $tasks = $this->taskRepository->find([
            'archived' => $this->option('archived'),
        ]);

        $rows = [];

        foreach ($tasks as $task)
            $rows[] = [
                $task->id,
                $task->title,
                $task->completed,
                $task->created_at,
                $task->updated_at,
            ];

        if (!$this->option('archived') && $tasks->isEmpty())
            $this->warn('No active tasks in the database!');
        else if ($this->option('archived') && $tasks->isEmpty())
            $this->warn('No archived tasks in the database!');
        else
            $this->table(
                ['ID', 'Title', 'Completed', 'Created', 'Last Updated'],
                $rows
            );
    }
}
