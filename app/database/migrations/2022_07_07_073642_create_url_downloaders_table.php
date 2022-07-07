<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_downloaders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url')->index();
            $table->string('path')->nullable();
            $table->enum('status', ['pending', 'downloading', 'complete', 'error'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_downloaders');
    }
};
