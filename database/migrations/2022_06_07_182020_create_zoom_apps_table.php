<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->string('client_id', 255);
            $table->string('client_secret', 255);
            $table->string('redirect_url');
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
        Schema::dropIfExists('zoom_apps');
    }
};
