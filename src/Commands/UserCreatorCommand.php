<?php

declare(strict_types=1);

namespace AmdadulHaq\UserCreator\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserCreatorCommand extends Command implements PromptsForMissingInput
{
    public $signature = 'user:create
        {name : The name of the user}
        {email : The email address of the user}
        {password? : The password (will be prompted if not provided)}';

    public $description = 'Create a new user';

    public function handle(): int
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        if (! $password) {
            $password = $this->secret('Enter password');
        }

        try {
            $this->validate($name, $email, $password);
        } catch (ValidationException $validationException) {
            foreach ($validationException->errors() as $messages) {
                foreach ($messages as $message) {
                    $this->error($message);
                }
            }

            return self::INVALID;
        }

        $userModel = config('user-creator.user_model');

        if (! class_exists($userModel)) {
            $this->error(sprintf('User model class %s does not exist.', $userModel));

            return self::INVALID;
        }

        $existingUser = $userModel::where('email', $email)->first();
        if ($existingUser) {
            $this->error('User with this email already exists.');

            return self::INVALID;
        }

        $user = new $userModel;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $this->info('User created successfully.');

        return self::SUCCESS;
    }

    protected function validate(string $name, string $email, string $password): void
    {
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        throw_if($validator->fails(), ValidationException::class, $validator);
    }

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'What should the user be named?',
            'email' => "What is the user's email address?",
        ];
    }
}
