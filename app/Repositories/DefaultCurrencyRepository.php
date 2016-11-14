<?php

namespace Keikaku\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Keikaku\Contracts\Repository\CurrencyRepository;
use Keikaku\Models\Currency;

class DefaultCurrencyRepository implements CurrencyRepository
{
    public function find(array $parameters = [], array $columns = ['*']): Collection
    {
        return empty($parameters) ?
            Currency::all($columns) :
            Currency::where($parameters)->get($columns);
    }

    public function findOneById(string $id, array $columns = ['*'])
    {
        return Currency::where('id', $id)->first($columns);
    }

    public function findOneBySymbol(string $symbol, array $columns = ['*'])
    {
        return Currency::where('symbol', $symbol)->first($columns);
    }
}