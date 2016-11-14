<?php

namespace Keikaku\Console\Commands\Category;

use Illuminate\Console\Command;
use Keikaku\Contracts\Services\CategoryService;

class CategoryCreate extends Command
{
    protected $signature = 'keikaku:category:create';

    protected $description = 'Creates a new category';

    /** @var CategoryService  */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    public function handle()
    {
        $name = $this->ask('Enter then name of the new category');

        if ($this->categoryService->create($name))
            $this->info('Successfully created a new category!');
        else
            $this->error($this->categoryService->getErrorDescription());
    }
}
