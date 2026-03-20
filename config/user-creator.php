<?php

declare(strict_types=1);
use App\Models\User;

return [
    'user_model' => env('USER_CREATOR_MODEL', config('auth.providers.users.model', User::class)),
];
