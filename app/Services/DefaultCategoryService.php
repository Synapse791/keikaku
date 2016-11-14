<?php

namespace Keikaku\Services;


use Keikaku\Contracts\Services\CategoryService;
use Keikaku\Models\Category;

class DefaultCategoryService extends BaseService implements CategoryService
{
    public function create(string $name)
    {
        if (empty($name))
            return $this->setBadRequestError('The name field cannot be empty');

        $newCategory = new Category();

        $newCategory->name = $name;

        return $this->saveEntity($newCategory);
    }

    public function update(Category $category, string $name)
    {
        $category->name = $name;

        return $this->saveEntity($category);
    }

    public function delete(Category $category)
    {
        return $this->deleteEntity($category);
    }
}