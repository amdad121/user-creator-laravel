<?php

declare(strict_types=1);

return [
    'user_model' => env('USER_CREATOR_MODEL', config('auth.providers.users.model', \App\Models\User::class)),
];
