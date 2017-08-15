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

namespace BrianFaust\Rewardable\Credits;

use BrianFaust\Eloquent\Presenter\PresentableTrait;
use BrianFaust\Rewardable\BaseModel;
use BrianFaust\Rewardable\Repositories\CreditRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Credit extends BaseModel
{
    use PresentableTrait;

    protected $fillable = ['credit_type_id', 'name', 'amount'];

    protected $table = 'credits';

    protected $dates = ['awarded_at', 'revoked_at'];

    protected $casts = ['meta' => 'array'];

    public function creditable(): MorphTo
    {
        return $this->morphTo('creditable');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CreditType::class, 'credit_type_id');
    }

    public function scopeWhereType($query, $type)
    {
        return $query->join('credit_types', 'credits.credit_type_id', '=', 'credit_types.id')
                     ->where('credit_types.name', $type)
                     ->select('credits.*');
    }

    public function getPivot()
    {
        return (new CreditRepository($this))->getPivot();
    }

    public function getPresenterClass(): string
    {
        return CreditPresenter::class;
    }
}
