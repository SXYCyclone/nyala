<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->ask('What is your name?');
        $email = $this->ask('What is your email?');
        $password = $this->ask('What is your password?');

        $user = app(CreatesNewUsers::class)->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'terms' => true,
        ]);

        return self::SUCCESS;
    }
}
