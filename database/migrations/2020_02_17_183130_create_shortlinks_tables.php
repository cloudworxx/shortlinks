<?php

use Illuminate\Config\Repository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortlinksTables extends Migration
{
    /**
     * The database table prefix.
     * 
     * @var string
     */
    protected $tablePrefix;

    /**
     * The link prefix.
     * 
     * @var string
     */
    protected $linkPrefix;

    /**
     * Create a new CreateShortlinksTables instance.
     * 
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->tablePrefix = $config->get('shortlinks.database_table_prefix');
        $this->tablePrefix = $config->get('shortlinks.url_prefix');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tablePrefix.'shortlinks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('prefix')->default($this->tablePrefix);
            $table->string('shortlink')->unique()->index();
            $table->text('destination');
            $table->boolean('track_clicks')->nullable();
            $table->unsignedBigInteger('clicks')->nullable();
            $table->boolean('track_ip')->nullable();
            $table->boolean('track_agent')->nullable();
            $table->timestamps();
        });

        Schema::create($this->tablePrefix.'tracking', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('shortlink_id')->index();
            $table->string('ip_address')->nullable();
            $table->string('agent')->nullable();
            $table->timestamps();
            
            $table->foreign('shortlink_id')
                ->references('id')
                ->on($this->tablePrefix.'shortlinks')
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
        Schema::dropIfExists($this->tablePrefix.'shortlinks');
        Schema::dropIfExists($this->tablePrefix.'tracking');
    }
}