<?php

namespace AmdadulHaq\UserCreator\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Hash;

class UserCreatorCommand extends Command implements PromptsForMissingInput
{
    public $signature = 'user:create {name} {email} {password}';

    public $description = 'Create a new user';

    public function handle(): int
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Check if user with the provided email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $this->error('User with this email already exists.');
            $this->newLine();

            return self::INVALID;
        }

        // Create a new user
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        // Add any additional fields as needed

        $user->save();

        $this->info('User created successfully.');
        $this->newLine();

        return self::SUCCESS;
    }
}
