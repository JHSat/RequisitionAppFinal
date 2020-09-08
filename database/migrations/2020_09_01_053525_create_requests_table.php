<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->string('req_id', 20)->primary();
            $table->string('transac_code', 20)->nullable();
            $table->string('requestee', 10)->nullable();
            $table->datetime('requestedDate')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('authorizedBy', 10)->nullable();
            $table->datetime('authorizedDate')->nullable();
            $table->string('confirmedBy', 10)->nullable();
            $table->datetime('confirmedDate')->nullable();
            $table->datetime('processedDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
