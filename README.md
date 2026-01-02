# Command line user creator for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/amdadulhaq/user-creator-laravel.svg?style=flat-square)](https://packagist.org/packages/amdadulhaq/user-creator-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/amdad121/user-creator-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/amdad121/user-creator-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/amdad121/user-creator-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/amdad121/user-creator-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/amdadulhaq/user-creator-laravel.svg?style=flat-square)](https://packagist.org/packages/amdadulhaq/user-creator-laravel)

A simple command line user creator for Laravel with validation and configuration support.

## Installation

You can install the package via composer:

```bash
composer require amdadulhaq/user-creator-laravel --dev
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag=user-creator-config
```

## Configuration

Optionally, you can publish the configuration file to customize the user model:

```php
// config/user-creator.php
return [
    'user_model' => env('USER_CREATOR_MODEL', \App\Models\User::class),
];
```

## Usage

### Interactive Mode
Run the command without arguments to be prompted for user details:

```bash
php artisan user:create
```

### Direct Arguments
Provide all arguments directly:

```bash
php artisan user:create "John Doe" john@example.com password123
```

### With Optional Password
Password can be omitted and will be prompted securely:

```bash
php artisan user:create "John Doe" john@example.com
```

## Validation

The command validates input before creating a user:

- **Name**: Required, string, max 255 characters
- **Email**: Required, valid email format, max 255 characters
- **Password**: Required, minimum 8 characters

## Testing

```bash
composer test
```

For code style:

```bash
composer lint
```

For static analysis:

```bash
composer analyse
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Amdadul Haq](https://github.com/amdad121)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
