<?php

namespace Keikaku\Repositories;

use Keikaku\Contracts\Repository\CurrencyRepository;
use Keikaku\Models\Currency;

class DefaultCurrencyRepository implements CurrencyRepository
{
    public function find(array $parameters = [])
    {
        return empty($parameters) ? Currency::all() : Currency::where($parameters)->get();
    }

    public function findOneById(string $id)
    {
        return Currency::where('id', $id)->first();
    }

    public function findOneBySymbol(string $symbol)
    {
        return Currency::where('symbol', $symbol)->first();
    }
}