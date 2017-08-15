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

namespace BrianFaust\Rewardable\Leaderboard;

use BrianFaust\Rewardable\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

class Leaderboard extends BaseModel
{
    protected $table = 'leaderboard';

    public function boardable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getHighToLow(): Collection
    {
        return $this->orderBy('position', 'asc')->get();
    }

    public function getLowToHigh(): Collection
    {
        return $this->orderBy('position', 'desc')->get();
    }

    public function createOrUpdate($model)
    {
        return $this->getLeaderboardRepository()->createOrUpdate($model);
    }

    private function calculateExperience($model)
    {
        return $this->getLeaderboardRepository()->calculateExperience($model);
    }

    private function calculatePositions()
    {
        return $this->getLeaderboardRepository()->calculatePositions();
    }

    private function getLeaderboardRepository(): LeaderboardRepository
    {
        return new LeaderboardRepository($this);
    }
}
