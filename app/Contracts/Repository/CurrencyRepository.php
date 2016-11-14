<?php

namespace Keikaku\Contracts\Repository;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Models\Currency;

/**
 * Interface CurrencyRepository
 * @package Keikaku\Contracts\Repository
 */
interface CurrencyRepository
{
    /**
     * Find Currencies based on the provided parameters
     *
     * @param array $parameters
     * @param array $columns
     * @return Collection
     */
    public function find(array $parameters = [], array $columns = ['*']);

    /**
     * Find a single Currency by it's ID
     *
     * @param string $id
     * @param array $columns
     * @return Currency|null
     */
    public function findOneById(string $id, array $columns = ['*']);

    /**
     * Find a single Currency by it's symbol
     *
     * @param string $symbol
     * @param array $columns
     * @return Currency|null
     */
    public function findOneBySymbol(string $symbol, array $columns = ['*']);
}