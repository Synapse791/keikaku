<?php

namespace Keikaku\Console\Commands\Currency;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\CurrencyRepository;
use Keikaku\Contracts\Services\CurrencyService;

class CurrencyUpdate extends Command
{
    protected $signature = 'keikaku:currency:update {id}';

    protected $description = 'Updates a currency';

    /** @var CurrencyRepository */
    protected $currencyRepository;

    /** @var CurrencyService  */
    protected $currencyService;

    public function __construct(CurrencyRepository $currencyRepository, CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyRepository = $currencyRepository;
        $this->currencyService = $currencyService;
    }

    public function handle()
    {
        $currency = $this->currencyRepository->findOneById($this->argument('id'));
        if (!$currency) {
            $this->error("Currency with ID {$this->argument('id')}");
            return;
        }

        $data['name'] = $this->ask('Enter the name for the currency', $currency->name);
        $data['symbol'] = $this->ask('Enter the symbol for the currency', $currency->symbol);

        if (mb_strlen($data['symbol']) !== 1) {
            $this->error('The symbol field must only be a single character');
            return;
        }

        if ($this->currencyService->update($currency, $data)) {
            $currency = $this->currencyRepository->findOneById($currency->id);
            $this->info('Successfully updated the currency!');
            $this->line("\n  ID     : {$currency->id}");
            $this->line("  Name   : {$currency->name}");
            $this->line("  Symbol : {$currency->symbol}");
        } else
            $this->error($this->currencyService->getErrorDescription());
    }
}
