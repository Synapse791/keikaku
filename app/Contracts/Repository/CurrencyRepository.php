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
     * @return Collection
     */
    public function find(array $parameters = []);

    /**
     * Find a single Currency by it's ID
     *
     * @param string $id
     * @return Currency|null
     */
    public function findOneById(string $id);

    /**
     * Find a single Currency by it's symbol
     *
     * @param string $symbol
     * @return Currency|null
     */
    public function findOneBySymbol(string $symbol);
}