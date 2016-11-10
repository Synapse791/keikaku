<?php

namespace Keikaku\Console\Commands\Currency;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CurrencyRepository;

class CurrencyList extends Command
{
    protected $signature = 'keikaku:currency:list';

    protected $description = 'Lists currencies from the database';

    /** @var CurrencyRepository  */
    protected $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        parent::__construct();
        $this->currencyRepository = $currencyRepository;
    }

    public function handle()
    {
        $currencies = $this->currencyRepository->find();

        if ($currencies->isEmpty())
            $this->warn('No currencies in the database!');
        else
            $this->table(
                ['ID', 'Name', 'Symbol'],
                $currencies
            );
    }
}
