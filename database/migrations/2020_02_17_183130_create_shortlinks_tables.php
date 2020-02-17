<?php

use Illuminate\Config\Repository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortlinksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tablePrefix = config('shortlinks.database_table_prefix');
        $urlPrefix = config('shortlinks.url_prefix');

        Schema::create($tablePrefix.'shortlinks', function (Blueprint $table) use ($urlPrefix) {
            $table->uuid('id')->primary();
            $table->string('prefix')->default($urlPrefix);
            $table->string('shortlink')->unique()->index();
            $table->text('destination');
            $table->boolean('track_clicks')->nullable();
            $table->unsignedBigInteger('clicks')->nullable();
            $table->boolean('track_ip')->nullable();
            $table->boolean('track_agent')->nullable();
            $table->timestamps();
        });

        Schema::create($tablePrefix.'tracking', function (Blueprint $table) use ($tablePrefix) {
            $table->uuid('id')->primary();
            $table->uuid('shortlink_id')->index();
            $table->string('ip_address')->nullable();
            $table->string('agent')->nullable();
            $table->timestamps();
            
            $table->foreign('shortlink_id')
                ->references('id')
                ->on($tablePrefix.'shortlinks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tablePrefix = config('shortlinks.database_table_prefix');

        Schema::dropIfExists($tablePrefix.'shortlinks');
        Schema::dropIfExists($tablePrefix.'tracking');
    }
}