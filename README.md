# A Livewire wrapper for Laravel Data

[![Latest Version on Packagist](https://img.shields.io/packagist/v/foxws/livewire-data.svg?style=flat-square)](https://packagist.org/packages/foxws/livewire-data)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/foxws/livewire-data/run-tests?label=tests)](https://github.com/foxws/livewire-data/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/foxws/livewire-data/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/foxws/livewire-data/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/foxws/livewire-data.svg?style=flat-square)](https://packagist.org/packages/foxws/livewire-data)

A Livewire wrapper for Spatie's [Laravel Data](https://github.com/spatie/laravel-data) package.

## Installation

You can install the package via composer:

```bash
composer require foxws/livewire-data
```

## Usage

```php
<?php

use App\Models\User;
use Foxws\Data\Data;
use Foxws\Data\Data\DataObject;
use Foxws\Data\Support\DataTransferObject;

class UserEditController extends Data
{
    public DataTransferObject $user;

    public DataTransferObject $post;

    public function render()
    {
        //
    }

    protected function data(): array
    {
        return [
            // Fill data-object based on model
            DataObject::new()
                ->name('user')
                ->model($this->userModel()),

            // Creates empty data-object
            DataObject::new()
                ->name('post')
                ->data(PostData::class),
        ];
    }

    protected function userModel(): User
    {
        return User::findByPrefixedIdOrFail(
            $this->route['id']
        );
    }
}

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [spatie](https://github.com/spatie)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
