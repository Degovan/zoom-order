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
            $table->string('zoom_meeting_id', 50);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('host_email', 50);
            $table->string('topic', 200);
            $table->enum('status', ['waiting', 'active']);
            $table->dateTime('start_time');
            $table->dateTime('until_time');
            $table->longText('start_url');
            $table->string('join_url', 200);
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
