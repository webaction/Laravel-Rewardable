<?php

/*
 * This file is part of Laravel Rewardable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditsTable extends Migration
{
    public function __construct()
    {
        $this->table_prefix = config('rewardable.database.table_prefix');
    }

    public function up()
    {
        Schema::create($this->table_prefix . 'credits', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('credit_type_id');

            $table->string('name');
            $table->integer('amount');
            $table->text('description')->nullable();
            $table->json('meta')->nullable();

            $table->morphs('creditable');
            $table->timestamp('awarded_at');

            $table->text('revoke_reason')->nullable();
            $table->timestamp('revoked_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop($this->table_prefix . 'credits');
    }
}
