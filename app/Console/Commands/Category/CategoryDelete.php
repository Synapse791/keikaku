<?php

namespace Keikaku\Console\Commands\Category;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CategoryRepository;
use Keikaku\Contracts\Services\CategoryService;

class CategoryDelete extends Command
{
    protected $signature = 'keikaku:category:delete {id}';

    protected $description = 'Deletes a category';

    /** @var CategoryRepository */
    protected $categoryRepository;

    /** @var CategoryService  */
    protected $categoryService;

    public function __construct(CategoryRepository $categoryRepository, CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }

    public function handle()
    {
        $category = $this->categoryRepository->findOneById($this->argument('id'));
        if (!$category) {
            $this->error("Category with ID {$this->argument('id')}");
            return;
        }

        if ($category->tasks()->count() > 0) {
            $this->warn("This category contains the following tasks!\n");

            foreach ($category->tasks as $task) {
                $this->line("  > {$task->id}: {$task->name}");
            }
            $this->line('Categories can only be removed if they contain no tasks');
            return;
        }

        $this->line("\n  ID   : {$category->id}");
        $this->line("  Name : {$category->name}");

        if (!$this->confirm('Are you sure you want to delete this user?'))
            return;

        if ($this->categoryService->delete($category)) {
            $this->info('Successfully deleted the category!');
        } else
            $this->error($this->categoryService->getErrorDescription());
    }
}
