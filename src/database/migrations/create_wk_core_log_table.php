<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWkCoreLogTable extends Migration
{
    public function up()
    {
        Schema::create(config('wk-core.table.core.logs'), function (Blueprint $table) {
            $table->uuid('id');
            $table->nullableUuidMorphs('host');
            $table->nullableUuidMorphs('morph');
            $table->string('type')->nullable();
            $table->uuid('user_id')->nullable();
            $table->json('summary')->nullable();
            $table->json('data');
            $table->json('header');
            $table->boolean('is_highlighted')->default(0);

            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                  ->on(config('wk-core.table.user'))
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->primary('id');
            $table->index('type');
            $table->index('is_highlighted');
        });
        DB::statement('ALTER TABLE `'.config('wk-core.table.core.logs').'` ADD `ip` VARBINARY(16) AFTER `header`;');

        Schema::create(config('wk-core.table.core.logs_sys'), function (Blueprint $table) {
            $table->uuid('id');
            $table->nullableUuidMorphs('host');
            $table->nullableUuidMorphs('morph');
            $table->string('type')->nullable();
            $table->json('summary')->nullable();
            $table->json('data');
            $table->boolean('is_highlighted')->default(0);

            $table->timestampsTz();
            $table->softDeletes();

            $table->primary('id');
            $table->index('type');
            $table->index('is_highlighted');
        });

        Schema::create(config('wk-core.table.core.logs_search'), function (Blueprint $table) {
            $table->uuid('id');
            $table->nullableUuidMorphs('host');
            $table->nullableUuidMorphs('morph');
            $table->uuid('user_id')->nullable();
            $table->string('keyword')->nullable();
            $table->json('data');

            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                  ->on(config('wk-core.table.user'))
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->primary('id');
            $table->index('keyword');
        });
        DB::statement('ALTER TABLE `'.config('wk-core.table.core.logs_search').'` ADD `ip` VARBINARY(16) AFTER `data`;');

        Schema::create(config('wk-core.table.core.logs_request'), function (Blueprint $table) {
            $table->uuid('id');
            $table->nullableUuidMorphs('host');
            $table->nullableUuidMorphs('morph');
            $table->string('type')->nullable();
            $table->string('action');
            $table->string('api');
            $table->string('status_code')->nullable();
            $table->string('status_name')->nullable();
            $table->string('state')->nullable();
            $table->json('request')->nullable();
            $table->json('response')->nullable();
            $table->json('header');

            $table->timestampsTz();
            $table->softDeletes();

            $table->primary('id');
            $table->index('type');
            $table->index('action');
            $table->index('api');
            $table->index('status_code');
            $table->index('status_name');
            $table->index('state');
        });
        DB::statement('ALTER TABLE `'.config('wk-core.table.core.logs_request').'` ADD `ip` VARBINARY(16) AFTER `header`;');
    }

    public function down() {
        DB::statement('ALTER TABLE `'.config('wk-core.table.core.logs_request').'` DROP COLUMN `ip`');
        Schema::dropIfExists(config('wk-core.table.core.logs_request'));
        DB::statement('ALTER TABLE `'.config('wk-core.table.core.logs_search').'` DROP COLUMN `ip`');
        Schema::dropIfExists(config('wk-core.table.core.logs_search'));
        Schema::dropIfExists(config('wk-core.table.core.logs_sys'));
        DB::statement('ALTER TABLE `'.config('wk-core.table.core.logs').'` DROP COLUMN `ip`');
        Schema::dropIfExists(config('wk-core.table.core.logs'));
    }
}
