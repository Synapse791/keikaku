<?php

namespace Keikaku\Console\Commands\Category;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CategoryRepository;
use Keikaku\Contracts\Services\CategoryService;

class CategoryUpdate extends Command
{
    protected $signature = 'keikaku:category:update {id}';

    protected $description = 'Updates a category';

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

        $name = $this->ask('Enter the name for the category', $category->name);

        if ($this->categoryService->update($category, $name)) {
            $category = $this->categoryRepository->findOneById($category->id);
            $this->info('Successfully updated the category!');
            $this->line("\n  ID     : {$category->id}");
            $this->line("  Name   : {$category->name}");
        } else
            $this->error($this->categoryService->getErrorDescription());
    }
}
