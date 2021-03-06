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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code', 6);
            $table->string('xendit_inv', 255)->nullable();
            $table->string('payment_url')->nullable();
            $table->dateTime('due');
            $table->foreignId('user_id')->constrained();
            $table->json('items');
            $table->integer('total');
            $table->enum('status', [
                'unpaid', 'complete'
            ]);
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
        Schema::dropIfExists('invoices');
    }
};
