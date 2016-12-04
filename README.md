# Laravel Rewardable

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-rewardable
```

And then include the service provider within `app/config/app.php`.

``` php
BrianFaust\Rewardable\RewardableServiceProvider::class
```

To get started, you'll need to publish the vendor assets and migrate:

```
php artisan vendor:publish --provider="BrianFaust\Rewardable\RewardableServiceProvider" && php artisan migrate
```

## Usage

## Setup a Model

``` php
<?php


namespace App;

// use BrianFaust\Rewardable\Badges\HasBadges;
// use BrianFaust\Rewardable\Credits\HasCredits;
// use BrianFaust\Rewardable\Ranks\HasRanks;
// use BrianFaust\Rewardable\Transactions\HasTransactions;
use BrianFaust\Rewardable\HasRewardsTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasRewards;

    // these can be required one-by-one if you don't need all and don't use HasRewards
    // use HasBadges;
    // use HasCredits;
    // use HasRanks;
    // use HasTransactions;
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.de)
