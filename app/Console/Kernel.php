<?php

namespace Keikaku\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\User\UserList::class,
        Commands\User\UserCreate::class,
        Commands\User\UserUpdate::class,
        Commands\User\UserDelete::class,

        Commands\Project\ProjectList::class,
        Commands\Project\ProjectCreate::class,
        Commands\Project\ProjectUpdate::class,
        Commands\Project\ProjectArchive::class,
        Commands\Project\ProjectUnarchive::class,
        Commands\Project\ProjectCurrencyUpdate::class,
        Commands\Project\ProjectMemberList::class,
        Commands\Project\ProjectMemberAdd::class,
        Commands\Project\ProjectMemberRemove::class,

        Commands\Currency\CurrencyList::class,
        Commands\Currency\CurrencyCreate::class,
        Commands\Currency\CurrencyUpdate::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
