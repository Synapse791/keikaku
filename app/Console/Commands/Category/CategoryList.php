<?php

namespace Keikaku\Console\Commands\Category;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CategoryRepository;

class CategoryList extends Command
{
    protected $signature = 'keikaku:category:list';

    protected $description = 'Lists categories from the database';

    /** @var CategoryRepository  */
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function handle()
    {
        $categories = $this->categoryRepository->find();

        if ($categories->isEmpty())
            $this->warn('No categories in the database!');
        else
            $this->table(
                ['ID', 'Name'],
                $categories
            );
    }
}
