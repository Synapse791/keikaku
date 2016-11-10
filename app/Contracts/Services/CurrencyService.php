<?php

namespace Keikaku\Contracts\Services;
use Keikaku\Models\Currency;

/**
 * Interface CurrencyService
 * @package Keikaku\Contracts\Services
 */
interface CurrencyService extends ServiceErrors
{
    /**
     * Adds a new Currency
     *
     * @param string $name
     * @param string $symbol
     * @return bool
     */
    function create(string $name, string $symbol);

    /**
     * Updates an existing Currency
     *
     * @param Currency $currency
     * @param array $data
     * @return bool
     */
    function update(Currency $currency, array $data = []);
}