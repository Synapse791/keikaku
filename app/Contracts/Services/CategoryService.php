<?php

namespace Keikaku\Contracts\Services;
use Keikaku\Models\Category;

/**
 * Interface CategoryService
 * @package Keikaku\Contracts\Services
 */
interface CategoryService extends ServiceErrors
{
    /**
     * Adds a new Category
     *
     * @param string $name
     * @return bool
     */
    function create(string $name);

    /**
     * Updates an existing Category
     *
     * @param Category $currency
     * @param string $name
     * @return bool
     */
    function update(Category $currency, string $name);

    /**
     * Deletes a Category
     *
     * @param Category $category
     * @return bool
     */
    function delete(Category $category);
}