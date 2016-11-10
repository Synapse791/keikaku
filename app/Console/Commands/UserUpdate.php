<?php

namespace Keikaku\Console\Commands;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Contracts\Services\UserService;

class UserUpdate extends Command
{
    protected $signature = 'keikaku:user:update {user_id}';

    protected $description = 'Deletes a user';

    protected $userRepository;

    protected $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function handle()
    {
        $id = $this->argument('user_id');

        $user = $this->userRepository->findOneById($id);

        if (!$user) {
            $this->error("User with ID {$id} not found!");
            return;
        }

        $data = [];

        if ($this->confirm('Would you like to update the user\'s name?'))
            $data['name'] = $this->ask('Enter the user\'s new name');

        if ($this->confirm('Would you like to update the user\'s email?'))
            $data['email'] = $this->ask('Enter the user\'s new email');

        if ($this->confirm('Would you like to update the user\'s password?'))
            $data['password'] = $this->secret('Enter the user\'s new password');

        if (empty($data)) {
            $this->info('Nothing to update!');
            return;
        }

        if ($this->userService->update($user, $data)) {
            $user = $this->userRepository->findOneById($user->id);
            $this->info("User with ID {$id} successfully updated!");
            $this->line("\n  ID           : {$user->id}");
            $this->line("  Name         : {$user->name}");
            $this->line("  Email        : {$user->email}");
            $this->line("  Created At   : {$user->created_at}");
            $this->line("  Last Updated : {$user->updated_at}");
        } else
            $this->error($this->userService->getErrorDescription());
    }
}
