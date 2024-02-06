<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;

class CreateSuperadminUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'superadmin:user {username} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command use to create a superadministrator user for the app';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->argument('username');

        $email = $this->argument('email');

        $password = $this->argument('password');

        $userAlreadyExists = User::query()
            ->where('name', $username)
            ->orWhere('email', $email)
            ->exists();

        if ($userAlreadyExists) {

            return $this->error('Name or email is already used by existing user.');
        }

        $superadminRole = Role::query()->where('name', 'superadmin')->first();

        if (!$superadminRole) {

            return $this->error('Superadministrator role not registered.');
        }

        $createdUser = User::create([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'vToken' => null,
            'verified' => 1,
            'isFilled' => 0
        ]);

        $createdUser->roles()->attach($superadminRole->id, ['user_type' => 'App/User']);

        return $this->info('Superadministrator has been created.');
    }
}
