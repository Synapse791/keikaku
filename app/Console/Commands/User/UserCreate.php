<?php

namespace Keikaku\Console\Commands\User;

use Illuminate\Console\Command;
use Keikaku\Contracts\Services\UserService;

class UserCreate extends Command
{
    protected $signature = 'keikaku:user:create {--N|name=} {--e|email=} {--p|password=}';

    protected $description = 'Creates a new user';

    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    public function handle()
    {
        $name = $this->option('name') ?? $this->ask('What is the user\'s name?');

        $email = $this->option('email') ?? $this->ask('What is the user\'s email?');

        $password = null;

        while (is_null($password)) {
            $password = $this->option('password') ?? $this->secret('What is the user\'s password?');
            if (strlen($password) < 6) {
                $this->warn('User\'s password must be at least 6 characters long!');
                $password = null;
            }
        }

        if ($this->userService->create($name, $email, $password))
            $this->comment('User created successfully!');
        else
            if ($this->userService->getErrorCode() === 409)
                $this->error('A user already exists with that email address!');
            else {
                $this->error('Something went wrong whilst storing the user!');
                $this->error($this->userService->getErrorDescription());
            }

    }
}
