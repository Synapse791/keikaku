<?php

namespace Keikaku\Console\Commands\User;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\UserRepository;

class UserList extends Command
{
    protected $signature = 'keikaku:user:list';

    protected $description = 'Lists users from the database';

    /** @var UserRepository  */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        $users = $this->userRepository->find();

        if ($users->isEmpty())
            $this->warn('No users in the database!');
        else
            $this->table(
                ['ID', 'Name', 'Email', 'Created', 'Last Updated'],
                $users
            );
    }
}
