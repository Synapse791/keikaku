<?php

namespace Keikaku\Console\Commands\User;

use Illuminate\Console\Command;
use Keikaku\Contracts\Repository\UserRepository;
use Keikaku\Contracts\Services\UserService;

class UserDelete extends Command
{
    protected $signature = 'keikaku:user:delete {user_id}';

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

        $user = $this->userRepository->findOneById($id, [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);

        if (!$user) {
            $this->error("User with ID {$id} not found!");
            return;
        }

        $this->line("\n  ID           : {$user->id}");
        $this->line("  Name         : {$user->name}");
        $this->line("  Email        : {$user->email}");
        $this->line("  Created At   : {$user->created_at}");
        $this->line("  Last Updated : {$user->updated_at}");

        if (!$this->confirm('Are you sure you want to delete this user?'))
            return;

        if ($this->userService->delete($user))
            $this->info("User with ID {$id} successfully deleted!");
        else
            $this->error($this->userService->getErrorDescription());
    }
}
