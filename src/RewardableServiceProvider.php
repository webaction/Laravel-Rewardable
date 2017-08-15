<?php

/*
 * This file is part of Laravel Rewardable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of Laravel Rewardable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Rewardable;

use BrianFaust\ServiceProvider\AbstractServiceProvider;

class RewardableServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/rewardable.php' => config_path('rewardable.php'),
        ]);
        $this->publishMigrations();
    }

    public function getPackageName(): string
    {
        return 'rewardable';
    }
}
