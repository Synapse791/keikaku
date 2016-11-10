<?php

namespace Keikaku\Console\Commands\Currency;

use Illuminate\Console\Command;
use Keikaku\Contracts\Services\CurrencyService;

class CurrencyCreate extends Command
{
    protected $signature = 'keikaku:currency:create';

    protected $description = 'Creates a new currency';

    /** @var CurrencyService  */
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyService = $currencyService;
    }

    public function handle()
    {
        $name = $this->ask('Enter the name for the new currency');
        $symbol = $this->ask('Enter the symbol for the new currency');

        if (mb_strlen($symbol) !== 1) {
            $this->error('The symbol field must only be a single character');
            return;
        }

        if ($this->currencyService->create($name, $symbol))
            $this->info('Successfully created a new currency!');
        else
            $this->error($this->currencyService->getErrorDescription());
    }
}
