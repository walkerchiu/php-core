<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWkCoreLangTable extends Migration
{
    public function up()
    {
        Schema::create(config('wk-core.table.core.lang_core'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('morph');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('code');
            $table->string('key');
            $table->longText('value')->nullable();
            $table->boolean('is_current')->default(1);

            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                  ->on(config('wk-core.table.user'))
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists(config('wk-core.table.core.lang_core'));
    }
}
