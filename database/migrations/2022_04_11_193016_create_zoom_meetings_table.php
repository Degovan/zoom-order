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
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->string('zoom_meeting_id', 100);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('zoom_account_id')->constrained();
            $table->enum('status', ['waiting', 'active', 'finish']);
            $table->timestamp('start');
            $table->timestamp('end');
            $table->longText('start_url');
            $table->mediumText('join_url');
            $table->string('passcode', 20);
            $table->json('settings');
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
        Schema::dropIfExists('zoom_meetings');
    }
};
