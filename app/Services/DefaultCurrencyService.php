<?php

namespace Keikaku\Services;

use Keikaku\Contracts\Services\CurrencyService;
use Keikaku\Models\Currency;

class DefaultCurrencyService extends BaseService implements CurrencyService
{
    public function create(string $name, string $symbol)
    {
        if (empty($name))
            return $this->setBadRequestError('The name field cannot be empty');

        if (empty($symbol))
            return $this->setBadRequestError('The symbol field cannot be empty');

        $newCurrency = new Currency();

        $newCurrency->name = $name;
        $newCurrency->symbol = $symbol;

        return $this->saveEntity($newCurrency);
    }

    public function update(Currency $currency, array $data = [])
    {
        if ($data['name'] && ! is_null($data['name']))
            $currency->name = $data['name'];

        if ($data['symbol'] && ! is_null($data['symbol']))
            $currency->symbol = $data['symbol'];

        return $this->saveEntity($currency);
    }
}